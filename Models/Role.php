<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Abstracts/Abstractcontent.php';
require_once 'models/PermissionStorage.php';
/**
 * Description of Role
 *
 * @author Gourav Sarkar
 */
class Role extends AbstractContent{
    private $title;
    protected $permissions; /* @deprecated List of permission object */
    
    
    public function __construct() {
        parent::__construct();
        $this->permissions=new PermissionStorage();
    }
    //put your code here
    public function setTitle($title)
    {
        $this->setFieldCache("title");
        $this->title=$title;
    }
    /*
     * @deprecated
     */
    public function addPermission(Permission $permission)
    {
        $this->permissions->attach($permission,$permission);
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
        
       
    }
    
    
    public function hasPermission(Resource $resource)
    {
        foreach($this->permissions as $permission)
        {
            /*
             * If requeste resource and permssion objects resource id is same
             */
            var_dump($permission);
            var_dump($permission->getResource()->equals($resource));
            if($permission->getResource()->equals($resource))
            {
                return $permission->getPermission();
            }
        }
        
        return false;
    }
}

?>
