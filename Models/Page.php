<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Abstracts/AbstractContent.php';
require_once 'Models/PageComponent.php';
require_once 'Storages/pageComponentStorage.php';
/**
 * Description of Page
 * 
 *  @DEPRECTAED User and time
 * @handle pager GET missing
 * 
 * @author Gourav Sarkar
 */
class Page extends AbstractContent{
    //put your code here
    private $componentList;
    private $title;
    
    
    public function __construct() {
        parent::__construct();

        $this->componentList=new PageComponentStorage('pageComponent');
    }
    
    public function setTitle($title)
    {
        $this->crud->setFieldCache('title');
        $this->title=$title;
    }
    
    public function getTitle()
    {
        return $this->title;
    }
    
    public function get($identifier)
    {
        /*
         * get components by identifier
         * @todo Blank or unavailable component should return dummy text
         */
        $component=new PageComponent();
        $component->setTitle($identifier);
        
        //echo $this->componentList->count();
        
        return $this->componentList->offsetGet($component)->getContent();
    }
    
    public function read()
    {
        parent::read();
        /*
         * Get component listed in page
         */
        //$this->getComponents();
    }
    
    private function getComponents()
    {
        $componentStorage=new PageComponentStorage('pageComponent');
        
        $query="SELECT
            pc.* FROM
            PageComponentMapper AS pcm
            INNER JOIN pageComponent as pc
            ON pcm.component=pc.id
            WHERE pcm.page=?
            ";
        
        $stmt=  DatabaseHandle::getConnection()->prepare($query);
        $stmt->execute(array($this->id));
        
        while($data=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            
            $pageComponent=new PageComponent();
            $pageComponent->setID($data['id']);
            $pageComponent->setTitle($data['title']);
            $pageComponent->setContent($data['content']);
            
            
            //var_dump($pageComponent);
            $this->componentList->attach($pageComponent,$pageComponent);
        }
    }
    
    /*
     * Do not serialize pager object
     */
}

?>
