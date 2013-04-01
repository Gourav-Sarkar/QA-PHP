<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'traits/RenderbleTrait.php';
require_once 'traits/CRUDLTrait.php';
require_once 'interfaces/DatabaseInteractbleInterface.php';
require_once 'interfaces/AuthenticationInterface.php';
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
    
    
    use RenderbleTrait;
    use CRUDLTrait;
    //put your code here
    protected $id;
    //protected $name;
    protected $nick;
    protected $reputation=9000;
    protected $password;
    protected $email;
    
    //protected $authType;
    protected static $connection;
    protected $auth;    //Authentication object
    
    protected $roles;
    
    

    public function __construct() 
    {
        //$this->auth=new LocalAuth();
        //$this->roles=new RolesStorage();
        //Default role initiated for each suer
        //$this->addRole($role);
        
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
    public function setRoles(RolesStorage $role)
    {
        $this->roles=$role;
    }

    public function addRole(Role $role)
        {
            $this->roles->attach($role,$role);
        }
        public function dropRole(Role $role)
        {
            $this->roles->detach($role);
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
        return $this->roles;
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
         * authenticate user if there is not any authenyicate object use default
         */
        if(!empty($this->auth))
        {
            $this->auth->auth();
        }
        
        //var_dump($this);
        
        $this->hash();
        $this->softRead();
        
        //var_dump($this);
        
        if(!empty($this->id))
        {
            //echo "boo";
            //Ensure previous session get deleted and start new session
            session_regenerate_id(true);
            
            
            $_SESSION['self']=$this;
            
            var_dump($_SESSION);
            return;
        }
        
        throw new Exception("Wrong password/username");
    }
    
    
    private function hash()
    {
        $this->password=crypt($this->password, '$2a$07$usesomesillystringforsalt$');
         var_dump($this->password);
    }
    
   
}

?>
