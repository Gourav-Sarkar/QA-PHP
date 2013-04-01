<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Gourav Sarkar
 */
interface CommentableInterface {
    //put your code here
    public function addComment(AbstractComment $comment);
    /*
     * If a class implements this interface then it has child table of comments
     * Every child class(non-iherited) needs a parent class to get access of its child
     * class data
     */
    public function getComments();
    /*
    public function removeComment(CommentableInterface $comment);
    public function editComment(CommentableInterface $comment);
    public function showComment(CommentableInterface $comment,ViewableInterface $view);
     * 
     */
}

?>
