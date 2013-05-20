<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Abstracts/AbstractContent.php';
require_once 'Models/PageComponent.php';
require_once 'Models/pageComponentStorage.php';
/**
 * Description of Page
 * 
 *  @DEPRECTAED User and time
 * 
 * @author Gourav Sarkar
 */
class Page extends AbstractContent{
    //put your code here
    private $meta;
    private $componentList;
    private $title;
    
    
    public function __construct() {
        $this->componentList=new PageComponentStorage();
    }
    
    public function setTitle($title)
    {
        $this->setFieldCache('title');
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
        $this->getComponents();
    }
    
    private function getComponents()
    {
        $componentStorage=new PageComponentStorage();
        
        $query="SELECT
            pc.* FROM
            PageComponentMapper AS pcm
            INNER JOIN pageComponent as pc
            ON pcm.component=pc.id
            WHERE pcm.page=?
            ";
        
        $stmt=  DatabaseHandle::getConnection()->prepare($query);
        $stmt->execute([$this->id]);
        
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
}

?>
