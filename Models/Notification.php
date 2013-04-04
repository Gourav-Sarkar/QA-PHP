<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Notification
 *
 * @author Gourav Sarkar
 * implement relay
 */
class Notification extends AbstractContent
    implements SplObserver
{
    //put your code here
    private $targetList=[];
    private $relayMessage;
    /*
     * Notification should not be edited
     */
    public function __construct() {
        parent::__construct();
        //$this->targetList=new SplObjectStorage();
    }
    
    public function update(SplSubject $subject)
    {
        $userlist=[];
        var_dump($this->targetList);
         
        /*
         * Parse message
         * Replace link
         * Replace marker (location of the change (optional
         */
        $sxml=new SimpleXMLElement("setting/message.xml",null, true);
        $msg=$sxml->{get_class($subject)}->{$this->relayMessage};
        var_dump($msg);
        var_dump(str_replace(['%link%','%marker%'],[$subject->getLink('show'),13],$msg));
        
        
        /*
         * Check that target list is really available in $subject
         * target List must be AbstractContent or AbstractConetntObjectStorage
         * Only fetch the user id
         * Only user can be notified 
         */
        foreach($this->targetList as $target)
        {
            assert('method_exists($subject,"get{$target}");');
            $targetData=$subject->{"get{$target}"}();
            assert('$targetData instanceof AbstractContent || $targetData instanceof AbstractContentObjectStorage');
            
            
            var_dump($targetData instanceof AbstractContentObjectStorage);
            
            
            if($targetData instanceof AbstractContentObjectStorage)
            {
                //Get all user in array
                //echo $targetData->count();
                echo get_class($targetData);
                foreach($targetData as $data)
                {
                    //var_dump($data);
                    if(in_array($data->getUser()->getID(),$userList))
                    {
                        
                        $userlist[]=$data->getUser()->getID();
                        
                    }
                }
            }
            //$userlist[]=$targetData->getUser()->getID();

        }
       
        
        
        
        /*
         * User id could be null
         * Like post by deleted user AKA annonymous user
         * filter null value
         */
        $userlist=array_filter($userlist,function($val){return !empty($val);});
        
        /*
         * flipping array will eliminate common values
         * array key will return value which is stored in keys (reveresed during flipping of array)
         */
        $userlist=array_keys(array_flip($userlist));
        
        var_dump($userlist);
        
        //var_dump($faulty);
    }
        
    public function setTarget($target)
    {
        //$this->targetList->attach($target,$target);
        $this->targetList[]=$target;
    }
    
    public function getTarget()
    {
        return $this->targetList;
    }
    
    public function clearTargetList()
    {
        $this->targetList->removeAll($this);
    }
    
    public function create() 
    {
        
    }
    public function edit(\AbstractContent $tempObj) {
        trigger_error("BLOCKED method", E_USER_ERROR);
    }
    public function delete() {
       
    }
    public static function listing(\AbstractContent $reference) {
        ;
    }
    
    public function getParticipant()
    {
        /*
         * Who should be notified?
         *  Notify object owner about each interaction of what other is doin on the object
         *  There could be dependent object. if action is taken on dependent object owner object owner will be notified along with
         *      dependent object owner
         * Get Speoprties which have storage and represents database interactble object
         * Get
         */
    }
    /*
    public function setContent($content=null) {
        
        parent::setContent($content);
    }
     * 
     */
    public function relay($message)
    {
          $this->relayMessage=$message;
    }
   
}

?>
