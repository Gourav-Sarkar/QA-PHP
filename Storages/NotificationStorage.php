<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Abstracts/AbstractContentObjectStorage.php';
require_once 'interfaces/CRUDLInterface.php';
/**
 * Description of NotificationStorage
 *
 * @author Gourav Sarkar
 */
class NotificationStorage
extends AbstractContentObjectStorage
implements SplObserver
            ,CRUDLInterface
{
    //put your code here
    public function getHash($object) {
        return (string) $object->getUser()->getID();
    }
    public function update(SplSubject $subject)
    {
        
    }
    
    public function create()
    {
        var_dump(__METHOD__);
        foreach($this as $obj)
        {
            echo "loop";
            $obj->create();
        }
    }
    
    public function delete() {
        throw new BadMethodCallException("Invalid method call");
    }
    public function edit(\DatabaseInteractbleInterface $tempObj) {
        throw new BadMethodCallException("Invalid method call");
    }
    public static function listing(\DatabaseInteractbleInterface $reference,$args=array()) {
        throw new BadMethodCallException("Invalid method call");
    }
    public function read() {
        throw new BadMethodCallException("Invalid method call");
    }
}

?>
