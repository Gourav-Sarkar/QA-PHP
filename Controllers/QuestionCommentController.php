<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QuestionCommentController
 *
 * @author Gourav Sarkar
 */
class QuestionCommentController {
    //put your code here
    private $questionComment;
    
    public function __construct($module) {
        echo "foo";
        $ques= new Question();
        $ques->setID($_GET['question']);
        
        $this->questionComment=new QuestionComment($ques);
        $this->questionComment->setID($_GET[$module]);
        var_dump($this->questionComment);
        $this->questionComment->setConnection(DatabaseHandle::getConnection());
    }
    
    public function delete()
    {
        echo __METHOD__;
        $this->questionComment->delete();
    }
}

?>
