<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'models/Question.php';
require_once 'Abstracts/AbstractController.php';

/**
 * Description of AnswerController
 *
 * @author Gourav Sarkar
 */
class AnswerController extends AbstractController {

    //put your code here
    private $answer;

    public function __construct() {
        parent::__construct();

        $question = new Question();

        $this->answer = new Answer($question);
        $this->answer->setID($_GET['answer']);
    }

    public function addComment() {
        $comment = new AnswerComment($this->answer);
        $comment->setContent($_POST['content']);
        $comment->setTime();
        $comment->setUser($_SESSION['self']);
        //var_dump($comment);
        //var_dump($this->answer);
        $comment->create();
        $this->answer->addComment($comment);
        
        
         $this->view->setMode(RENDER::MODE_FRAGMENT);
        $this->view->setModel($comment->xmlSerialize());
        echo $this->view->render();
    }

    public function selectAnswer() {
        
    }

    public function upVote() {
        echo __METHOD__;

        //it needs transaction
        $this->answer->upvote(null);
    }

    public function downVote() {
        echo __METHOD__;

        $this->answer->downvote(null);
    }

}

?>
