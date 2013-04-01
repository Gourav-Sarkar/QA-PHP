<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Notification
 *
 * @author Gourav Sarkar
 */
class Notification extends AbstractContent{
    //put your code here
   
    /*
     * Notification should not be edited
     */
    
    public function create() 
    {
        
    }
    public function edit(\AbstractContent $tempObj) {
        trigger_error("BLOCKED method", E_USER_ERROR);
    }
    public function delete() {
       
    }
    public static function listing(\AbstractContent $reference) {
        ;
    }
    
    public function getParticipant()
    {
        /*
         * Who should be notified?
         *  Notify object owner about each interaction of what other is doin on the object
         *  There could be dependent object. if action is taken on dependent object owner object owner will be notified along with
         *      dependent object owner
         * Get Speoprties which have storage and represents database interactble object
         * Get
         */
    }
    
   
}

?>
