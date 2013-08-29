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
    }
    public function show()
    {
        
    }
}

?>
