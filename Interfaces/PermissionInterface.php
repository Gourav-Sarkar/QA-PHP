<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Gourav Sarkar
 */
interface PermissionInterface {
    //put your code here
    public function hasPermission(Resource $resource);
}

?>
