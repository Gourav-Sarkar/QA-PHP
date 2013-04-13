<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PermissionStorage
 *
 * @author Gourav Sarkar
 */
class PermissionStorage extends SplObjectStorage{
    //put your code here
    
    /*
     * Permission does not have id
     * Permission has resource id and role id which will be use as identifier 
     */
    public function getHash($object) 
    {
        //echo sprintf('%s',$object->getResource()->getID());
        //var_dump($object->getRole()->getID());
        //echo '<hr/>'; 
        
        //$roleID=$object->getRole()->getID();
        $resourceID=$object->getResource()->getID();
        
        //assert('!empty($roleID)');
        assert('!empty($resourceID)');
        
        
        
        return (string)sprintf('%s',$resourceID);
    }
    
    public function attach($object, $data = null) {
        var_dump(__METHOD__);
        parent::attach($object, $data);
    }
}

?>
