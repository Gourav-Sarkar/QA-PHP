<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/*
 * @version PHP 5.4< will not use trait
 */
//require_once 'traits/CRUDLTrait.php';
//require_once 'traits/RenderbleTrait.php';

require_once 'Interfaces/CRUDLInterface.php';
require_once 'Interfaces/DatabaseInteractbleInterface.php';
require_once 'models/SettingHandler.php';
require_once 'models/CRUDobject.php';
/**
 * Description of AbstractContent
 * Content behaviour
 * Must have id
 * Must have owner who beholds the authority of the object
 * Must have time of object spawn
 * Must have a Textual content
 * @author Gourav Sarkar
 */

abstract class AbstractContent 
    implements CRUDLInterface //have CRUDL features
                //,Serializable
                ,DatabaseInteractbleInterface
{
    //put your code here
    
    //AbstractContent should be viewable so it has render trait
    /*
    use RenderbleTrait;
    use \CRUDLTrait;
    */
    
    
    
    /*
     * TESting
     */
    protected  $id; /*@DATABASE*/
    protected  $user; //test
    protected  $time;
    protected  $content;
    protected $setting;
    protected $crud;
    
    protected static $connection;
    
    
    public function AbstractContent()
    {
        $this->user=new User();
        $this->setting=new SettingHandler($this);
        $this->crud=new CRUDobject();
        
        
        /*
         * make connection 
         * All abstractContent have DB intereaction
         * This part could be change to an implmentation later
         * It could be changed when caching technique applies
         * 
         * For now connection is set through setter method
         */
    }
    
    /** This function is used to insert data into DB 
     * Another implementetion of this method can be done with reflection
     * 
     */
    public function __toString() {
        return strtolower(get_class($this));
    }
    
    public function setID($id)
    {
        
        $this->setFieldCache("id");
        $this->id=intval($id);
    }
    public function setTime($time=NULL)
    {
        $this->setFieldCache("time");
        
        if(isset($time) && is_numeric($time))
        {
            $this->time=$time;
            return null;
        }
        $this->time=time();
    }
    
    
    /*
     * Setter method for Owenr
     */
    public function setUser(User $owner)
    {
        $this->setFieldCache("user");
        $this->user=$owner;
    }
    
    /*Setter method for content*/
     public function setContent($content)
    {
         /*
          * Ensure Content is strin
          */
         if(is_string($content))
         {
            $this->setFieldCache("content");
            $this->content=$content;
            return true;
         }
         
         return false;
    }
    
    
    /*
     * Setter method for DAtabase connection
     */
    public static function setConnection(PDO $con)
    {
        static::$connection=$con;
    }
    
    
    
    /* Getter methods to access private properties
     * 
     */
    public function getContent()
    {
        return $this->content;
    }
    public function getUser()
    {
        return $this->user;
    }
    public function getTime()
    {
        /*
         * 
         * Date formating
         
        $dateFormat=["inMinute"=>""
                    ,"inDay"=>""
                    ,"inPastDay"=>""
                    ,"normal"=>""];
        */
        
        return $this->time;
    }
    public function getID()
    {
        return $this->id;
    }
    
    /*
     * Create link to get object data
     */
    /*
    public function serialize() {
        //Unset field cache
        //unset($this->fieldCache);
        //unset Connection
        //unset(AbstractContent::$connection);
        echo "serializing";
        return serialize($this);
    }
    
    public function unserialize($serialized)
    {
        //Revive connection
        AbstractContent::$connection=  DatabaseHandle::getConnection();
        return unserialize($serialized);
    }
    
    /* 
     */
    public function create()
    {
        return $this->crud->
    }
    //public function delete();
    //public function update();
    public function read();
    public function edit(DatabaseInteractbleInterface $tempObj);
    public function delete();
    public static function listing(DatabaseInteractbleInterface $reference);
    
    
}

?>
