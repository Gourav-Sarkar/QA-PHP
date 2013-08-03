<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Abstracts/AbstractContent.php';
require_once 'Storages/voteStorage.php';
require_once 'interfaces/VoteableInterface.php';
/**
 * Description of AbstractQuestion
 *
 * @author Gourav Sarkar
 */


abstract class AbstractQuestion 
extends AbstractContent 
{
    //put your code here
    protected $title;
    
    public function __construct() {
        parent::__construct();
        
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
