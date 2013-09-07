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
    private $user;
    
    public function __construct() {
        parent::__construct();

        $this->user=new User();
        $this->view->addTemplate("user");
    }
    
    public function create()
    {
        echo __METHOD__;
        $this->user->setNick($_POST['nick']);
        $this->user->setPassword($_POST['password']);
        $this->user->setEmail($_POST['email']);    
        $this->user->create();
    }
    public function auth()
    {
        echo __METHOD__;
        $this->user->setNick($_POST['nick']);
        $this->user->setPassword($_POST['password']);
        $this->user->auth();
    }
    public function show()
    {
        $this->view->setWrapper('userProfile');
        
        $this->user->setID($_GET['user']);
        //$this->user->read();
        $this->user->Softread();
        
        $this->view->addModel($this->user->xmlSerialize(),'inline-summary');
        
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
