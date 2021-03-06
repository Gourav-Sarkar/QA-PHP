<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Storages/ArticleCommentStorage.php';
require_once 'Storages/ArticleStorage.php';
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
    public static function listing(\DatabaseInteractbleInterface $reference, $args = array()) {
        $pager=new Pagination(ROUTER_PAGE_IDF, 2);
        
        $articleStore=new ArticleStorage("Article");
        $articleStore->setPager($pager);
        
        $queryFrags=parent::listing($reference, array('pager'=>$pager));
        var_dump($queryFrags);
        
        $query=sprintf("%s %s",$queryFrags['main'],$queryFrags['limit']);
        
        var_dump($query);
        
        $stmt=DatabaseHandle::getConnection()->prepare($query);
        
        $stmt->execute();
        
        //Debug purpose
        while($data=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            var_dump($data);
        
            $objs=CRUDobject::map($data);  
            $objs['article']->setUser($objs['user']);
            $articleStore->attach($objs['article'], $objs['article']);
            //var_dump($objs);
        }
        //return $stmt->fetchAll();
        
        $pager->CountTotalPage();
        
        return $articleStore;
    }
}

?>
