<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RoleStorage
 *
 * @author Gourav Sarkar
 */
class RoleStorage extends SplObjectStorage{
    //put your code here
    
    public function getHash($object)
    {
        assert('$object instanceof Role');
        return (string) $object->getTitle();
    }
}

?>
