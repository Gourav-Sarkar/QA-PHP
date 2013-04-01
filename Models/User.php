<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Abstracts/AbstractUser.php';
/**
 * Description of User
 *
 * @author Gourav Sarkar
 */
class User Extends AbstractUser{
    //put your code here


    public function __construct()
    {
        parent::__construct();
        //$this->id=13;
    }
    
}

?>
