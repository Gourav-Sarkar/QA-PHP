<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * This trait is used in those componenet which can be soft deleted or hidden
 * trait data is private to make sure that this trait is used where it is itneded
 * @author Gourav Sarkar
 */
trait softDeletebleTrait
{
    private $delete;
    public function getDelete()
    {
        
    }
    
    public function setDelete($del)
    {
        assert("is_bool($del);");
        $this->delete=$del;
    }
}

?>
