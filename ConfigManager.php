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
    //put your code here
    public function __construct($config) {
    }
    public function create()
    {
        apc_add($this->key);
    }
}

?>
