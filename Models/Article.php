<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'models/ArticleCommentStorage.php';
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
        
        $this->comments=new ArticleCommentStorage("ArticleComment");
    }
    
    public static function listing(\DatabaseInteractbleInterface $reference) {
        parent::listing($reference);
    }
}

?>
