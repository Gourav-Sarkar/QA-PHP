<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 */
require_once 'models/ResourceStorage.php';
require_once 'traits/CRUDLTrait.php';
require_once 'databaseHandle.php';
require_once 'models/Resource.php';

/**
 * Description of permission
 *
 * @author Gourav Sarkar
 * 
 * @toDo Permission table has role object in database. Database permission table more of
 *  a mapper which map permission and resource
 */
class permission{
    //put your code here
    use CRUDLTrait
    {
        CRUDLTrait::create as proxyCreate; //
    }
    
    //private $role;
    
    private $resource;
    private $permission;
    
    static $connection;
    
    public function __construct() {
        $this->resourceStorage=new ResourceStorage();
        
        /*
         * @todo [BUG]Possible cause of infinite loop
         */
        //$this->resource=new Resource();
    }
    /*
     * @deprecated
     */
    /*
    public function setRole(Role $role)
    {
        $this->role=$role;
    }
     * 
     */
    
    public function setPermission($permit)
    {
        $this->setFieldCache('permission');
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
    /*
     * @deprecated
     * 
     */
    
    /*
    public function getRole()
    {
        return $this->role;
    }
     * 
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
        //assert('$content instanceof Resource');
    }
}
?>
