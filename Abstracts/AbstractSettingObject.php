<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Interfaces/CachebleInterface.php';
/**
 * Description of AbstractSettingObject
 *
 * @author Gourav Sarkar
 */
class AbstractSettingObject implements CachebleInterface
{
    //put your code here
    
    private $object;
    private $setting;
    
    private $moduleNode;
    
    public function __construct($object) {
        $this->object=$object;
        //Get data from cache and make and simple xml object
        try
        {
            $this->setting=new SimpleXMLElement($this->read());
        }
        catch(NoEntryFoundException $e)
        {
            $this->setting=new SimpleXMLElement($this->getFile(),null,true);
            apc_add($this->getKey(),$this->setting->asXML());
        }
        
        /*
         * Initialize module node
         */
        //$this->initModule();
    }
    
    public function create() {
        throw new BadMethodCallException();
    }
    
    public function edit(\DatabaseInteractbleInterface $tempObj) {
        throw new BadMethodCallException();
    }
    
    public function read() {
        if(!$data=apc_fetch($this->getKey()))
        {
            throw new NoEntryFoundException("No file for setting of {$this->object}");
        }
        
        return $data;
    }
    
    public function delete() {
        throw new BadMethodCallException();;
    }
    
    public static function listing(\DatabaseInteractbleInterface $reference) {
        throw new BadMethodCallException();;
    }

    public function getKey()
    {
        return sprintf("core_setting_%s",$this->object);
    }
    
    
    /*
     * @deprecated
     */
    private function initModule()
    {
        foreach($this->setting->module as $module)
        {
            if($module->getName()==$this->object)
            {
                $this->moduleNode=$module;
                return $module;
            }
        }
    }
    
    public function getSetting()
    {
        return $this->setting;
    }
    private function getFile()
    {
        var_dump($this->object);
        return sprintf("%s%s.%s",SETTING_ROOT,  $this->object,'xml');
    }
    public function get()
    {
        return $this->setting;
    }
    
}

?>
