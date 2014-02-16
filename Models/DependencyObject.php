<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DependencyObject
 *
 * @author Gourav Sarkar
 */
class DependencyObject {
    //put your code hereprotected $reference;
    protected $reference;
    
    public function __construct(AbstractAnnonymosContent $content)
    {
        $this->reference=$content;
        //set field cache for $content object
        /*
         * @TODO ensure fieldcache is available
         */
        //$this->dependency->setFieldCache(get_class($content));
        //set dependency
        
    }
    
    
    /*
     * #CAUTION#
     * Magic method Restriction
     * Should not be used to else rather that reference replacement for dynamically
     *  get reference data
     */
    /*
    public function __call($name,$args)
    {
        var_dump(get_class($this->reference),$name);
        if(strtolower("get".get_class($this->reference))==strtolower($name))
        {
            return $this->getReference();
        }
        
        throw new BadMethodCallException("Method calling $name");
    }
     * 
     */
    
    public function getReference()
    {
        return $this->reference;
    }
}

?>
