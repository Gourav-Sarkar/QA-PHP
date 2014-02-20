<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Interfaces/CRUDLInterface.php';
require_once 'Interfaces/XMLSerializeble.php';

require_once 'models/DefaultUniqueClassObjectStorage.php';
require_once 'models/CRUDobject.php';
require_once 'interfaces/DatabaseInteractbleInterface.php';

/**
 * Used to map different objects into one table
 * maps are CRUDEable
 * @author gourav sarkar
 * @property Uses Magic methods
 */
class AbstractMap implements CRUDLInterface,  XMLSerializeble ,DatabaseInteractbleInterface{

    /*
     *
     * Takes variable paramter all must
     */
    private $mapObjects;
    private $crud;
    
    public function __construct() {
        $this->crud=new CRUDobject($this);
        
        $this->mapObjects= new DefaultUniqueClassObjectStorage();
        
        foreach(func_get_args() as $mapObjs)
        {
            assert('$mapObjs instanceof DatabaseInteractbleInterface');
            $this->mapObjects->attach($mapObjs,$mapObjs);
        }
    }
    public function getMapObjects()
    {
        return $this->mapObjects;
    }
    public function __toString() {
        return (string) get_class($this);
    }
    /*
     * @magic method
     * Check if setter method available for particuler object
     * This method for particulerly for setting ID. 
     * getQuestion(),getTag()
     * setQuestion,setTag()
     */
    /*
    public function __call($name, $arguments) {
        var_dump("Magic method $name");
    }
     * 
     * 
     */
    
    
    /*
     * need to get M
     */
    
    

    public function create() {
        
    }

    public function delete() {
        
    }

    public function edit(\DatabaseInteractbleInterface $tempObj) {
        
    }

    /*
     * read and softread will be in no use
     */
    public function read() {
        throw new BadMethodCallException("Map dont need to read individual details. They have no identity itself most of the time");
    }

    public static function listing(\DatabaseInteractbleInterface $reference, $args = array()) {
        
    }

    public function xmlSerialize() {
        
    }

}

?>
