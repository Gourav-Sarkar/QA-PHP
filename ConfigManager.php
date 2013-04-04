<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ConfigManager
 *
 * @author Gourav Sarkar
 */
class ConfigManager implements CachebleInterface{
    //put your code 
    const PREFIX='cache';
    const CONFIG_PATH='/setting/setting.xml';
    
    private $config;
    
    public function __construct(AbstarctContent $object) 
    {
        $this->config=$this->get();
    }
    public function get()
    {
        if(!$data=apc_fetch($this->getKey()))
        {
            $this->config=simplexml($this->create());
            
        }
        else
        {
            $this->config=simplexml(static::CONFIG_PATH);
        }
    }
    
    public function getKey() {
        return sprintf("%s_%s" ,static::PREFIX,get_class($this));
    }
    
    public function create()
    {
        $config=new SimpleXMLElement($data, $options, $data_is_url, $ns, $is_prefix);
        /*
         * Store file data in cache and never expire
         */
        apc_store($this->getKey(),static::CONFIG_PATH);
        
        var_dump(__METHOD__ . 'hit');
    }
}

?>
