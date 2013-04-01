<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'CachebleInterface.php';
/**
 * Description of ConfigParser
 *  This class will handle parsing of xml file
 * XML file will be parsed using expat parser
 * Parsed setting will be cached in APC for performance enhance
 * Without APC cache it will parse file one time per request. Same behaviour as
 * DatabasHandle File (Singleton)
 * Namspace for instance is the URI scheme of file
 * @author Gourav Sarkar
 */
class ConfigParser 
    implements Serializable
                ,CachebleInterface
    {
    //put your code here
    //Manage list of setting file
    private static $configList;
    private $name;
    private $file;
    private $cache;
    private $cacheKey='StackOverflow%sSetting';
    private $smp;
    
//    private function ConfigParser

    public function ConfigParser($file,$name)
    {
       $this->file=$file;
       $this->name=$name;
       $this->cacheKey=sprintf($this->cacheKey,$file);
    }
    
    
    
    public function parse()
    {
        if(apc_exists($this->cacheKey)){
            echo 'Cached setting';
            return unserialize($apce_fetch($this->cacheKey));
        }
        else {
           $this->smp=new SimpleXMLElement($this->file,NULL,true);
           return serialize($this);
        }
    }
    
    public function serialize()
    {
        foreach($this->smp as $node)
        {
            if($node instanceof SimpleXMLElement)
            {
                var_dump($node);
            }
        }
    }
    
    public function unserialize($serialized)
    {
    }     
}

$config=new ConfigParser("Setting/Setting.xml","core");
$cf=$config->parse();

var_dump($cf);

?>
