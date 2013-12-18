<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Gourav Sarkar
 */
interface CRUDLInterface {
    //put your code here
    /*
     * $data is an array which is consist of name value pair.
     * Name represents the property and
     */
    public function create();
    //public function delete();
    //public function update();
    public function read();
    public function edit(DatabaseInteractbleInterface $tempObj);
    public function delete();
    
    /*
     * @PARAM fixed $reference Object reference which should be matched
     * @PARAM $args Variable criteria
     */
    public static function listing(DatabaseInteractbleInterface $reference, $args=array());
    //public function delete();
}

?>
