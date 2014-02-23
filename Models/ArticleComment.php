<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Abstracts/AbstractComment.php';
require_once 'Storages/CommentStorage.php';

/**
 * Description of ArticleComment
 *
 * @author Gourav Sarkar
 */
class ArticleComment extends AbstractComment {

    //put your code here


    public function getArticle() {
        return $this->dependency->getReference();
    }

    /*
     * @REPLACE with crudobject::listing()
     */

    public static function listing(\DatabaseInteractbleInterface $reference, $args = array()) {
        //parent::listing($reference, $args);
        $comments = new CommentStorage("ArticleComment");

        $query = sprintf("SELECT * FROM %s", $reference);

        //var_dump($query);
        if(!is_null($reference))
        {
            $query .= " WHERE article=?";
        }

        $stmt = DatabaseHandle::getConnection()->prepare($query);
        
        var_dump($query);
        
        $stmt->execute(
                array(
                    $reference->getArticle()->getID()
                )
        );


        
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            var_dump($data);

            $comment = new Articlecomment($reference->getArticle());

            $comment->setID($data['id']);
            $comment->setContent($data['content']);
            $comment->setTime($data['time']); //View layer need to be changed to capture missed time

            $comments->attach($comment, $comment);
        }

        return $comments;
    }

}

?>
