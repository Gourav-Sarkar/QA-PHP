<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AbstractPseudoObjectStorage
 *
 * @author Gourav Sarkar
 */
abstract class AbstractPseudoObjectStorage {
    //put your code here
    protected $data=array();
    
    public function attach($object)
    {
        $this->data[$this->getHash($object)]=$object;
    }
    
    public function detach($object)
    {
        unset($this->data[$this->getHash($object)]);
    }
    
    abstract public function getHash($object);
    
    public function offsetGet($object)
    {
        return $this->data[$this->getHash($object)];
    }
    public function count() 
    {
        return count($this->data);
    }
    public function contains($object)
    {
        return isset($this->data[$this->getHash($object)]);
    }
}

?>
