<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Interfaces/VoteableInterface.php';
//require_once 'traits/DependebleTrait.php';
require_once 'Abstracts/AbstractContent.php';

require_once 'Storages/VoteStorage.php';
/**
 * Description of Comment
 *
 * @author Gourav Sarkar
 */
abstract class AbstractComment extends AbstractContent
    implements VoteableInterface
{
    //use DependebleTrait;
    //put your code here
    protected $dependency;
    
    protected $votes;

    public function __construct(AbstractContent $content)
    {
        parent::__construct();
        $this->dependency=new DependencyObject($content);
        $this->crud->setFieldCache((String) $content);
        $this->votes=new VoteStorage('AbstractComment');
        
        //echo __METHOD__;
        //var_dump($this->fieldCache);
       
    }
    
    
    
    /*
     * Overidden
     * It will be changed to parent method when derived classes will need seperate
     * identity (templates)
     */
     public function __toString() {
        return 'comment';
    } 
    
    
    
    
    
    public function upVote( $vote){
        
    }
     public function downVote( $vote){
        
    }
    
    public function setVotes(VoteStorage $votes)
    {
        $this->votes=$votes;
    }
    public function getVotes()
    {
        return $this->votes;
    }
    
    
   
}
?>
