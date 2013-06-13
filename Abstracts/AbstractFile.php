<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AbstractFile
 *
 * @author Gourav Sarkar
 */
class AbstractFile extends SplFileObject{
    //put your code here
    const FILE_STORAGE_LOCATION='E:/wamp/DLC/';
    protected $setting;
    
  
    
    /*
     * Checks the file and move to a folder
     */
    public function upload()
    {
        
    }
    protected function hasValidExtension()
    {
        
    }
    protected function hasFileSize($byte)
    {
        
    }
    protected function hasValidResolution()
    {
        
    }
    
    /*
     * Generate a unique key for each item
     */
    public function getKey()
    {
        
    }
}

?>
