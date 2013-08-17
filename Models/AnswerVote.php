<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Abstracts/AbstractVote.php';

/**
 * Description of AnswerVote
 *
 * @author Gourav Sarkar
 */
class AnswerVote extends AbstractVote {

    //put your code here

    public function __construct(Answer $content) {
        parent::__construct($content);
        //var_dump($content);
        $this->crud->setFieldCache(get_class($content));

        //$this->question->SetfieldCache("votes");
    }

    public function getAnswer() {
        return $this->dependency->getReference();
    }

}

?>
