<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'interfaces/VoteableInterface.php';
require_once 'interfaces/CRUDLInterface.php';
require_once 'models/crudObject.php';
/**
 * Description of AbstractVote
 * @todo change name to weightedvote
 * @author Gourav Sarkar
 */
abstract class AbstractVote implements CRUDLInterface,VoteableInterface{
    
    const VOTE_UP="+";
    const VOTE_DOWN="-";
    
    protected static $connection;
    
    protected $id;
    protected $type; //Write only
    protected $ip;
    protected $user;
    protected $time;
    protected $weight;
    
    protected $crud;




    protected $votes;
    
    
    public function __construct(AbstractContent $content) {
        
        $this->crud=new CRUDobject($this);
        
        
        $this->crud->setFieldCache("ip");
        $this->ip=  ip2long($_SERVER['REMOTE_ADDR']);
        //Should be replaced with User::getAactiveUser() . default to current user
        $this->user=new User();
        
        
        
    }
    
    
    
    public function setVotes($votes)
    {
        $this->votes=$votes;
    }
    
    public function setID($id)
    {
        $this->id=$id;
        $this->crud->setFieldCache('id');
    }
     public function setTime()
    {
        $this->time=time();
        $this->crud->setFieldCache('time');
    }
     public function setUser(AbstractUser $user)
    {
        $this->user=$user;
        $this->crud->setFieldCache('user');
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
        
        $this->crud->setFieldCache('weight');
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
    public function getVotes()
    {
        return $this->votes;
    }
    
    public function upVote(\VoteableInterface $vote) {
        ;
    }
    
    public function downVote(\VoteableInterface $vote) {
        ;
    }
    
    
    public function read() {
        ;
    }
    public function delete() {
        ;
    }
    public function edit(\DatabaseInteractbleInterface $tempObj) {
        ;
    }
    public function create() {
        ;
    }

    public static function listing(\DatabaseInteractbleInterface $reference) {
        ;
    }
}

?>
