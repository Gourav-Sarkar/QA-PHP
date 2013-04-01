<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AbstractObjectPool
 *
 * @author Gourav Sarkar
 */
abstract class AbstractObjectPool 
        implements CachebleInterface
{
    protected $object;
    
    //put your code here
    public function __construct(AbstractContent $object) {
        $this->object=$object;
    }
    public function create()
    {
        return apc_add($this->getKey(),$this->reference);
    }
    
    public function edit(\AbstractContent $tempObj) {
        return apc_store($this->getKey(),$this->reference);
    }
    
    public function delete() {
        return apc_delete($this->getKey());
    }
    
    public function read()
    {
        if(!apc_exists($this->getKey()))
        {
            throw new CacheNotFoundException();
        }
        apc_fetch($this->getKey());
    }
    
    public function listing() {
        ;
    }
     public function getKey()
    {
        return (string)$this->object . $this->object->getID();
    } 
}

?>
