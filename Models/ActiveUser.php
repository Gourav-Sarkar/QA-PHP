<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ActiveUser
 * Singleton class for active user
 * 
 * No matter it is authenticated or guest user every request is made by some user
 *  That is active user.Every action taken on will be behalf of active user
 * @author Gourav Sarkar
 */
class ActiveUser {
    //put your code here
    static $user;
    
    public static function getUser()
    {
        $id=static::$user->getID();
        if(!empty($id))
        {
            //User is authenticated has session variable
        }
        else
        {
            //Get
        }
    }
}

?>
