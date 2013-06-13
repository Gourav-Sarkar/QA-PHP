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
    private $module;
    
    public function __construct($tobj) {
        $this->settingObject=new SimpleXMLElement(SETTING_ROOT. 'setting.xml',NULL,TRUE);
        $this->module=(string) $tobj;
    }
    
    /*
     * @todo Should have throw exception in case of noNodefound error
     */
    public function get($node)
    {
        //if node not found throw exception
        var_dump($this->module,$node);
        return (string)$this->settingObject->{$this->module}->$node;
    }
}
   ?>
