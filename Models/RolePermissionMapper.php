<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Interfaces/CRUDLInterface.php';
require_once 'Models/Role.php';
require_once 'Models/Permission.php';
/**
 * Description of RoleUserMapper
 *
 * @author Gourav Sarkar
 */
class RolePermissionMapper implements CRUDLInterface{
    //put your code here
    //private $role;
    static $connection; /*should be removed */
    
    public function __construct(AbstractUser $user)
    {
        //$this->user=$user;
    }
    
    public function get()
    {
        /*
         * get what field cache is set for all the object
         */
    }
    public static function listing(\DatabaseInteractbleInterface $reference) {
         $permissions=new PermissionStorage();
        
        static::$connection=  DatabaseHandle::getConnection();
        
        $query="SELECT
                res.id AS resource_id
                ,res.action
                ,res.module
                ,perm.permission
                FROM permission AS perm
                LEFT OUTER JOIN resource AS res
                ON perm.resource=res.id
                WHERE perm.role=?";
        
        $stmt=static::$connection->prepare($query);
        
        $stmt->execute(array($reference->getID()));
        
        //var_dump($stmt->fetchAll());
        
        /*
         * create 
         */
        
        while($data=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            var_dump($data);
            /*
             * Every data set has resource data
             * Set up a resource object
             * 
             * role =[resource + perm]+[resource + perm]
             * user role =[role]+[role] 
             * 
             * one user can have multiple role
             */
            
             //if($roles->contains($role))
            
            
            $res= new Resource();
            $res->setAction($data['action']);
            $res->setModule($data['module']);
            $res->setID($data['resource_id']);
            
            /*
             * Permission object is actually role resource mapper with granted permission
             */
            //If role is already fetched get the resource and permission
             //$roles->attach($role,$role);   
           
            
            $perm=new permission();
            $perm->setResource($res);
            $perm->setPermission((bool)$data['permission']);
            //$perm->setRole($role); /* Permission does not need to know role */
            
            /*
             * Make permission list on each iteration
             */
            $permissions->attach($perm, $perm);
           
            
        }
        return $permissions;
    }
    
    public function read() {
        throw new BadMethodCallException();
    }
    public function create()
    {
        throw new BadMethodCallException();
    }
    public function edit(\DatabaseInteractbleInterface $tempObj) {
        throw new BadMethodCallException();
    }
    public function delete() {
        throw new BadMethodCallException();
    }
}

?>
