<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Models/ArticleCommentStorage.php';
require_once 'Storages/CommentStorage.php';
/**
 * Description of Article
 *
 * @author Gourav Sarkar
 */
class Article extends AbstractContent{
    //put your code here
    private $comments;
    
    public function __construct() {
        parent::__construct();
        
        $this->comments=new CommentStorage("ArticleComment");
    }
    
    public static function listing(\DatabaseInteractbleInterface $reference) {
        parent::listing($reference);
    }
}

?>
