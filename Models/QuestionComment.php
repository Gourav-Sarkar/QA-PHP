<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'Abstracts/AbstractComment.php';

/**
 * Description of QuestionComment
 *
 * @author Gourav Sarkar
 */
class QuestionComment extends AbstractComment{
    //put your code here
    
    public function __construct(Question $question) {
        parent::__construct($question);
        
        //echo __METHOD__;
    }
    /*
     * Comment listing
     * returns object in a storage which have only comment object (AbstractComment)
     */
    public static function listing(\DatabaseInteractbleInterface $reference, $args=array()) {
         $commentStore=new CommentStorage('QuestionComment');
        
         $query="SELECT
                *
                FROM questionComment
                WHERE question=? AND invisible=0";
         $stmt=  DatabaseHandle::getConnection()->prepare($query);
        $stmt->bindValue(1,$reference->getID());
        
        $stmt->execute();
        while($data=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            $comment=new QuestionComment($reference);
            $comment->setContent($data['content']);
            $comment->setID($data['id']);
            $comment->setTime($data['time']);
            
            $owner= new User();
            $owner->setID($data['user']);
            $comment->setUser($owner);
            
            $commentStore->attach($comment);
        }
        
        return $commentStore;
    }
    public function getQuestion()
    {
        return $this->dependency->getReference();
    }
    
   
}

?>
