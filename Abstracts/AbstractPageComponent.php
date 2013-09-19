<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//require_once 'Interfaces/PageComponentInterface.php';
require_once 'Abstracts/AbstractContent.php';
/**
 * Description of AbstractPageComponent
 *
 * @author Gourav Sarkar
 */
abstract class AbstractPageComponent
    extends AbstractContent
{
    protected $title;
    protected $group;
    
    protected $dependency;
    
    public function __construct(AbstractContent $deps) {
        parent::__construct();
        
        $this->crud->setFieldCache("page");
        $this->dependency=new DependencyObject($deps);
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
    
     public function setGroup($group)
    {
        $this->crud->setFieldCache('group');
        $this->title=$group;
    }
    public function getgroup()
    {
        return $this->group;
    }
    
    public function setPage(Page $page)
    {
        $this->dependency=new DependencyObject($page);
    }
    public function getPage()
    {
        return $this->dependency->getReference();
    }
    
    
    public static function listing(\DatabaseInteractbleInterface $reference) {
        //$pageComp=new PageComponent($reference);
        //$pageComp->read();
    }
    
    
    public function xmlSerialize() {
        unset($this->user);
        
        parent::xmlSerialize();
    }
}

?>
