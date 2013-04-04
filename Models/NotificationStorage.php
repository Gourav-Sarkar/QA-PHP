<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Abstracts/AbstractContentObjectStorage.php';
/**
 * Description of NotificationStorage
 *
 * @author Gourav Sarkar
 */
class NotificationStorage
extends AbstractContentObjectStorage
implements SplObserver
{
    //put your code here
    public function update(SplSubject $subject)
    {
        
    }
}

?>
