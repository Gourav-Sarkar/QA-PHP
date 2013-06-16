<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//require_once 'interfaces/RednerbleInterface.php';
/**
 * Description of SettingHandler
 * Handles setting 
 * Settings are XML files
 * @author Gourav Sarkar
 */
class SettingHandler 
//implements RenderbleInterface
{
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
    
    /*
    private function isLeafNode($node)
    {
        if(isset($node['type']))
        {
            return true;
        }
        
        return false;
        
    }
    
    public function Render(\Template $template) {
        ;
    }
     *
     */
}
   ?>
