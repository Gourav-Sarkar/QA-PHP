<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Abstracts/AbstractVote.php';
/**
 * Description of QuestionVote
 *
 * @author Gourav Sarkar
 */
class QuestionVote extends AbstractVote{
    //put your code here
    protected $question;
    
    public function __construct(Question $content) {
        parent::__construct($content);
        //var_dump($content);
        $this->question=$content;
        $this->crud->setFieldCache(get_class($content));
        
        //$this->question->SetfieldCache("votes");
    }
    
    public function getQuestion()
    {
        return $this->question;
    }
}

?>
