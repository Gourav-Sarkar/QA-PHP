<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'interfaces/VoteableInterface.php';
require_once 'interfaces/CRUDLInterface.php';
require_once 'models/crudObject.php';
require_once 'Abstracts/AbstractContent.php';
/**
 * Description of AbstractVote
 * @todo change name to weightedvote
 * @author Gourav Sarkar
 */
abstract class AbstractVote extends AbstractContent{
    
    const VOTE_UP="+";
    const VOTE_DOWN="-";
    
    
    protected $type=''; //Write only
    protected $weight;
    
    protected $dependency;




    //protected $votes;
    
    
    public function __construct(AbstractContent $content) {
        
        parent::__construct();

        $this->crud=new CRUDobject($this);
        $this->dependency=new DependencyObject($content);
        
        $this->crud->setFieldCache("ip");
        $this->ip=  ip2long($_SERVER['REMOTE_ADDR']);
        //Should be replaced with User::getAactiveUser() . default to current user
        $this->user=new User();
        
        
        
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
    
    public function setType($type)
    {
        $this->type=$type;
    }
    
    /*
     * @todo introduce core object to intrpduce $object->isEmpty()
     */
    public function setWeight()
    {
        $userID=$this->user->getID();
        assert('!empty($userID)');
        
        
        assert('!empty($this->type)');
        
        $this->crud->setFieldCache('weight');
        $this->weight= (string) $this->type . $this->user->getReputation();
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
    public static function listing(\DatabaseInteractbleInterface $reference) {
    }
  
}

?>
