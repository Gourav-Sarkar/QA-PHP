<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Abstracts/AbstractPseudoObjectStorage.php';
require_once 'Abstracts/AbstractContentObjectStorage.php';
/**
 * Description of ResourceStorage
 *
 * @author Gourav Sarkar
 */
class ResourceStorage extends AbstractContentObjectStorage{
    //put your code here
    public function getHash($object) {
        return (string) $object->getID();
    }
    
}

?>
