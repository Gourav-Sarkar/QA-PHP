<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Abstracts/abstractController.php';
require_once 'Models/Question.php';
/**
 * Description of QuestionCommentController
 *
 * @author Gourav Sarkar
 */
class QuestionCommentController extends AbstractController {
    //put your code here
    private $questionComment;
    
    public function __construct() {
        parent::__construct();

        $ques= new Question();
        $ques->setID($_GET['question']);
        
        $this->model=new QuestionComment($ques);
        $this->model->setID($_GET['questioncomment']); //Add model __tostring()
    }
    
    public function delete()
    {
        $comment = new QuestionComment(new Question());
        $comment->setID($_GET['questioncomment']); //Add model __tostring()
        
        $this->model->setInvisible();
        $this->model->edit($comment);
    }
}

?>
