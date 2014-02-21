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
class AbstractUniqueClassObjectStorage extends SplObjectStorage {

    //put your code here
    public function getHash($object) {
        return (string)$object;
    }
    
    /*
     * Get object by key name
     */
    public function getByKey($key) {
        foreach ($this as $object) {
            if ($this->key() == $key) {
                //var_dump("keyStore:$object");
                return $object;
            }
        }
    }

}

?>
