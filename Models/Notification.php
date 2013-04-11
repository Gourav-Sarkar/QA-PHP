<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Abstracts/AbstractContent.php';
/**
 * It Does notify users about certain activity on a object
 * It does have log in database
 * It is bound to controller of a model because 'notification' get triggered by action
 * Model controller registered the command message which is used to determine if or not notification will be
 *  sent to users
 * Notification does not notify if User is same who triggered the action or the
 *  user is null or don't have value. which represents user who has been deleted 
 *  (annonymity behaviour of user later might be chnaged where instead of using annonymose user
 *  It will show hard codes name of the user instead of link
 *  @REFERENCE AbstractUser class)
 * 
 * @todo 
 * Currently notification is stored via loop. later if performance is affected by this method
 * Insertion technique will be change and all the insertion will be delegated to insert it once at all     
 *
 * @todo Database Modification. Table should be efficient for insertion. Index on user column can be removed
 *  Because user of notification will come from othe abstracContent which ensures 
 *  the id intigrity itself.
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
        $notificationList=new NotificationStorage();
         
        /*
         * Parse message
         * Replace link
         * Replace marker (location of the change (optional
         */
        $sxml=new SimpleXMLElement("setting/message.xml",null, true);
        $msg=$sxml->{strtolower(get_class($subject))}->{$this->relayMessage};
        var_dump($msg);
        $msg=str_replace(['%link%','%marker%'],[$subject->getLink('show'),13],$msg);
        
        
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
            
            
            //var_dump($targetData instanceof AbstractContentObjectStorage);
            
            
            if($targetData instanceof AbstractContentObjectStorage)
            {
                //Get all user in array
                //echo $targetData->count();
                echo get_class($targetData);
                foreach($targetData as $data)
                {
                    //var_dump($data);
                    /*
                     * If user id is not in cache use it cache it and craete a entry
                     * else skip it
                     */
                    //var_dump($data->getUser()->equals());
                   
                    /*
                     * @todo Move filtering and verification part to notificationStorage
                     * @todo Remove $userlist array use splobjectstorage instead to determine existance of object
                     */
                    if(null!=$data->getUser()->getID() 
                            && !in_array($data->getUser()->getID(),$userlist) 
                            && !$data->getUser()->equals())
                    {
                        var_dump("Found array");
                        
                        //Cache entry
                        $userlist[]=$data->getUser()->getID();
                        //Create a notification
                        $this->setUser($data->getUser());
                        $this->setContent($msg);
                        $this->setTime();
                        
                        $notificationList->attach($this,$this);
                        
                        var_dump($this);
                        
                    }
                }
            }
            //$userlist[]=$targetData->getUser()->getID();

        }
       
        
        /*
        
        /*
         * User id could be null
         * Like post by deleted user AKA annonymous user
         * filter null value
         
        $userlist=array_filter($userlist,function($val){return !empty($val);});
        
        /*
         * flipping array will eliminate common values
         * array key will return value which is stored in keys (reveresed during flipping of array)
         
        $userlist=array_keys(array_flip($userlist));
        
        var_dump($userlist);
        
        //var_dump($faulty);
        
        foreach($userlist as $user)
        {
            $user=new User($user);
            
        }
        */
        //var_dump($userlist);
        
            $notificationList->create();
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
    public function edit(\DatabaseInteractbleInterface $tempObj) {
        trigger_error("BLOCKED method", E_USER_ERROR);
    }
    public function delete() {
       
    }
    public static function listing(\DatabaseInteractbleInterface $reference) {
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
