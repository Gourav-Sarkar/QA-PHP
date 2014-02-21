<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tag
 *
 * @author Gourav Sarkar
 */
class Tag extends AbstractContent{
    //put your code here
    //private $dependency;
    private $title;
    //AbstractContent::$content used here as description of tag
    
    public function __construct()
    {
        parent::__construct();

        //$this->dependency=new DependencyObject($reference);
        //$this->crud->setFieldCache(get_class($reference));
    }
    
    /*
     * @todo should be moved into trait
     */
    public function setTitle($title)
    {
        $this->crud->setFieldCache("title");
        $this->title=$title;
    }
    
    public function getTitle()
    {
        return $this->title;
    }
    
    
    /*
     * Replace it with some magic method
     */
    public function getJournal()
    {
        return $this->dependency->getReference();
    }
    /*
    public function getQuestion()
    {
        return $this->dependency;
    }
    
    public function getLink($action)
    {
        return $this->dependency->getLink("getList")."&amp;tags[]={$this->name}";
    }
     * 
     */
    
   
    
}

?>
