<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Installer
 *
 * @author Gourav Sarkar
 */
class Installer {
    //put your code here
    
    private $executable;
    
    public function __construct() {
        $this->executable=new Phar();
    }
}

?>
