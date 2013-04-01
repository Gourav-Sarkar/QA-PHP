<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Gourav Sarkar
 */
interface AnswerableInterface {
    //put your code here
    public function giveAnswer(AnswerableInterface $answer);
    public function editAnswer(AnswerableInterface $answer);
    public function showAnswer(AnswerableInterface $answer,ViewableInterface $view);
    //public function set
}

?>
