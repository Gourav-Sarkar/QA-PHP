<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'Abstracts/AbstractController.php';
require_once 'models/answer.php';
require_once 'models/question.php';
/**
 * Description of UserController
 *
 * @author Gourav Sarkar
 */
class UserController extends AbstractController{
    //put your code here
    
    public function __construct() {
        parent::__construct();

        $this->model=new User();
        $this->view->addTemplate("user");
    }
    
    public function create()
    {
        echo __METHOD__;
        $this->model->setNick($_POST['nick']);
        $this->model->setPassword($_POST['password']);
        $this->model->setEmail($_POST['email']);    
        
        $this->model->create();
        
        $this->view->setMode(Render::MODE_FRAGMENT);
        $this->view->addModel($this->model->xmlserialize());
        
        echo $this->view->render();
    }
    public function auth()
    {
        echo __METHOD__;
        $this->model->setNick($_POST['nick']);
        $this->model->setPassword($_POST['password']);
        $this->model->auth();
    }
    public function show()
    {
        $this->view->setWrapper('userProfile');
        
        $this->model->setID($_GET['user']);
        //$this->user->read();
        $this->model->Softread();
        
        $this->view->addModel($this->model->xmlSerialize(),'inline-summary');
        
        /*
         * Get answer by user
         */
        $answer=new Answer(new Question());
        $answer->setUser(User::getActiveUser());
        $answerStorage=Answer::listing($answer);
        
        $this->view->addModel($answerStorage->xmlSerialize());
        /*
         * Get question by user
         */
        //$this->view->addModel();
        
        echo $this->view->Render();
        
    }
}

?>
