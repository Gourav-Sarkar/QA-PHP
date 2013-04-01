<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Gourav Sarkar
 */
interface VoteableInterface {
    //put your code here
    public function upVote(VoteableInterface $vote);
    public function downVote(VoteableInterface $vote);
    
}

?>
