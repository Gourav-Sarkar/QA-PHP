<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/*
 * @version PHP 5.4< will not use trait
 */
//require_once 'traits/RenderbleTrait.php';
//require_once 'traits/CRUDLTrait.php';


require_once 'interfaces/DatabaseInteractbleInterface.php';
require_once 'interfaces/AuthenticationInterface.php';
require_once 'models/RoleStorage.php';
require_once 'models/RoleUserMapper.php';
require_once 'models/RolePermissionMapper.php';
require_once 'models/Role.php';
require_once 'Exception/PermissionDeniedException.php';
/**
 * Description of AbstractUser
 *
 * @author Gourav Sarkar
 */
//require_once 'AbstractContent.php';
abstract class AbstractUser 
    implements DatabaseInteractbleInterface
    ,AuthenticationInterface
{
    
    const USER_DEFAULT_ROLE='guest';
    
    
    //put your code here
    protected $id;
    //protected $name;
    protected $nick;
    protected $reputation=1;
    protected $password;
    protected $email;
    
    //protected $authType;
    protected static $connection;
    protected $auth;    //Authentication object
    
    protected $roleList;
    
    

    public function __construct() 
    {
        //$this->auth=new LocalAuth();
        $this->roleList=new RoleStorage();
        
        //Default role initiated for each suer
        //$this->addRole($role);
        
    }
     public function __toString() {
        return strtolower(get_class($this));
    }
    
    
    public function setID($id)
    {
        $this->setFieldCache("id");
        $this->id=$id;
        
    }
    /*
    public function setName($name)
    {
        
        $this->setFieldCache("name");
        $this->name=$name;
    }
     * 
     */
    
    public function setNick($nick)
    {
        $this->setFieldCache("nick");
        $this->nick=$nick;
    }
    public function setReputation($rep)
    {
        $this->setFieldCache("reputation");
        $this->reputation=$rep;
    }
    public function setPassword($pass)
    {
        $this->setFieldCache("password");
        $this->password=$pass;
    }
    public function setEmail($email)
    {
        $this->setFieldCache("email");
        $this->email=$email;
    }
    public function setConnection(PDO $con)
    {
        static::$connection=$con;
    }
    public function setAuthModule(AuthenticationInterface $auth)
    {
        $this->auth=$auth;
    }
    public function setRoles(RoleStorage $role)
    {
        $this->roleList=$role;
    }

    public function addRole(Role $role)
        {
            $this->roleList->attach($role,$role);
        }
        public function dropRole(Role $role)
        {
            $this->roleList->detach($role);
        }
    
    
    public function getReputation()
    {
        return $this->reputation;
    }
    public function getID()
    {
        return $this->id;
    }
    public function getRoles()
    {
        return $this->roleList;
    }
    /*
     public function getName()
    {
        return $this->name;
    }
     * 
     */
     public function getNick()
    {
        return $this->nick;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getAvatar()
    {
        $file=sprintf("/image/avatar/%s.%s",$identifier=$this->getid(),$ext='jpg');
        //return $file;
        if(file_exists(realpath($file))===true)
        {
            return $file;
        }
        
        $identifier='default';
        $ext='png';
        return sprintf("/image/avatar/%s.%s",$identifier,$ext);
    }
    
    /*
     * Tries Database auth if no module is set up
     * If module is there use the interface to auth user
     * Module will check auth and initialize $_SESSION['self'] if it succeds 
     * else it will throw exception
     * $_SESSION['self'] name of current/self user can be set in config
     */
    public function auth()
    {
        /*
         * Only get default role permission
         */
        $defaultrole=new Role();
        $defaultrole->setTitle(static::USER_DEFAULT_ROLE);
        
        $roleCache=static::getActiveUser()->getRoles()->offsetGet($defaultrole);
        var_dump('role default',$roleCache);
        
        
        /*
         * authenticate user if there is not any authenyicate object use default
         * CURRENTLY NOT IN USE
         */
        /*
        if(!empty($this->auth))
        {
            $this->auth->auth();
        }
         *
         */
        
        //var_dump($this);
        try {
            $this->hash();
            $this->softRead();
            $this->setRoles(RoleUserMapper::listing($this));
        }
        catch(NoEntryFoundException $e)
        {
            throw new NoEntryFoundException("Wrong user Credentials");
        }
        
        
        
        
        /*
         * Append active users default role
         * @todo can be get all the data from database 
         */
        $this->getRoles()->attach($roleCache,$roleCache);
        
        /*
         * Get Roles of user
         */
        
        
        //var_dump($this);
            //Ensure previous session get deleted and start new session
            session_regenerate_id(true);
            
            /*
             * DEBUG
             */
            var_dump("SESSION DEBUG");
            var_dump($_SESSION);
            foreach($_SESSION['self']->getRoles() as $role)
            {
                var_dump('Roles',$role);
                foreach($role->getPermissions() as $perm)
                {
                    var_dump($perm);
                }
            }
            
            $_SESSION['self']=$this;
    }
    
    
    private function hash()
    {
        $this->password=crypt($this->password, '$2a$07$usesomesillystringforsalt$');
         var_dump($this->password);
    }
    
    /*
     * @PARAM AbstractUser $user (optional)
     * If nothing is passed in parameter it will be assumed as ACtor
     * Actor is the current user session who is doing the actions
     * 
     * Before comparing both object it needs to make sure that compared object is also AbstractUser
     */
    public function equals(AbstractUser $user=null)
    {
        
        if(empty($user))
        {
            $user=$_SESSION['self'];
        }
        
            //var_dump($this->getID().' '.$user->getID());
        
        if($user instanceof AbstractUser)
        {
            //@TODO Strict check is failing the method
            //var_dump((bool)$this->getID()==$user->getID() .' '. ($this->getID()==$user->getID()));
            //echo '<hr>';
            
            return (bool)($this->getID()==$user->getID());
        }
        
        return false;
    }
    
    /*
     * Iterate over role list
     * check each role have certain resource permission or not
     */
    public function hasPermission(Resource $resource)
    {
        /*
         * get User roles and manipulate to get particular resource
         * role object will have several resource object with permission
         */
        
        foreach($this->roleList as $role)
        {
            /*
             * if a user has both permission true or false. it will be considered
             * User has permission to that resource. by default permission to all 
             * the resource is false
             */
            if($role->hasPermission($resource)===true)
            {
                return true;
            }
            //var_dump($permission);
        }
        throw new PermissionDeniedException("Permission denied");
    }
    
    public static function getActiveUser()
    {
        /*
         * Active user is not nessacrily authneticated user.
         * Every time a user comes to page it get session which represents current active user
         * Every Active user should have at least one role. more role is also possible
         * When user does authenticate activeUsers role are appended to authenticated user roleList
         */
        
        if(!isset($_SESSION['self']))
        {
            $role=new Role();
            $role->setConnection(DatabaseHandle::getConnection());
            $role->setTitle(static::USER_DEFAULT_ROLE);
            $role->softRead();
            
            //var_dump($role);
            
            $role->setPermissions(RolePermissionMapper::Listing($role));
     
            $_SESSION['self']=new User();
            $_SESSION['self']->addRole($role);
        }
        /* 
         */
        
        return $_SESSION['self'];
    }
    
    public function updateReputation()
    {
        assert('isset($this->reputation)');
        
        $query=sprintf("UPDATE %s SET reputation=reputation+? WHERE id=?",get_class($this));
        $stmt=DatabaseHandle::getConnection()->prepare($query);
        
        if(empty($this->id))
        {
            trigger_error("User id must be there to do the action", E_USER_ERROR);
        }
        
        $stmt->execute(array(
                            $this->getReputation()
                            ,$this->getID()
                            )
                        );
    }
    
   
}

?>
