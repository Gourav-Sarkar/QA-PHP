<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * @class Dependeble trait
 * This trait is used to those object which have dependency with other object
 * or can not exist alone
 * 
 * If a class use Dependenble trait inherited class also will be dependeble
 * It uses a reference property to set its dependeble
 * It has getter and setter method for reference property
 * Setting reference also initiate database field cache for database manipulating
 * fieldcache name will be the class name of the reference. because class name
 * will be mapped to database and CRUDLTrait
 * 
 *
 * @author Gourav Sarkar
 */
trait DependebleTrait {
    //put your code here
    protected $reference;
    //protected $dependency;
    
    public function setReference(AbstractContent $content)
    {
        $this->reference=$content;
        //set field cache for $content object
        /*
         * @TODO ensure fieldcache is available
         */
        $this->setFieldCache(get_class($content));
        //set dependency
        
    }
    
    /*
     * #CAUTION#
     * Magic method Restriction
     * Should not be used to else rather that reference replacement for dynamically
     *  get reference data
     */
    public function __call($name,$args)
    {
        var_dump(get_class($this->reference),$name);
        if(strtolower("get".get_class($this->reference))==strtolower($name))
        {
            return $this->getReference();
        }
        
        throw new BadMethodCallException();
    }
    
    public function getReference()
    {
        return $this->reference;
    }
}

?>
