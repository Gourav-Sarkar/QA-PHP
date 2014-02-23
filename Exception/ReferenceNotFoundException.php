<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ReferenceNotFoundException
 *
 * @author Gourav Sarkar
 */
class ReferenceNotFoundException extends Exception{
    //put your code here
    private $refrenceColumn;
    
    public function __construct($refCol) {
        $this->refrenceColumn=$refCol;
        parent::__construct();
    }
}

?>
