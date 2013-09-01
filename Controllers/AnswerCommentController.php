<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Abstracts/AbstractController.php';
require_once 'Models/Question.php';
require_once 'Models/Answer.php';
/**
 * Description of CommentController
 * This could be implement in abstract and two different implementation could be done
 * Now Child of controller uses common name. If it is implemented __tostrin() will have 
 * default behaviour
 * @author Gourav Sarkar
 */
class AnswerCommentController extends AbstractController{
    //put your code here
    public function __construct() {
        parent::__construct();
        
        $this->view->addTemplate("comment");
        $this->view->addTemplate("user");
        $this->view->addTemplate("vote");
        
        
        $question=new Question();
        $answer=new Answer($question);
        
        if(isset($_GET['answer']))
        {
            $answer->setID($_GET['answer']);
        }
        $this->model=new AnswerComment($answer);
        $this->model->setID($_GET['answercomment']);
    }
    
    public function delete()
    {
        $comment = new AnswerComment(new Answer(new Question()));
        $comment->setID($_GET['answercomment']);
        
        $this->model->setInvisible();
        $this->model->edit($comment);
    }
}

?>
