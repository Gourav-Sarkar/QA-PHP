<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Abstracts/AbstractContent.php';
require_once 'models/questionVote.php';
require_once 'interfaces/VoteableInterface.php';
/**
 * Description of AbstractQuestion
 *
 * @author Gourav Sarkar
 */


abstract class AbstractQuestion 
extends AbstractContent 
implements VoteableInterface
{
    //put your code here
    protected $title;
    protected $votes;
    
    public function __construct() {
        parent::__construct();
        $this->votes=new QuestionVote($this);
        
    }
     public function setTitle($title)
    {
        $this->crud->setFieldCache('title');
        $this->title=$title;
    }
    
    public function getTitle()
    {
        return ucfirst($this->title);
    }
    /*
    public function read()
    {
        try
        {
            $cache=new QuestionCache($this);
            return $cache->read();
        }
        catch(CacheNotFoundException $e)
        {
     *      $cache->create();
            return parent::read();
        }
    }
     * */
   
}

?>
