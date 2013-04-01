<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Gourav Sarkar
 */
interface PerimitableInterface {
    const PERM_CAN_CREATE=1;
    const PERM_CAN_UPDATE =2;
    const PERM_CAN_REMOVE=4;
    const PERM_CAN_SEE=8;
    //put your code here
    public function getPermission();
    public function setPermission();
    public function  hasPermission();
}

?>
