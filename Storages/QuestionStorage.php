<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once "Abstracts/AbstractContentObjectStorage.php";
/**
 * Description of QuestionStorage
 *
 * @author Gourav Sarkar
 */
class QuestionStorage extends AbstractContentObjectStorage{
    //put your code here
    /*
   public function getHash(Question $object) {
        return parent::getHash($object);
    }
     * 
     */
    
    public function attach($object, $data = null) {
        $id=$object->getID();
        
        assert($object instanceof AbstractQuestion);
        assert('isset($id)');
        
        return parent::attach($object, $data);
    }
}

?>
