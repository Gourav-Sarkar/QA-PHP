<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SettingHandler
 * Handles setting 
 * Settings are XML files
 * @author Gourav Sarkar
 */
class SettingHandler {
    //put your code here
    private $settingObject;
    
    private $modules;
    
    public function __construct($tobj) {
        $this->settingObject=$tobj;
    }

    /* 
     * Analyse all possible module and possible actions and make an array of it
     */
    private function parseModule()
    {
        
        echo __METHOD__;
        /*
         * Get all files from Controller folder
         */
        $dirs=glob(DOCUMENT_ROOT . 'controllers/*.php');
        
        foreach($dirs as $dir)
        {
            /*
             * Include classes so that it will be posssible to reflect
             */
            require_once $dir;
            
            /*
             * File name AKA class name
             */
            $name=pathinfo($dir, PATHINFO_FILENAME);
            
            /*
             * Get available methods
             * All methods in controller class is public 
             */
            
            $reflClass=new ReflectionClass($name);
            $refMethods=$reflClass->getMethods();
            
            foreach ($refMethods as $method)
            {
                /*
                 * Remove controller from $name. $name is the name of controllers which
                 * used control a class. by naming convention it is {CLASS_NAME}Controller
                 */
                $module=str_ireplace('controller','',$name);
                
                /*
                 * Store action names in array where index is module name
                 * Stored as 2-D array
                 */
                $this->modules[$module][]=$method->getName();
                
                /*
                 * Filter the result
                 * Action also will contain constructor and destrcutor. Remove them
                 */
                $this->modules[$module]=  array_filter($this->modules[$module]
                                    ,function($input) use($name)
                                        {
                                            /*
                                             * Filter __constructor(),__destructor(), 
                                             * $name is class name in other word one way to declare
                                             * constructor
                                             * 
                                             * which needs to filter will return false
                                             */
                                             return !in_array($input,['__construct','__destruct',$name]);
                                        }
                                    );
            }
            
        }
        
       /*
        * Debug statement
        */
        var_dump($this->modules);
    }
    
    
    public function validate()
    {
        $this->parseModule();
        
        $domDoc=new DOMDocument();
        $domDoc->load(SETTING_ROOT . $this->settingObject);
        
        /*
         * Check all modules
         */
        $moduleNodes=$domDoc->getElementsByTagName('module');
        
        
        foreach($moduleNodes as $moduleNode)
        {
            /*
             * Module Node 'name' attribute must have the module name
             */
            if(!in_Array($moduleNode->getAttribute('name'),$this->modules))
            {
                /*
                 * it have not setting for that module
                 */
            }
            else
            {
                /*
                 * Check all action for that module
                 */
                foreach($moduleNode->getElementByTagName('action') as $action)
                {
                    /*
                     * Check if all action is there or not
                     */
                    if(!in_Array($action->getAttribute('name'),$this->modules[$moduleNode->getAttribute('name')]))
                    {
                        /*
                         * It have not all setting for action
                         */
                    }
                   
                }
                
            }
            
        }
         
    }
    
}
?>
