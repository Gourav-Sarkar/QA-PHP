<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once "Abstracts/abstractContent.php";
/**
 * Description of AbstractTitledContent
 *
 * @author gourav sarkar
 */
class AbstractTitledContent extends AbstractContent{
    //put your code here
    
    protected $title;
    
    public function setTitle($title)
    {
        $this->title=$title;
    }
    public function getTitle()
    {
        return $this->title;
    }
}

?>
