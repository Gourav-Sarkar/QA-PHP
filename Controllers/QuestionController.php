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
require_once DOCUMENT_ROOT . 'Storages/NotificationStorage.php';

class QuestionController {

    //put your code here
    private $question;
    private $view;

    public function QuestionController() {

        $this->view = new Render();
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
        //Question Controller must have Question object
        $this->question = new Question();
        
        (isset($_GET['question'])) ? $this->question->setID($_GET['question']) : '';



        /*
         * RelayMediator will propogate message event to other observer
         * Enlisted observers are cache,notification,reputation
         */
        //$this->observers->attach(new SiteMapManager());
        //$notificationObject=new Notification();
        //$notificationObject->setTarget(["comments","answers"]);
        //$this->question->attach(new Reputation());
        //$this->question->attach($notificationObject);
        /*
         * Add notifier to the controller 
         */
    }

    /*
     * Question asking heandler
     * @todo static template loading Template class
     */

    public function ask() {
        require 'Templates/Question/Question-form-view.php';

        if (isset($_POST['ask'])) {
            $this->question->setTitle($_POST['title']);
            $this->question->setContent($_POST['content']);
            $this->question->setUser(User::getActiveUser());
            $this->question->setTags($_POST['tags']);
            $this->question->setTime();
            //var_dump($this->question);


            $this->question->create();
        }
    }

    public function edit() {

        $queryObj = new Question();
        $queryObj->setID($_GET['question']);


        if (isset($_POST['edit'])) {

            $this->question->setTitle($_POST['title']);
            $this->question->setContent($_POST['content']);
            $this->question->setUser($_SESSION['self']);
            $this->question->setTime();

            $this->question->edit($queryObj);
        }
    }

    public function answer() {



        $ans = new Answer($this->question);
        $ans->setUser($_SESSION['self']);
        $ans->setContent($_POST['answer']);
        $ans->setTime();


        //var_dump($this->question);
        $this->question->addAnswer($ans);
    }

    /*
     * Comment handler of question
     */

    public function addComment() {


        $comment = new QuestionComment($this->question);
        $comment->setContent($_POST['content']);
        $comment->setTime();
        $comment->setUser(User::getActiveUser());

        $this->question->addComment($comment);
        $this->question->relay(__FUNCTION__);
        
        $this->view->setMode(RENDER::MODE_FRAGMENT);
        $this->view->setModel($comment->xmlSerialize());
        echo '<hr/>';
        echo $this->view->render();

        /*
         * Relay event
         */
    }

    public function show() {
        //echo _("GETTEXT");
        //echo __METHOD__;


        //Read should update the object instead of return any object
        try {
            $question = $this->question->read();
            //var_dump($question);
            //$question->updateView();

            $this->view->setModel($question->xmlSerialize());
            $this->view->setDumper(DOCUMENT_ROOT . 'dump.xml');
            echo $this->view->render();

            //echo Utility::getLink($this->question,'doSomething');

            /*
             * @debug
             * Test question serializing
             */
            /*
              foreach($question->getAnswers() as $answer)
              {
              echo unserialize(serialize($answer));
              }
             * 
             */
        } catch (NoEntryFoundException $e) {
            //Send 404 header
            //echo "no found";
            //var_dump(ob_get_status());
            header("HTTP/1.0 404 Not Found");
            die("404 PAGE NOT FOUND");
        }
        //echo $template->render();
        //var_dump($this->question);
    }

    public function getList() {
        //$questionList = Question::getList();
        //var_dump($questionList);
        /*
         * new Pagaination()
         */
        try {
            $ques = new Question();

            $pager = new Pagination($ques);
            $pager->setPage($_GET['page']);


            if (isset($_GET['tags'])) {
                $ques->setTags(implode(',', $_GET['tags']));
            }
        } catch (Exception $e) {
            //Ignore exception
        }

        $questions = Question::listing($ques);

        $this->view->setModel($questions->xmlSerialize());
        $this->view->setDumper(DOCUMENT_ROOT . 'dump.xml');

        echo $this->view->render();
    }

    public function selectAnswer() {


        $ans = new Answer();
        $ans->setID($_GET['answer']);
        $this->question->setSelectedAnswer($ans);
    }

    public function upVote() {
        echo __METHOD__;

        //it needs transaction
        $this->question->upvote(null);
    }

    public function downVote() {
        echo __METHOD__;
        
        $this->question->downvote(null);
    }

    public function delete() {
        echo __METHOD__;



        //$this->question->setUser(User::getActiveUser());
    }

    public function getRevisions() {



        $qrev = new QuestionRevision($this);
        echo $qrev->render(new Template("templates/question-revision-view.php"));
    }

    public function close() {
        echo __METHOD__;
    }

    public function open() {
        echo __METHOD__;
    }

    public function remove() {
        echo __METHOD__;
    }

    public function stream() {
        header("content-type:text/xml");
        echo $this->question->render(new Template('question-stream'));
    }

    public function __destruct() {
        
    }

}

?>
