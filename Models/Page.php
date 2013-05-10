<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Abstracts/AbstractContent.php';
require_once 'Models/PageComponent.php';
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
    private $component;
    private $title;
    
    
    public function __construct() {
        $this->component=new PageComponent();
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
         */
    }
}

?>
