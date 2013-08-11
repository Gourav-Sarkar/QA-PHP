<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Abstracts/AbstractPseudoObjectStorage.php';
/**
 * Description of PermissionStorage
 *
 * @author Gourav Sarkar
 */
class PermissionStorage extends AbstractPseudoObjectStorage{
    //put your code here
    
    /*
     * Permission does not have id
     * Permission has resource id and role id which will be use as identifier 
     */
    public function getHash($object) 
    {
        assert('$object instanceof permission');
        
        //assert(false);
        //echo sprintf('%s <hr/>',$object->getResource()->getID());
        //var_dump($object->getRole()->getID());
        
        //$roleID=$object->getRole()->getID();
        $resourceID=$object->getResource()->getID();
        
        //assert('!empty($roleID)');
        assert('!empty($resourceID)');
        
        
        
        return (string) $resourceID;
    }
}

?>
