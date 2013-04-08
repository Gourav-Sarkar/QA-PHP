<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Role
 *
 * @author Gourav Sarkar
 */
class Role extends AbstractContent{
    private $title;
    
    
    public function __construct() {
        parent::__construct();
    }
    //put your code here
    public function setTitle($title)
    {
        $this->setFieldCache("title");
        $this->title=$title;
    }
    public function getTitle()
    {
        return $this->title;
    }
}

?>
