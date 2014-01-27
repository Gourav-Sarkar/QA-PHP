<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Storages/ArticleCommentStorage.php';
require_once 'Models/ArticleComment.php';

require_once 'Storages/CommentStorage.php';
/**
 * Description of Article
 *
 * @author Gourav Sarkar
 */
class Article extends AbstractContent{
    //put your code here
    protected $commentList;
    protected $caption;
    protected $title;


    public function __construct() {
        parent::__construct();
        
        $this->commentList=new CommentStorage("ArticleComment");
    }
    
    public function setTitle($title)
    {
        $this->title=$title;
        $this->crud->setFieldCache("title");
    }
    public function getTitle()
    {
        return $this->title;
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
    
    
    public function read() {
        parent::read();
        //var_dump($this);
        
        $comment=new ArticleComment($this);
        
        $this->commentList= ArticleComment::listing($comment);
    }
    
    public function addComment(ArticleComment $comment)
    {
        $this->commentList->attach($comment,$comment);
        
        $comment->create();
    }
}

?>
