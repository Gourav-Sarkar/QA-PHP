<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 *  By default at the time of system installing there will be three default user role
 * SUPERADMIN - unediteble (Has all privilages)
 * GUEST - Editble
 * BANNED -Editble
 * 
 * User will be able to add more roles as needed and can give permission to access certain resource
 */
require_once 'Abstracts/Abstractcontent.php';
require_once 'Storages/PermissionStorage.php';
/**
 * Description of Role
 *
 * @author Gourav Sarkar
 */
class Role extends AbstractContent{
    
    protected $title;
    protected $permissions; /* List of permission object */
    
    
    public function __construct() {
        parent::__construct();
        $this->permissions=new PermissionStorage("Permission");
    }
    //put your code here
    public function setTitle($title)
    {
        $this->crud->setFieldCache("title");
        $this->title=$title;
    }
    /*
     * @deprecated
     */
    public function addPermission(Permission $permission)
    {
        $this->permissions->attach($permission);
    }
    public function setPermissions(PermissionStorage $permission)
    {
        $this->permissions=$permission;
    }
    public function getPermissions()
    {
        return $this->permissions;
    }
    
    public function getTitle()
    {
        return $this->title;
    }
    
    public static function listing(\DatabaseInteractbleInterface $reference) {
        
        $roleStore=new RoleStorage();
        
        $query="SELECT
            r.*
            FROM role AS r
            INNER JOIN RoleUserMapper AS rumap
            ON rumap.role=r.id
            WHERE rumap.user=?";
        
        $stmt=DatabaseHandle::getConnection()->prepare($query);
        
        $stmt->execute(array($reference->getID()));
        
        while($data=$stmt->fetch())
        {
            $role=new Role();
            $role->setID($data['id']);
            $role->setTitle($data['title']);
            
            $roleStore->attach($role,$role);
        }
        
        $_SESSION['roles']=$roleStore;
       return $roleStore;
    }
    
    
    public function hasPermission(Resource $resource)
    {
        $perm=false;
        //echo $this->permissions->count();
        foreach($this->permissions as $permission)
        {
            /*
             * If requeste resource and permssion objects resource id is same
             */
            //var_dump($permission);
            //var_dump($permission->getResource()->equals($resource));
            
            if($permission->getResource()->equals($resource))
            {
                if($permission->getPermission()===true)
                {
                    return true;
                }
                
                break;
            }
        }
        
        return $perm;
    }
}

?>
