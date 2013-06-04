<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Models/Article.php';
/**
 * Description of ArticleController
 *
 * @author Gourav Sarkar
 */
class ArticleController {
    //put your code here

    private $model;
    
    public function __construct() {
        $this->model=new Article();
    }
    public function show()
    {
        echo $this->model->render(new Template('Article'));
    }
}

?>
