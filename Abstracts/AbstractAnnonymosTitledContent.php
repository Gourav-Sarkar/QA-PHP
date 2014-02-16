<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'abstracts/AbstractAnnonymosContent.php';
/**
 * Description of AbstractAnnonymosTitledContent
 *
 * @author gourav sarkar
 */
class AbstractAnnonymosTitledContent extends AbstractAnnonymosContent{
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
