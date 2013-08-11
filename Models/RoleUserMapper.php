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
class RoleUserMapper implements CRUDLInterface {

    //put your code here
    //private $role;
    static $connection; /* should be removed */

    public function __construct(AbstractUser $user) {
        //$this->user=$user;
    }

    public function get() {
        /*
         * get what field cache is set for all the object
         */
    }

    public static function listing(\DatabaseInteractbleInterface $reference) {
        $roles = new RoleStorage();
        $permissions = new PermissionStorage();


        $query = "SELECT
                r.id AS role_id
                ,r.title AS role_title
                ,rumap.role AS role_id
                ,res.id AS resource_id
                ,res.action
                ,res.module
                ,perm.permission
                FROM roleUserMapper AS rumap 
                LEFT OUTER JOIN permission AS perm
                ON rumap.role =perm.role
                LEFT OUTER JOIN role AS r
                ON r.id=rumap.role
                LEFT OUTER JOIN resource AS res
                ON perm.resource=res.id
                WHERE rumap.user=?";

        $stmt = DatabaseHandle::getConnection()->prepare($query);

        $stmt->execute(array($reference->getID()));

        //var_dump($stmt->fetchAll());

        /*
         * create 
         */

        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            var_dump('Role data', $data);


            /*
             * No matter role has permission or resource still it needs to enlist
             * for general information showing
             */

            $role = new Role();
            $role->setID($data['role_id']);
            $role->setTitle($data['role_title']);


            /*
             * Store it in rolestorge
             * First always add role to role storage
             * It will overwrite any role
             */
            //var_dump('role BP' ,$role);

            if (!$roles->contains($role)) {
                $roles->attach($role, $role);
            }


            /*
             * Every data set has resource data
             * Set up a resource object
             * 
             * role =[resource + perm]+[resource + perm]
             * user role =[role]+[role] 
             * 
             * one user can have multiple role
             * One role can have no resource permission at all if any of two is missing
             */

            //if($roles->contains($role))

            if (!empty($data['resource_id'])) {
                $res = new Resource();
                $res->setAction($data['action']);
                $res->setModule($data['module']);
                $res->setID($data['resource_id']);
                //*/



                /*
                 * Permission object is actually role resource mapper with granted permission
                 */
                //If role is already fetched get the resource and permission
                //$roles->attach($role,$role);   


                $perm = new permission();
                $perm->setResource($res);
                $perm->setPermission((bool) $data['permission']); //cast to false on invalid data
                //$perm->setRole($role); /* Permission does not need to know role */

                /*
                 * Make permission list on each iteration
                 */
                $permissions->attach($perm);
                
                //var_dump($permissions);
                
                /*
                 * add permission list to role where role matches
                 * Role should be pulled from roleStorage
                 */
                //var_dump($roles->offsetGet($role));
                $roles->offsetGet($role)->setPermissions($permissions);
            }







            /*
             * attach a role object to roleStorage if its not already created
             */

            //$role->setPermissions($permStorage);
        }

        //var_dump("Count roles", $roles->count());
        
        //var_dump($roles);
        
        return $roles;
    }

    public function read() {
        throw new BadMethodCallException();
    }

    public function create() {
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
