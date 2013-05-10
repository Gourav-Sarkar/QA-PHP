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
