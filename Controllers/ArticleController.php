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
    public function show()
    {
        $this->model->setID($_GET['article']);
        $this->model->read();
        
        $this->view->addModel($this->model->xmlSerialize());
        
        echo $this->view->render();
        
    }
}

?>
