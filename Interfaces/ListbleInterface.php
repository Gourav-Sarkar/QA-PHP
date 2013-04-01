<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 * This interafce is used where any class have ability get lists of itself
 * Without specifying any id. Just list of array of object.
 * 
 * Get list should have p[aram to get specified id (to filter)
 */

/**
 *
 * @author Gourav Sarkar
 */
interface ListbleInterface {
    //put your code here
    public static function getList(AbstractContent $obj);
}

?>
