<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Abstracts/AbstractComment.php';
/**
 * Description of AnswerComment
 *
 * @author Gourav Sarkar
 */
class AnswerComment extends AbstractComment{
    //put your code here
    
    public function getAnswer()
    {
        return $this->dependency->getReference();
    }
}

?>
