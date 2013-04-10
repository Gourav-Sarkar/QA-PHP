<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'models/ResourceStorage.php';
require_once 'traits/CRUDLTrait.php';
require_once 'databaseHandle.php';
require_once 'models/Resource.php';

/**
 * Description of permission
 *
 * @author Gourav Sarkar
 */
class permission{
    //put your code here
    use CRUDLTrait
    {
        CRUDLTrait::create as proxyCreate; //
    }
    
    private $id;
    private $resource;
    private $permission;
    
    static $connection;
    
    public function __construct() {
        $this->resourceStorage=new ResourceStorage();
        $this->resource=new Resource();
    }
    
    public function setID($id)
    {
        $this->id=$id;
    }
    
    public function setPermission($permit)
    {
        $this->setFieldCache('permission');
        $this->permission=$permit;
    }
    public function setResource(Resource $resource)
    {
        $this->resource=$resource;
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
}
?>
