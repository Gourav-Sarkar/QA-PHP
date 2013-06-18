<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SettingParser
 *
 * @author Gourav Sarkar
 */
class SettingParser {
    //put your code here
    
    /*
     * If a node has a type that means it is leaf node and parser will not parse
     * nested level of it
     */
    private $settingFile;
    
    private function isLeafNode($node)
    {
        if(isset($node['type']))
        {
            return true;
        }
        
        return false;
        
    }
}

?>
