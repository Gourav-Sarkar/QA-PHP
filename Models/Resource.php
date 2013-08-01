<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Interfaces/CRUDLInterface.php';
require_once 'models/CRUDobject.php';
/**
 * Description of Resource
 * @todo possible issue with case sensivity []
 * @author Gourav Sarkar
 */
class Resource implements CRUDLInterface{
    
    //In favor PHP 5.3 compatible
    //use CRUDLTrait;
    
    protected $id;
    private $module;
    private $action;
    private $crud;
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
        $this->crud=new CRUDobject($this);
    }
    
    
    public function setID($id)
    {
        $this->crud->setFieldCache('id');
        $this->id=$id;
    }
    public function setModule($module)
    {
        $this->crud->setFieldCache('module');
        
        /*
         *  @todo possible issue with case
         */
        $this->module=  $module;
    }
    public function setAction($act)
    {
        $this->crud->setFieldCache('action');
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
         * Handle static resource
         * if static parameter is passed call the static template and get out of the
         * rendering process
         */
        if(isset($_GET['static']))
        {
            $render=new Render();
            $render->setModel(null);
            $render->setDumper('StaticDumper');
            $render->render();
            
            return null;
        }
        
        
        /*
         * Validate IF module is there and has permssion to acccess it
         */
        if(empty($this->module))
        {
            throw new InvalidRequestException("Invalid Request [Module loading failure]");
        }
        
        
        $controllerName="{$this->module}Controller";
        require_once DOCUMENT_ROOT . "controllers/$controllerName.php";
        
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
     * 
     */
    public function getAavailableAction()
    {
        $methods=array();
        $module=$this->getModule();
        
        assert('!empty($module)');
        
        $controllerName="{$module}Controller";
        
        //Include controller
        require_once DOCUMENT_ROOT . "controllers/{$controllerName}.php";
         
        //Reflect controller
         $reflClass=new ReflectionClass($controllerName);
         /*
          * Get methods from reflected controller
          * Only public methods is used for controller. as controller meant to be used
          * From other object
          */
         $reflMethods=$reflClass->getMethods(ReflectionMethod::IS_PUBLIC);
         
        //Loop over reflected methods
         foreach($reflMethods as $method)
         {
             $methods[]=$method->getName();
         }
         
         
        //Filter methods
         $methods=  array_filter($methods,function($value)use($controllerName)
                                        {
                                            /*
                                             * Filter constrcutor and destrcutor
                                             * strtolower() is used to normalize names
                                             */
                                            return !in_array($value,array('__destruct','__construct',$controllerName));
                                        }
                                );
         
         return $methods;
    }
    
    /*
     * Get modules only for thoswe who have controllers
     * @todo controller and models are unnesacrily parsed twice. FIX IT if possible
     */
    public static function getAvailableController()
    {
        $output=array();
        /*
         * Get all files from Controller folder
         */
        $dirs=glob(DOCUMENT_ROOT . 'controllers/*.php');
        
        foreach($dirs as $dir)
        {
            $module=str_ireplace('controller','',pathinfo($dir, PATHINFO_FILENAME));
            /*
             * Get action for each controller
             */
            $resource=new Resource();
            $resource->setModule($module);
              
            $output[$module]=$resource->getAavailableAction();
            
        }
        
        return $output;
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
    
    
    
    
    
    public function create()
    {
        return $this->crud->create();
    }
    
    public function delete() {
        ;
    }
    
    public function read() {
        ;
    }
    public function edit(\DatabaseInteractbleInterface $tempObj) {
        ;
    }
    public static function listing(\DatabaseInteractbleInterface $reference) {
        ;
    }
    
}

?>
