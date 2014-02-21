<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Interfaces/CRUDLinterface.php';
require_once 'models/defaultUniqueClassObjectStorage.php';
require_once 'models/baseObject.php';

/**
 * Description of AbstractMap
 *
 * @author gourav sarkar
 */
class AbstractMap extends BaseObject implements CRUDLInterface {

    //put your code here
   private $tableName;

    private $mapObject;
    private $crud;

    public function __construct($name) {
        $this->tableName=$name;
        $this->crud = new CRUDobject($this);
        $this->mapObject = new defaultUniqueClassObjectStorage();
    }

    public function __toString() {
        //parent::__toString();
        return (string)$this->tableName;
    }
    public function getMapObject()
    {
        return $this->mapObject;
    }
    
    public function create() {
        return $this->crud->create();
        
    }
    public function map(AbstractAnnonymosContent $mapObj)
    {
        //var_dump((string)$mapObj);
        $this->crud->setFieldCache((string) $mapObj);
        $this->mapObject->attach($mapObj, $mapObj);
    }


    
    public function __call($name, $arguments) {
        $validmethodname=strpos($name, 'get');
        if($validmethodname==0)
        {
            $className=  str_replace('get','', $name);
            //var_dump($className);
            //var_dump($this->mapObject->getByKey($className));
            return $this->mapObject->getByKey($className);
        }
    }

    public function delete() {
        
    }

    public function edit(\DatabaseInteractbleInterface $tempObj) {
        throw new BadMethodCallException("$this have no edit method");
    }

    public function read() {
        
    }

    public static function listing(\DatabaseInteractbleInterface $reference, $args = array()) {
        
    }

}

?>
