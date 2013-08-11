<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Abstracts/AbstractPseudoObjectStorage.php';
/**
 * Description of RoleStorage
 *
 * @author Gourav Sarkar
 */
class RoleStorage extends AbstractPseudoObjectStorage{
    //put your code here
    
    public function getHash($object)
    {
        assert('$object instanceof Role');
        return (string) $object->getTitle();
    }
}

?>
