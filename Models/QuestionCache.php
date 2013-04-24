<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Abstracts/AbstractObjectCache.php';
/**
 * Description of QuestionCache
 *
 * @author Gourav Sarkar
 */
class QuestionCache extends AbstractObjectCache {
    //put your code here
    public function __construct(AbstractQuestion $object) {
        $this->object=$object;
    }
    
    public function read()
    {
        //get object in serialized way
        //$question=parent::read();
        
        return parent::read();
    }
    
    public function getKey()
    {
        //var_dump("{$this->object}_". $this->object->getID());
        return (string)"{$this->object}_". $this->object->getID();
    } 
}

?>
