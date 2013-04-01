<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AbstractQuestion
 *
 * @author Gourav Sarkar
 */

require_once 'Abstracts/AbstractContent.php';

class AbstractQuestion extends AbstractContent{
    //put your code here
    protected $title;
    
    public function __construct() {
        parent::__construct();
        
    }
     public function setTitle($title)
    {
        $this->setFieldCache('title');
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
