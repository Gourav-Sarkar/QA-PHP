<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Interfaces/CachebleInterface.php';
require_once 'Exception/NoExtensionInstalledException.php';
/**
 * Description of AbstractSettingObject
 *
 * @author Gourav Sarkar
 */
abstract class AbstractSettingObject 
    implements 
    CachebleInterface
    ,Serializable
{
    //put your code here
    
    protected $object;
    protected $setting;
    
    protected $moduleNode;
    
    public function __construct($object) {
        
        /*
         * Verify APC module
         */
        
         $this->object=$object;
         $this->setting=new SimpleXMLElement($this->getFile(),null,true);
              
              /*
        try 
        {
            
            $this->object=$object;
            
            if(!extension_loaded('apc'))
            {
                throw new NoExtensionInstalledException("APC is not installed");
            }
        //Get data from cache and make and simple xml object
            try
            {
                $this->setting=new SimpleXMLElement($this->read());
            }
            catch(NoEntryFoundException $e)
            {
                echo "No cache for $object";
            
                $this->setting=new SimpleXMLElement($this->getFile(),null,true);
                $suc=apc_add($this->getKey(),$this->setting->asXML());
            }
        }
        catch(NoExtensionInstalledException $e)
        {
              $this->setting=new SimpleXMLElement($this->getFile(),null,true);
        }
        */
        
        /*
         * Initialize module node
         */
        //$this->initModule();
    }
    
    public function create() {
        throw new BadMethodCallException();
    }
    
    public function edit(\DatabaseInteractbleInterface $tempObj) {
        throw new  BadMethodCallException();
    }
    
    public function read() {
        
        if(!$data=apc_fetch($this->getKey()))
        {
            var_dump($data);
            throw new NoEntryFoundException("No file for setting of {$this->object}");
        }
        
        return $data;
    }
    
    public function delete() {
        throw new BadMethodCallException();;
    }
    
    public static function listing(\DatabaseInteractbleInterface $reference,$args=  array()) {
        throw new BadMethodCallException();;
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
    
    
    /*
     * @PARAM $callback return inside data
     * @TODO make it interface
     */
    
    /*
    public function parseSetting(AbstractContent $subject,$event,$callback)
    {
        foreach($this->setting->module as $module)
        {
            //var_dump($module);
            if($module['name']==(string)$subject)
            {
                //var_dump($module);
                
                foreach($module->action as $action)
                {
                    //var_dump($action);
                    //echo $event;
                    
                    if($action['name']==$event)
                    {
                        return $callback($action);
                    }
                }
            }
            
        }
    }
     * 
     */
    
    
    public function serialize() {
        //Discard SIMPLEXML setting object
        unset($this->setting);
    }
    
    public function unserialize($serialized) {
        static::__construct();
    }
    
}

?>
