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
    private $controller;
    private $action;
    /* 
     * There must have some accessor who will access the resource
     * In this case accessor is User object it could be anything else
     * If there is need for other type of accessor it should be abstracted and
     *   an interface should be used to get acecessor
     */
    private $accessor;
    
    
    public function __construct() {
        $this->accessor=User::getActiveUser();
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
        $module=  strtolower($module);

        $controllerClass="{$module}Controller";
        $this->controller= new $controllerClass($module);
        
        //Find and append controller class
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
        /*
         * Truncate 'controller to get module name, 
         * make controller lower case so it will be easy to compare
         */
        return str_replace('controller','',strtolower(get_Class($this->controller)));
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
        if(!method_exists($this->controller,$this->action))
        {
            throw new InvalidRequestException("Invalid Request");
        }
        /*
         * check if methods are in module
         */
        $this->controller->{$this->action}();
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
