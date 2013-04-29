<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Abstracts/AbstractSettingObject.php';
/**
 * Description of DefaultSettingObject
 *
 * @author Gourav Sarkar
 */
class DefaultSettingObject extends AbstractSettingObject{
    //put your code here
    
    public function __construct($object) {
        parent::__construct($object);
    }
    
    public function getKey()
    {
        return sprintf("core_setting_%s",$this->object);
    }
}

?>
