
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Abstracts/AbstractUniqueClassObjectStorage.php';
/**
 * Description of ObserverStorage
 *
 * @author Gourav Sarkar
 * 
 * One of a kind object storage
 */
class ObserverStorage extends AbstractUniqueClassObjectStorage{
    //put your code here
    
    private $message;
    
    public function getMessage()
    {
        return $this->message;
    }
    
    public function setMessage($msg)
    {
        $this->message=$msg;
    }
}

?>
