<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'CRUDInterface.php';
/**
 * Description of FileCache
 * Can cache Database data in fileSystem. This class will extends to more core
 * and dedicated functionality. it can have handle XML,plain text,ATOM,RSS etc
 * 
 * @author Gourav Sarkar
 */
abstract class AbstractFileCache 
    implements CRUDInterface
                ,SplObserver
{
    //put your code here
    private $reference; //Reference of object to cache
    private $fileURI;
    
    public function __construct()
    {
        
    }
    
    /* Set rule for storing cache file in filesystem
     * Extened class must implement it
     */
    //abstract private function setFileURI();
    

    public function save($data){
        
    }
    
    public function get() {
    
    }
    
  

    
    
}

?>
