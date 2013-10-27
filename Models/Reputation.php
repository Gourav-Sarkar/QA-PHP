<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Abstracts/AbstractContent.php';
require_once 'DefaultSettingObject.php';
/**
 * Description of Reputation
 * @todo Dependble to Other abstractContent: Reputation can not exist alone
 * @todo if Reputation needs to sort by how a user get or lost reputation it needs
 *  to add two fields (type and reference id) to reputation column
 * @todo If Reputation dont need sorting just add content field to database update Reputaion::setContent()
 * 
 * @author Gourav Sarkar
 */
class Reputation extends AbstractContent
    implements SplObserver
{
    
    //put your code here
    const SETTING_FILE_LOCATION="E:/wamp/www/stackoverflow/setting/"; //File name is class name
    
    private $reputation;
    
    //private $relayObject;
    
    public function __construct() {
        //var_dump("COnstructor is calling");
        
        parent::__construct();
        $this->setting=new DefaultSettingObject($this);
        
        //@todo
        static::$connection=  DatabaseHandle::getConnection();
    }
    
    /*
     * Subject is relayMediator type
     * @todo make it relay mediator=splobject+
     */
    public function update(\SplSubject $subject) {
        //$this->relayObject=$subject;
        //Ensure that subject is relay mediator
        assert('$subject instanceof RelayMediator');
        $origin=$subject->getOrigin();
        
        echo "Reputation notified";
        /*
         * get Reputation setting
         * update actor user reputation
         * update target user reputation
         * update reputation table for both entry
         */
        $reps=$this->parseSetting($origin, $subject->getRelayMessage());
        var_dump($reps);
        
        /*
         * Update user cache of reputation
         * If actor targets are same skip process
         * @TODO chain of command SetReps should return the object itself
         */
        if(!User::getActiveUser()->equals($origin->getUser()))
        {
            if(!empty($reps['actor']))
            {
                User::getActiveUser()->updateReputation($reps['actor']);
                
                $rep=new Reputation();
                $rep->setTime();
                //$rep->setContent('Rep has been adeed 1');
                $rep->setReputation($reps['actor']);
                $rep->setUser(User::getActiveUser());
                
                var_dump($rep);
                
                $rep->create();
            }
        
            if(!empty($reps['target']))
            {
                
                $rep=new Reputation();
                $rep->setTime();
                //$rep->setContent('Rep has been adeed 2');
                $rep->setReputation($reps['target']);
                $rep->setUser($origin->getUser());
                
                
                var_dump($rep);
                
                $rep->create();
            }
            
            
        }
    }
    
    private function parseSetting(AbstractContent $subject,$event)
    {
        
        /*
         * @todo callback parsing
         */
         
        /* 
        return $this->setting->parseSetting($subject
                                    ,$event
                                    ,function($action)
                                    {   
                                        $reps['actor']=(String)$action->actor;
                                        $reps['target']=(string)$action->target;
                                    }
                                    );
         * 
         */
        
        
        
        $reps=array();
        
        foreach($this->setting->get()->module as $module)
        {
            //var_dump($module);
            if($module['name']==(string)$subject)
            {
                //var_dump($module);
                
                foreach($module->action as $action)
                {
                    //var_dump($action);
                    //echo $event;
                    
                    if($action['name']==$event)
                    {
                        $reps['actor']=(String)$action->actor;
                        $reps['target']=(string)$action->target;
                        
                        return $reps;
                    }
                }
            }
            
        }
    }
    
    public function getReputation()
    {
        return $this->reputation;
    }
    public function setReputation($rep)
    {
        $this->setFieldCache('reputation');
        $this->reputation=$rep;
    }
    
    
    /*
     * update reputation cache of user
     */
    public function setUser(\User $owner=NULL) {
        //Get reputation from reputation object and assign it to user reputation
        $owner->setReputation($this->getReputation());
        //initiate user
        parent::setUser($owner);
        
        //update user reputation
        $this->user->updateReputation();
    }
    
}

?>
