<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NotifierTrait
 *
 * @author Gourav Sarkar
 */
trait NotifierTrait {
    //put your code here
    private $notification;
    
    public function getNotifier()
    {
        return $this->notification;
    }
    
    public function setNotifier($notifier)
    {
        $this->notification=$notifier;
    }
}

?>
