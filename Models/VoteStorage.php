<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Abstracts/AbstractContentObjectStorage.php';
/**
 * Description of VoteStorage
 *
 * @author Gourav Sarkar
 */
class VoteStorage extends AbstractContentObjectStorage{
    //put your code here
    protected $votes=0;
    
    public function getVotes()
    {
        return $this->votes;
    }
    public function setVotes($votes)
    {
        $this->votes=$votes;
    }
    
    
}

?>
