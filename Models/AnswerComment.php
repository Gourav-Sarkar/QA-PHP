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
    
    public function __construct(Answer $answer)
    {
        parent::__construct($answer);
        //echo __METHOD__;
        $this->votes=new VoteStorage('AnswerComment');
        
    }
    
    public function getAnswer()
    {
        return $this->dependency->getReference();
    }
}

?>
