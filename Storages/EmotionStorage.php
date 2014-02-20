<?php
require_once 'abstracts/AbstractContentObjectStorage.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EmotionStorage
 *
 * @author gourav sarkar
 */
class EmotionStorage extends AbstractContentObjectStorage{
    //put your code here
    /*
    public function getHash($object) {
        assert('$object instanceof ' . $this->storageType);
        $id = $object->getEmotion();
        //echo $id;
        //Ensure id is there
        assert('!empty($id);');
        return (string) $id;
    }
     * 
     */
}

?>
