<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.s
 * 
 */
require_once "interfaces/CRUDLInterface.php";
require_once "CRUDOBject.php";

require_once 'Storages/ResourceStorage.php';

require_once 'databaseHandle.php';
require_once 'models/Resource.php';
require_once 'models/Role.php';
require_once 'models/baseObject.php';

/**
 * Description of permission
 *
 * @author Gourav Sarkar
 * 
 *  Permission priority
 *  User level permission < content level permission < user setting <server setting
 * 
 * @toDo Permission table has role object in database. Database permission table more of
 *  a mapper which map permission and resource
 */
class permission extends AbstractRenderbleObject implements CRUDLInterface {

    //put your code here
    //private $role;

    private $resource;
    private $permission;
    private $role;
    private $crud;
    //static $connection;

    public function __construct() {
        //$this->resourceStorage = new ResourceStorage("Resource");

        /*
         * @todo [BUG]Possible cause of infinite loop
         */
        $this->resource = new Resource();
        $this->role = new Role();
        $this->crud = new CRUDobject($this);
    }

    public function setRole(Role $role) {
        $this->role = $role;
    }

    /*
     */

    public function setPermission($permit) {
        $this->crud->setFieldCache('permission');
        $this->permission = $permit;
    }

    public function setResource(Resource $resource) {
        $this->resource = $resource;
    }

    public function getResource() {
        return $this->resource;
    }

    public function getRole() {
        return $this->role;
    }

    /*
     */

    public function getPermission() {
        return $this->permission;
    }

    public function create() {
        /*
         * create resource
         */
        $this->resource->create();
        /*
         * Create permission to above resource
         */
        $this->proxyCreate();
    }

    /*
     * Get list of permission for roles
     * If priority of role is same for two roles- negetive value will take advantage
     * If priority of role is different highest priority will be choosen
     * It will return an permission list of calculated permissions among roles
     * Only positive value will be in permission. unavailable value will be taken as negetive
     */

    public static function listing(DatabaseInteractbleInterface $content, $args = array()) {

        $params = array();

        $permissionStore = new PermissionStorage("Permission");

        assert('$content instanceof AbstractUser');

        $query = "SELECT
            res.id AS res_id
            ,res.module AS res_module
            ,res.action AS res_action
            ,perm.permission
            ,r.id AS r_id
            ,r.title AS r_title
            ,r.content AS r_content
            ,r.priority AS r_priority
            FROM permission AS perm
            INNER JOIN role AS r
            ON perm.role=r.id
            INNER JOIN resource AS res
            ON perm.resource=res.id
            INNER JOIN roleUserMapper AS rumap
            ON r.id=rumap.role
            ";

        if (!empty($content)) {

            $query .= 'WHERE rumap.user=?';
            $params[] = $content->getID();
        }

        $stmt = DatabaseHandle::getConnection()->prepare($query);

        $stmt->execute($params);

        //var_dump(count($stmt->fetchAll()));

        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $resource = new Resource();
            $resource->setID($data['res_id']);
            $resource->setModule($data['res_module']);
            $resource->setAction($data['res_action']);

            $role = new Role();
            $role->setID($data['r_id']);
            $role->setTitle($data['r_title']);
            $role->setContent($data['r_content']);
            $role->setPriority($data['r_priority']);

            $permission = new permission();
            $permission->setRole($role);
            $permission->setPermission($data['permission']);
            $permission->setResource($resource);



            echo "<hr/>";
            var_dump($data);
            echo "<hr/>";

            /*
             * Check if resource has already permission (permission object in store for same resource)
             * 
             */
            try {


                //$permCache is previously stored permission
                $permCache = $permissionStore->offsetGet($permission);
                //var_dump($permCache);
                /*
                 * Store only positive permission
                 *  same priority = store only positive
                 *  high priority = store only high priority | if negetive skip it
                 *  low priority = skip anyway
                 */
                /*
                  if ($permCache->getRole()->getPriority() == $permission->getRole()->getPriority()) {

                  if ($permission->getPermission()) {

                  $permissionStore->attach($permission, $permission);
                  }
                  break;
                  } else {


                  /*
                 * SKIP
                 */
                if (($permCache instanceof permission)
                        &&
                        (
                        ($permCache->getRole()->getPriority() < $permission->getRole()->getPriority())
                        || ($permCache->getRole()->getPriority() > $permission->getRole()->getPriority()
                            && !$permission->getPermission()
                            )
                        )
                ) {
                    var_dump("break" . $permCache->getRole()->getPriority() . $permission->getRole()->getPriority());
                    break;
                }
                /*
                  echo "<hr/>";
                  var_dump($data);
                  echo "<hr/>";
                  // */
            } catch (UnexpectedValueException $e) {
                var_dump("Exception");

                if ($permission->getPermission()) {
                    $permissionStore->attach($permission, $permission);
                }
            }
        }
        
        foreach ($permissionStore as $perm)
        {
            var_dump($perm);
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
