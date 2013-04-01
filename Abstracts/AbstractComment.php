<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Interfaces/VoteableInterface.php';
require_once 'traits/DependebleTrait.php';
require_once 'Abstracts/AbstractContent.php';
/**
 * Description of Comment
 *
 * @author Gourav Sarkar
 */
abstract class AbstractComment extends AbstractContent
    implements VoteableInterface
{
    use DependebleTrait;
    //put your code here
    
    public function __construct(AbstractContent $content)
    {
        parent::__construct();
        $this->setReference($content);
        //echo __METHOD__;
        //var_dump($this->fieldCache);
       
    }
    public function upVote(VoteableInterface $vote){
        
    }
     public function downVote(VoteableInterface $vote){
        
    }
    /*
     * Overidden
     * It will be changed to parent method when derived classes will need seperate
     * identity (templates)
     */
     public function __toString() {
        return 'comment';
    }
   
}
?>
