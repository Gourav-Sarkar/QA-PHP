<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Gourav Sarkar
 */
interface RelaySubject {
    //put your code here
    public function attach();
    public function detach();
    public function notify($message);
}

?>
