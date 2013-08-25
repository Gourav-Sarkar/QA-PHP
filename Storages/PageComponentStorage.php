<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Abstracts/AbstractContentObjectStorage.php';
/**
 * Description of PageComponentStorage
 *
 * @author Gourav Sarkar
 */
class PageComponentStorage extends AbstractContentObjectStorage {
    //put your code here
    
    public function getHash($object) {
        $title=$object->getTitle();
        
        return $title;
    }
}

?>
