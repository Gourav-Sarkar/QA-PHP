<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QuestionController
 *
 * @author Gourav Sarkar
 */
require_once 'models/Question.php';
require_once 'models/Notification.php';
require_once 'models/NotificationStorage.php';
class QuestionController {
    //put your code here
    private $question;
    
    public function QuestionController()
    {
        //Without question There can't have any other action
        //There is though exception like when asking question those should be handled in static method
        /*
        if(!isset($_POST['question']))
        {
            trigger_error("Unable to do any action. Question is not available", E_USER_ERROR);
        }
        
         * 
         */
        //Set global connection
        //require_once ''
        AbstractContent::setConnection(DatabaseHandle::getConnection());
        //Question Controller must have Question object
        $this->question= new Question();
        
        
         
        /*
         * RelayMediator will propogate message event to other observer
         * Enlisted observers are cache,notification,reputation
         */
        //$observerList->attach(new QuestionCache($this->question));
        //$this->observers->attach(new SiteMapManager());
        $notificationObject=new Notification();
        $notificationObject->setTarget(["comments","answers"]);
        
        $this->question->attach(new Reputation());
        $this->question->attach($notificationObject);
        /*
         * Add notifier to the controller 
         */
        
        
    }
    /*
     * Question asking heandler
     */
    public function ask()
    {
        $this->question->setTitle($_POST['title']);
        $this->question->setContent($_POST['content']);
        $this->question->setUser($_SESSION['self']);
        $this->question->setTags($_POST['tags']);
        $this->question->setTime();
        //var_dump($this->question);
        
        
        $this->question->create();
    }
    
    public function edit()
    {
        require_once 'templates/Question-form-edit-view.html';
        
        $queryObj= new Question();
        $queryObj->setID($_GET['question']);
        
        
        if(isset($_POST['edit']))
        {
            
            $this->question->setTitle($_POST['title']);
            $this->question->setContent($_POST['content']);
            $this->question->setUser($_SESSION['self']);
            $this->question->setTime();
            
            $this->question->edit($queryObj);
        }
    }
    
    public function answer()
    {
         
        
        $this->question->setID($_GET['question']);
        
        $ans= new Answer($this->question);
        $ans->setUser($_SESSION['self']);
        $ans->setContent($_POST['answer']);
        $ans->setTime();
        
        
         var_dump($this->question);
        $this->question->addAnswer($ans);
    }
    
    /*
     * Comment handler of question
     */
    public function addComment()
    {
        
        $this->question->setID($_GET['question']);
        
        $comment= new QuestionComment($this->question);
        $comment->setContent($_POST['content']);
        $comment->setTime();
        $comment->setUser($_SESSION['self']);
        
        $this->question->addComment($comment);
        $this->question->relay(__FUNCTION__);
        
        /*
         * Relay event
         */
    }
    public function show()
    {
        //echo _("GETTEXT");
        
        $this->question->setID($_GET['question']);
        $this->question->setConnection(DatabaseHandle::getConnection());
        
        //Read should update the object instead of return any object
        try
        {
            $question=$this->question->read();
            //var_dump($question);
            $question->updateView();
            echo $question->render(new Template('Question'));
        }
        catch(NoEntryFoundException $e)
        {
            //Send 404 header
            //echo "no found";
            //var_dump(ob_get_status());
            header("HTTP/1.0 404 Not Found");
            die("404 PAGE NOT FOUND");
        }
        //echo $template->render();
    }
    
    public function getList()
    {
        //$questionList = Question::getList();
        //var_dump($questionList);
        /*
         * new Pagaination()
         */
        echo $this->question->render(new Template('Question-list'));
        
    }
    
    public function selectAnswer()
    {
        
        $this->question->setID($_GET['question']);
        
        $ans = new Answer();
        $ans->setID($_GET['answer']);
        $this->question->setSelectedAnswer($ans);
    }
    
    public function upVote()
    {
        echo __METHOD__;
        
        //it needs transaction
        $this->question->upvote();
    }
    
    public function downVote()
    {
        echo __METHOD__;
        
        $this->question->downvote();
    }
    
    public function delete()
    {
        echo __METHOD__;
        
        $this->question->setID($_GET['question']);
        
        $this->question->setUser($_SESSION['self']);
        $this->question->delete();
    }
    
    public function getRevisions()
    {
        
        $this->question->setID($_GET['question']);
        
        $qrev=new QuestionRevision($this);
        echo $qrev->render(new Template("templates/question-revision-view.php"));
        
    }
    
    public function close()
    {
        echo __METHOD__;
    } 
    public function open()
    {
        echo __METHOD__;
    } 
    public function remove()
    {
        echo __METHOD__;
    }
    
    public function __destruct() {
    }
}

?>
