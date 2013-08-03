<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once "Abstracts/AbstractContentObjectStorage.php";
require_once 'models/tag.php';
/**
 * Description of tagStorage
 *
 * @author Gourav Sarkar
 */

class tagStorage extends AbstractContentObjectStorage{
    //put your code here
   public function getHash($object) {
      return (string)$object->getName();
   }
}

?>
