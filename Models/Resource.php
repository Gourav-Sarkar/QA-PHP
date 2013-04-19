<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'traits/CRUDLTrait.php';
/**
 * Description of Resource
 *
 * @author Gourav Sarkar
 */
class Resource {
    
    use CRUDLTrait;
    //put your code here
    protected $id;
    private $module;
    private $action;
    /* 
     * There must have some accessor who will access the resource
     * In this case accessor is User object it could be anything else
     * If there is need for other type of accessor it should be abstracted and
     *   an interface should be used to get acecessor
     */
    //private $accessor;
    
    
    public function __construct() {
        /*
         * @TODO causing infinite loop
         */
        //$this->accessor=User::getActiveUser();
    }
    
    
    public function setID($id)
    {
        $this->setFieldCache('id');
        $this->id=$id;
    }
    public function setController($module)
    {
        $this->setFieldCache('module');
        
        //Normalize module
        $this->module=  strtolower($module); //Find and append controller class
    }
    public function setAction($act)
    {
        $this->setFieldCache('action');
        $this->action=$act;
    }
    
    public function getId()
    {
        return $this->id;
    }
    public function getModule()
    {
        return $this->module;
    }
    public function getAction()
    {
        return $this->action;
    }
    
    public function get()
    {
        /*
         * Validate IF module is there and has permssion to acccess it
         */
        
        $controllerName="{$this->module}Controller";
        require_once "controllers/$controllerName.php";
        
        if(!method_exists("{$this->module}Controller",$this->action))
        {
            throw new InvalidRequestException("Invalid Request");
        }
        /*
         * check if methods are in module
         */
        
        $controller=new $controllerName();
        $controller->{$this->action}();
    }
   
    /*
     * @PARAM strin $module name of the module
     * @return ResourceStorage
     * It will analyse each of module controller using Reflection
     * 
     */
    public static function getAavailableAction(Resource $resource)
    {
        /*
         * Get controller
         */
        $controllerName=$resource->getModule()."Controller";
         require_once "controllers/{$controllerName}.php";
         //Init controller
         $reflClass=new ReflectionClass($controllerName);
         $reflMethods=$reflClass->getMethods(ReflectionMethod::IS_PUBLIC);
         
         foreach($reflMethods as $methods)
         {
             var_dump($methods);
         }
         
         
    }
    /*
     * @TODO should be move to general object (Abstract)
     * @TODO mak database module+action unique combo
     * two resource can't have same module and action combo
     * check both module and action same 
     */
    public function equals(Resource $resource)
    {
        //Debug
        //echo sprintf("%s %s %s %s",$this->getModule(),$resource->getModule(),$this->getAction(),$resource->getAction());
        return ($this->getModule()==$resource->getModule()&&$this->getAction()==$resource->getAction());
    }
}

?>
