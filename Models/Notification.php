<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Abstracts/AbstractContent.php';
require_once 'DefaultSettingObject.php';
/**
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
 * @todo Currently notification only works with user interaction. means user will be notified
 *  for those contents which they ahd participated in.
 *  
 *  new feature will be added to maintain a watch list of contents and favourite tags , 
 *  for what every activity on those contents will be notified to user
 * 
 * @todo User can maintain and swithc off/on notification system
 * 
 * @author Gourav Sarkar
 * implement relay
 */
class Notification extends AbstractContent
    implements SplObserver
{
        const SETTING_FILE_LOCATION="E:/wamp/www/stackoverflow/setting/"; //File name is class name
        const NOTIFICATION_LANG='en';
        
    //put your code here
    private $targetList=array();
    
    /*
     * Notification should not be edited
     */
    public function __construct() {
        parent::__construct();
        //$this->targetList=new SplObjectStorage();
        
        
        $this->setting=new DefaultSettingObject($this);
    }
    
    public function update(SplSubject $subject)
    {
        echo "Relay message to notification";
        $userlist=array();
        $notificationList=new NotificationStorage();
        /*
         * $subject is relay object which have origin object
         * get the origin object which have started relay event
         */
        $originObject= $subject->getOrigin();
        
        /* 
         * @DEPRECATED BLOCK
         * Reflect $originObject to get its property
         * Origin object is type of AbstractContent
         * It could have other abstractContent Object associated with
         * Mostly other abstarctcontent object will be stored as ObjectStorage of AbstractContentObjectStorage
         * All other assocaiated abstractContent owner who are not the triggering event owner will be notified
         * Owner (user ID) will not be notified if it has NULL value or he is iteslf the triggerring the event
         */
        
        /*
        $reflOrigin= new ReflectionObject($originObject);
        //Properties of origin object
        $originObjProps=$reflOrigin->getProperties(ReflectionProperty::IS_PROTECTED | ReflectionProperty::IS_PRIVATE);
        foreach($originObjProps as $property)
        {
            //Set accessible property
            $property->SetAccessible(true);
            if($property->getValue($originObject) instanceof AbstractContentObjectStorage)
            {
                echo $property->getName();
            }
        }
         * 
         */
        
        
        /*
         * Check that target list is really available in $subject
         * target List must be AbstractContent or AbstractConetntObjectStorage
         * Only fetch the user id
         * Only user can be notified 
         */
        //var_dump($this->targetList);
        
        foreach($this->targetList as $target)
        {
            assert('method_exists($originObject,"get{$target}");');
            $targetData=$originObject->{"get{$target}"}();
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
                    var_dump($data->getUser()->equals());
                   
                    /*
                     * @todo Move filtering and verification part to notificationStorage
                     * @todo Remove $userlist array use splobjectstorage instead to determine existance of object
                     * 
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
                        $this->setContent('');
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
         * 
         */
         
        $userlist=array_filter($userlist,function($val){return !empty($val);});
        
        /*
         * flipping array will eliminate common values
         * array key will return value which is stored in keys (reveresed during flipping of array)
         */
         
        $userlist=array_keys(array_flip($userlist));
        
        var_dump($userlist);
        
        //var_dump($faulty);
        
        foreach($userlist as $user)
        {
            $user=new User($user);
            
        }
        //var_dump($userlist);
        
        //Insert
        echo $notificationList->count();
        $notificationList->create();
    }
        
    public function setTarget($target)
    {
        //$this->targetList->attach($target,$target);
        if(is_string($target))
        {
            $this->targetList[]=$target;
            return true;
        }
        
        if(is_array($target))
        {
            $this->targetList=array_merge($this->targetList, $target);
            return true;
        }
        
        return false;
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
    
    private function getParticipant(AbstractContent $object)
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
