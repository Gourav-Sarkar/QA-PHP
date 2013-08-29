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
    
    public function __construct() {
        parent::__construct();
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
    
    public function xmlSerialize() {
        unset($this->user);
        
        parent::xmlSerialize();
    }
}

?>
