<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CounterAbleTrait
 *
 * @author Gourav Sarkar
 */
trait CounterTrait {
    //put your code here
    private $views=1;
    
    public function getViews()
    {
        return $this->views;
    }
    
    public function setViews($views)
    {
        $this->views=$views;
    }
    
    public function updateView()
    {
        //Static connection is used assuming it has already a DB connection
        //Assuming it has an id (Every object has id
        
        $query=sprintf("UPDATE %s SET views=views+1 WHERE id=?", __CLASS__);
        $stmt=static::$connection->prepare($query);
        
        $stmt->execute([$this->id]);
        
    }
}

?>
