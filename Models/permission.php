<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.s
 * 
 */
require_once "interfaces/CRUDLInterface.php";
require_once "CRUDOBject.php";

require_once 'models/ResourceStorage.php';

require_once 'databaseHandle.php';
require_once 'models/Resource.php';
require_once 'models/Role.php';

/**
 * Description of permission
 *
 * @author Gourav Sarkar
 * 
 * @toDo Permission table has role object in database. Database permission table more of
 *  a mapper which map permission and resource
 */
class permission implements CRUDLInterface{
    //put your code here
    
    
    //private $role;
    
    private $resource;
    private $permission;
    private $role;
    
    private $crud;
    static $connection;
    
    public function __construct() {
        $this->resourceStorage=new ResourceStorage();
        
        /*
         * @todo [BUG]Possible cause of infinite loop
         */
        $this->resource=new Resource();
        $this->resource=new Role();
        $this->crud=new CRUDobject($this);
    }
    
    
    public function setRole(Role $role)
    {
        $this->role=$role;
    }
     /* 
     */
    
    public function setPermission($permit)
    {
        $this->crud->setFieldCache('permission');
        $this->permission=$permit;
    }
    public function setResource(Resource $resource)
    {
        $this->resource=$resource;
    }
    

    public function getResource()
    {
        return $this->resource;
    }
    
    public function getRole()
    {
        return $this->role;
    }
     /* 
     */
    
    public function getPermission()
    {
        return $this->permission;
    }
    
    public function create()
    {
        /*
         * create resource
         */
        $this->resource->create();
        /*
         * Create permission to above resource
         */
        $this->proxyCreate();
    }
    
    public static function listing(DatabaseInteractbleInterface $content)
    {
        $params=array();
        
        $permissionStore=new PermissionStorage();
        
        assert('$content instanceof Role');
        
        $query="SELECT
            res.id AS res_id
            ,res.module AS res_module
            ,res.action AS res_action
            ,perm.permission
            ,r.id AS r_id
            ,r.title AS r_title
            ,r.content AS r_content
            FROM permission AS perm
            INNER JOIN role AS r
            ON perm.role=r.id
            INNER JOIN resource AS res
            ON perm.resource=res.id
            ";
        
        if(!empty($content))
        {
            
            $query .= 'WHERE r.id=?';
            $params[]=$content->getID();
        }
        
        $stmt=DatabaseHandle::getConnection()->prepare($query);
        
        $stmt->execute($params);
        
        while($data=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            $resource= new Resource();
            $resource->setID($data['res_id']);
            $resource->setModule($data['res_module']);
            $resource->setAction($data['res_action']);
            
            $role= new Role();
            $role->setID($data['r_id']);
            $role->setTitle($data['r_title']);
            $role->setContent($data['r_content']);
            
            $permission= new permission();
            $permission->setRole($role);
            $permission->setPermission($data['permission']);
            $permission->setResource($resource);
            
            $permissionStore->attach($permission,$permission);
        }
        
        return $permissionStore;
    }
    public function read() {
        ;
    }
    public function edit(\DatabaseInteractbleInterface $tempObj) {
        ;
    }
    
    public function delete() {
        ;
    }
}
?>
