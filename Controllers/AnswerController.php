<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'models/Question.php';
/**
 * Description of AnswerController
 *
 * @author Gourav Sarkar
 */
class AnswerController {
    //put your code here
    private $answer;
    
    public function __construct() {
        $question=new Question();
        
        $this->answer= new Answer($question);
        $this->answer->setID($_GET['answer']);
        Answer::setConnection(DatabaseHandle::getConnection());
    }
    
    public function addComment()
    {
       $comment = new AnswerComment($this->answer);
       $comment->setContent($_POST['content']);
       $comment->setTime();
       $comment->setUser($_SESSION['self']);
       //var_dump($comment);
       //var_dump($this->answer);
       $comment->create();
       $this->answer->addComment($comment);
    }
    
    public function selectAnswer()
    {
    }
    
}

?>
