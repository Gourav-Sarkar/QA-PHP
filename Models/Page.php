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
    private $pageComponentList;
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
        
        $this->pageComponentList=  PageComponent::listing($this);
        /*
         * Get component listed in page
         */
        //$this->getComponents();
    }
    
    
    /*
     * Do not serialize pager object
     */
}

?>
