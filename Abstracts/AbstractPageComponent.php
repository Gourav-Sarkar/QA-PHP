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
    private $title;
    
    public function setTitle($title)
    {
        $this->setFieldCache('title');
        $this->title=$title;
    }
    public function getTitle()
    {
        return $this->title;
    }
}

?>
