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
    private $dependency;
    private $name;
    
    //AbstractContent::$content used here as description of tag
    
    public function __construct(AbstractContent $reference)
    {
        parent::__construct();

        $this->dependency=new DependencyObject($reference);
        $this->crud->setFieldCache(get_class($reference));
    }
    
    public function setName($name)
    {
        $this->crud->setFieldCache("name");
        $this->name=$name;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function getQuestion()
    {
        return $this->dependency;
    }
    
    public function getLink($action)
    {
        return $this->dependency->getLink("getList")."&amp;tags[]={$this->name}";
    }
    
   
    
}

?>
