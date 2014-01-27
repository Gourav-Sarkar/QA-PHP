<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Models/Article.php';
require_once 'Abstracts/AbstractController.php';
/**
 * Description of ArticleController
 *
 * @author Gourav Sarkar
 */
class ArticleController extends AbstractController{
    //put your code here
    
    public function __construct() {
        parent::__construct();
        $this->model=new Article();
        
        $this->view->addTemplate("comment");
        $this->view->addTemplate("user");
        $this->view->addTemplate("vote");
        $this->view->addTemplate("tag");
        $this->view->addTemplate("article");
    }
    public function getList()
    {
        $query=Article::listing(new Article());
        var_dump($query);
        
        //$this->view->addModel($this->model->xmlSerialize());
    }
    
    public function show()
    {
        $this->model->setID($_GET['article']);
        $this->model->read();
        
        $this->view->addModel($this->model->xmlSerialize());
        
        echo $this->view->render();
        
    }
    public function create()
    {
        $this->model->setTitle($_POST['title']);
        $this->model->setContent($_POST['content']);
        $this->model->setCaption($_POST['caption']);
        $this->model->setTime();
        $this->model->setInvisible(false);
        $this->model->setUser(User::getActiveUser());
        $this->model->setIp();
        
        $this->model->create();
    }
    
    public function addComment()
    {

        $comment = new ArticleComment($this->model);
        $comment->setContent($_POST['content']);
        $comment->setTime();
        $comment->setUser(User::getActiveUser());

        $this->model->addComment($comment);
       // $this->question->relay(__FUNCTION__);

        $this->view->setMode(RENDER::MODE_FRAGMENT);
        $this->view->addModel($comment->xmlSerialize());
        echo $this->view->render();

        /*
         * Relay event
         */

        
    }
}

?>
