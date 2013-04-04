<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AbstractUniqueClassObjectStorage
 *
 * @author Gourav Sarkar
 */
class AbstractUniqueClassObjectStorage 
    extends SplObjectStorage
{
    //put your code here
    
    public function getHash($object)
    {
        return get_class($object);
    }
}

?>
