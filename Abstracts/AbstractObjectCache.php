<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Interfaces/CachebleInterface.php';
require_once 'Exception/NoEntryFoundException.php';
/**
 * Description of AbstractObjectPool
 *
 * @author Gourav Sarkar
 */
abstract class AbstractObjectCache
        implements CachebleInterface
{
    protected $object;
    
    //put your code here
    public function __construct(AbstractContent $object) {
        
        
        $this->object=$object;
        
        if(!extension_loaded('apc'))
        {
            throw new NoExtensionInstalledException("APC is not installed");
        }
    }
    public function create()
    {
        var_dump("Debug cache");
        //var_dump($d=serialize($this->object));
        //var_dump(serialize($this->object));
        //var_dump(unserialize(serialize($this->object)));
        //var_dump($this->object);
        return apc_add($this->getKey(),serialize($this->object));
    }
    
    public function edit(\DatabaseInteractbleInterface $tempObj) {
        return apc_store($this->getKey(),  serialize($this->object));
    }
    
    public function delete() {
        return apc_delete($this->getKey());
    }
    
    public function read()
    {
        if(!apc_exists($this->getKey()))
        {
            throw new NoEntryFoundException();
        }
        
        var_dump("reading cache");
        //var_dump(unserialize(apc_fetch($this->getKey())));
        return unserialize(apc_fetch($this->getKey()));
    }
    
    public static function listing(DatabaseInteractbleInterface $reference,  Pagination $pager=null) {
        ;
    }
}

?>
