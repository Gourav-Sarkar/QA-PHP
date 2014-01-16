<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Models/ArticleCommentStorage.php';
require_once 'Models/ArticleComment.php';

require_once 'Storages/CommentStorage.php';
/**
 * Description of Article
 *
 * @author Gourav Sarkar
 */
class Article extends AbstractContent{
    //put your code here
    private $comments;
    private $caption;
    
    public function __construct() {
        parent::__construct();
        
        $this->comments=new CommentStorage("ArticleComment");
    }
    
    
    public function setCaption($caption)
    {
        $this->caption=$caption;
        $this->crud->setFieldCache("caption");
    }
    public function getCaption()
    {
        return $this->caption;
    }
    
    public static function listing(\DatabaseInteractbleInterface $reference,$args=array()) {
        parent::listing($reference);
    }
    
    public function read() {
        parent::read();
        //var_dump($this);
        
        $comment=new ArticleComment($this);
        
        $this->comments= ArticleComment::listing($comment);
    }
}

?>
