<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AbstractVote
 * @todo change name to weightedvote
 * @author Gourav Sarkar
 */
class AbstractVote {
    //put your code here
    use CRUDLTrait;
    
    const VOTE_UP="+";
    const VOTE_DOWN="-";
    
    protected static $connection;
    
    protected $id;
    protected $type; //Write only
    protected $ip;
    protected $user;
    protected $time;
    protected $weight;
    
    public function __construct(AbstractContent $content) {
        $this->setFieldCache("ip");
        $this->ip=  ip2long($_SERVER['REMOTE_ADDR']);
        $this->user=new User();
        
        
        
    }
    
    
    public function setID($id)
    {
        $this->id=$id;
        $this->setFieldCache('id');
    }
     public function setTime()
    {
        $this->time=time();
        $this->setFieldCache('time');
    }
     public function setUser(AbstractUser $user)
    {
        $this->user=$user;
        $this->setFieldCache('user');
    }
    
    //Should be removed instead of use databasehandleTrait
    public static function setConnection()
    {
        static::$connection=  DatabaseHandle::getConnection();
    }
    
    public function setType($type)
    {
        $this->type=$type;
    }
    
    
    public function setWeight()
    {
        
        //assert("!is_object($this->user)");
        
        $this->setFieldCache('weight');
        //echo $this->user->getReputation();
        $this->weight=$this->type.$this->user->getReputation();
    }
    
    
    

    public function getIP()
    {
        return $this->ip;
    }
    public function getUser()
    {
        return $this->user;
    }
    public function getTime()
    {
        return $this->time;
    }
    public function getWeight()
    {
        return $this->weight;
    }
    public function getID()
    {
        return $this->id;
    }
}

?>
