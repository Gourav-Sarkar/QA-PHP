<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RoleUserMapper
 *
 * @author Gourav Sarkar
 */
class RoleUserMapper {
    //put your code here
    private $role;
    private $user;
    
    public function __construct()
    {
        $this->user=new User();
        $this->role=new Role();
    }
    
    public function get()
    {
        /*
         * get what field cache is set for all the object
         */
    }
}

?>
