<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BaseObject
 *
 * @author Gourav Sarkar
 */
class BaseObject {
    //put your code here 
    //
    public function __toString() {
        return strtolower(get_class($this));
    }
    
     public function isEmpty()
    {
        return empty($this->id);
    }
    
    
}

?>
