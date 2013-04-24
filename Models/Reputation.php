<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Abstracts/AbstractContent.php';
require_once 'DefaultSettingObject.php';
/**
 * Description of Reputation
 *
 * @author Gourav Sarkar
 */
class Reputation extends AbstractContent
    implements SplObserver
               ,Serializable
{
    
    //put your code here
    const SETTING_FILE_LOCATION="E:/wamp/www/stackoverflow/setting/"; //File name is class name
    
    private $reputaion;
    private $setting;
    
    //private $relayObject;
    
    public function __construct() {
        var_dump("COnstructor is calling");
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
        $reps=$this->fetchReputation($origin, $subject->getRelayMessage());
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
                $user=User::getActiveUser()->updateReputation($reps['actor']);
                
                $rep=new Reputation();
                $rep->setTime();
                $rep->setContent('Rep has been adeed 1');
                $this->setReputation($reps['actor']);
                $rep->create();
            }
        
            if(!empty($reps['target']))
            {
                $user=$origin->getUser()->updateReputation($reps['target']);
                
                $rep=new Reputation();
                $rep->setTime();
                $rep->setContent('Rep has been adeed 2');
                $this->setReputation($reps['target']);
                $rep->create();
            }
            
            
        }
    }
    
    private function fetchReputation(AbstractContent $subject,$event)
    {
        $reps=[];
        
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
        return $this->reputaion;
    }
    public function setReputation($rep)
    {
        $this->rep=$rep;
    }
    
    public function serialize() {
        //unset($this->settiing);
        var_dump("Serializing....");
        return serialize($this);
    }
    
    public function unserialize($serialized) {
        var_dump("UnSerializing....");
        self::__construct();
    }
    
}

?>
