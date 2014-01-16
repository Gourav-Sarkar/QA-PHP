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


require_once 'Interfaces/CRUDLInterface.php';
require_once 'models/CRUDobject.php';

require_once 'interfaces/DatabaseInteractbleInterface.php';
require_once 'interfaces/AuthenticationInterface.php';
require_once 'Interfaces/XMLserializeble.php';


require_once 'Storages/RoleStorage.php';
require_once 'Storages/UserProfileFieldStorage.php';

require_once 'models/BaseObject.php';
require_once 'models/RoleUserMapper.php';
require_once 'models/Role.php';
require_once 'Exception/PermissionDeniedException.php';

require_once 'test.php';

/**
 * Description of AbstractUser
 *
 * @author Gourav Sarkar
 */
//require_once 'AbstractContent.php';
abstract class AbstractUser extends AbstractAnnonymosContent implements
AuthenticationInterface {

    const USER_DEFAULT_ROLE = 'guest';

    //put your code here
    protected $id;
    //protected $name;
    protected $nick;
    protected $reputation = 1;
    protected $password;
    protected $email;
    protected $crud;
    //protected $authType;
    protected $auth;    //Authentication object
    protected $roleList; //Seperate pulling
    protected $userProfile;
    protected $referedBy;
    protected $permissionList;

    public function __construct() {
        parent::__construct();

        //$this->auth=new LocalAuth();
        $this->roleList = new RoleStorage('Role');
        $this->userProfile = new UserProfileFieldStorage("UserProfileField");
        $this->permissionList=new PermissionStorage("Permission");
        
        //Exclude from automated query building
        //$this->referedBy=new User();


        $this->crud = new CRUDobject($this);
    }

    public function __toString() {
        return strtolower(get_class($this));
    }

    public function setReferedBy($refBy) {
        $this->referedBy = $refBy;
        $this->crud->setFieldCache("referedBy");
    }

    public function getReferedBy() {
        return $this->referedBy;
    }

    /*
     * CRUD implements
     * 
     * 
     */

    public function create() {
        return $this->crud->create();
    }

    //public function delete();
    //public function update();
    public function read() {
        return $this->crud->read();
    }

    public function edit(DatabaseInteractbleInterface $tempObj) {
        return $this->crud->edit();
    }

    public function delete() {
        return $this->crud->delete();
    }

    public static function listing(DatabaseInteractbleInterface $reference,$args=array()) {
        return $this->crud->listing();
    }

    public function softread() {
        return $this->crud->softRead();
    }

    public function setID($id) {
        $this->crud->setFieldCache("id");
        $this->id = $id;
    }

    public function setContent($content) {
        throw new BadMethodCallException("Invalid method");
    }

    /* Getter methods to access private properties
     * 
     */

    public function getContent() {
        throw new BadMethodCallException("Invalid method");
    }

    /*
      public function setName($name)
      {

      $this->crud->setFieldCache("name");
      $this->name=$name;
      }
     *  
     */

    public function setNick($nick) {
        $this->crud->setFieldCache("nick");
        $this->nick = $nick;
    }

    public function setReputation($rep) {
        $this->crud->setFieldCache("reputation");
        $this->reputation = $rep;
    }

    public function setPassword($pass) {
        $this->crud->setFieldCache("password");
        $this->password = $pass;
    }

    public function setEmail($email) {
        $this->crud->setFieldCache("email");
        $this->email = $email;
    }

    public function setAuthModule(AuthenticationInterface $auth) {
        $this->auth = $auth;
    }

    public function setRoles(RoleStorage $role) {
        $this->roleList = $role;
    }

    public function addRole(Role $role) {
        $this->roleList->attach($role, $role);
    }

    public function dropRole(Role $role) {
        $this->roleList->detach($role);
    }

    public function getReputation() {
        return $this->reputation;
    }

    public function getID() {
        return $this->id;
    }

    public function getRoles() {
        return $this->roleList;
    }

    /*
      public function getName()
      {
      return $this->name;
      }
     * 
     */

    public function getNick() {
        return $this->nick;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getAvatar() {
        $file = sprintf("/image/avatar/%s.%s", $identifier = $this->getid(), $ext = 'jpg');
        //return $file;
        if (file_exists(realpath($file)) === true) {
            return $file;
        }

        $identifier = 'default';
        $ext = 'png';
        return sprintf("/image/avatar/%s.%s", $identifier, $ext);
    }

    public function setPermission(PermissionStorage $perm) {
        $this->permissionList = $perm;
    }

    public function getPermission() {
        return $this->permissionList;
    }

    /*
     * Tries Database auth if no module is set up
     * If module is there use the interface to auth user
     * Module will check auth and initialize $_SESSION['self'] if it succeds 
     * else it will throw exception
     * $_SESSION['self'] name of current/self user can be set in config
     */

    public function auth() {
        //Ensure previous session get deleted and start new session
        session_regenerate_id(true);
        /*
         * Only get default role permission
         */
        $defaultrole = new Role();
        $defaultrole->setTitle(static::USER_DEFAULT_ROLE);
        $defaultrole->softRead();

        //var_dump($role);
        //$defaultrole->setPermissions(Permission::Listing($defaultrole));
        //$roleCache=static::getActiveUser()->getRoles()->offsetGet($defaultrole);
        //var_dump('role default',$roleCache);


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
        /*
          $rs=new RoleStorage();
          $rs->attach($defaultrole, $defaultrole);
         *
         */

        //var_dump($this);
        try {
            $this->hash();
            $user = $this->crud->softRead();
            //var_dump('roles list',RoleUserMapper::listing($this));
            $this->setRoles(Role::listing($this));
            //$this->setRoles($rs);

            //var_dump("perm:" . permission::listing($this)->count());
            $this->setPermission(permission::listing($this));


            var_dump('object ok', $this);
        } catch (NoEntryFoundException $e) {
            throw new NoEntryFoundException("Wrong user Credentials");
        }



        /*
         * Append active users default role
         * @todo can be get all the data from database 
         */
        //$this->getRoles()->attach($roleCache,$roleCache);

        /*
         * Get Roles of user
         */


        var_dump('user', $user);

        var_dump(serialize($user));

        $_SESSION['self'] = $this;

        var_dump(session_encode());
        var_dump('ses', $_SESSION['self']);

        //var_dump($_SESSION['self']->getRoles());
        /*
          var_dump('Serialize before',$this);
          var_dump('Serialize after',$_SESSION['self']);
          var_dump('unserialize',$_SESSION['self']);
          /*
         * 
          $data=session_encode();
          var_dump($data);
          $foo=session_decode($data);
          var_dump($foo);
         */


        /*
         * DEBUG
         */
        /*
          echo '<hr/>';
          foreach ($_SESSION['self']->getRoles() as $role) {
          echo '<b>' . $role->getTitle() . '</b>';
          foreach ($role->getPermissions() as $perm) {
          var_dump($perm);

          echo '<br/>';
          }
          var_dump($role);
          echo '<br/>';
          }

          echo '<hr/>';
         * 
         */

        //var_dump('auth object',$this);
        //var_dump('auth session',$_SESSION);
    }

    private function hash() {
        $this->password = crypt($this->password, '$2a$07$usesomesillystringforsalt$');
        var_dump($this->password);
    }

    /*
     * @PARAM AbstractUser $user (optional)
     * If nothing is passed in parameter it will be assumed as ACtor
     * Actor is the current user session who is doing the actions
     * 
     * Before comparing both object it needs to make sure that compared object is also AbstractUser
     */

    public function equals(AbstractUser $user = null) {

        if (empty($user)) {
            $user = $_SESSION['self'];
        }

        //var_dump($this->getID().' '.$user->getID());

        if ($user instanceof AbstractUser) {
            //@TODO Strict check is failing the method
            //var_dump((bool)$this->getID()==$user->getID() .' '. ($this->getID()==$user->getID()));
            //echo '<hr>';

            return (bool) ($this->getID() == $user->getID());
        }

        return false;
    }

    public static function getActiveUser() {
        /*
         * Active user is not nessacrily authneticated user.
         * Every time a user comes to page it get session which represents current active user
         * Every Active user should have at least one role. more role is also possible
         * When user does authenticate activeUsers role are appended to authenticated user roleList
         */

        if (!isset($_SESSION['self'])) {
            $role = new Role();
            $role->setTitle(static::USER_DEFAULT_ROLE);

            //var_dump($role);
            //$role->setPermissions(Permission::Listing($role));

            $user = new User();
            $user->addRole($role);
            
            
            $role->softRead(); 
            
            var_dump('default role',$role);

            $_SESSION['self'] = $user;

            var_dump('first visit');
            return $user; //Reduce session write count
        }
        /*
         */

        return $_SESSION['self'];
    }

    public function updateReputation() {
        assert('isset($this->reputation)');

        $query = sprintf("UPDATE %s SET reputation=reputation+? WHERE id=?", get_class($this));
        $stmt = DatabaseHandle::getConnection()->prepare($query);

        if (empty($this->id)) {
            trigger_error("User id must be there to do the action", E_USER_ERROR);
        }

        $stmt->execute(array(
            $this->getReputation()
            , $this->getID()
                )
        );
    }

    /*
     * return list of user where user id is same current object id
     */

    public function getReferals() {
        $user = new User();
        $user->setID($this->getID());

        return User::listing($user);
    }

    public function fetchDetailedUserProfile() {
        $query = "SELECT
            
                pf.title
                ,upf.content
                
                FROM
                RoleUserMApper AS rum
                LEFT OUTER JOIN 
                userProfileField AS upf
                ON rum.user=upf.user
                
                LEFT OUTER JOIN
                profileField AS pf
                ON pf.id=upf.profileField
                
                WHERE
                rum.user=14
                ";
    }

}

?>
