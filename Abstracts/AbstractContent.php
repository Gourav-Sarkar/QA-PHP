<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/*
 * @version PHP 5.4< will not use trait
 */
//require_once 'traits/CRUDLTrait.php';
//require_once 'traits/RenderbleTrait.php';
require_once 'Abstracts/AbstractAnnonymosContent.php';

require_once 'Interfaces/CRUDLInterface.php';
require_once 'models/CRUDobject.php';

require_once 'Interfaces/DatabaseInteractbleInterface.php';
require_once 'interfaces/RenderbleInterface.php';

require_once 'models/SettingHandler.php';
require_once 'models/BaseObject.php';


require_once 'Models/XMLserialize.php';
require_once 'interfaces/XMLserializeble.php';
/**
 * Description of AbstractContent
 * Content behaviour
 * Must have id
 * Must have owner who beholds the authority of the object
 * Must have time of object spawn
 * Must have a Textual content
 * @author Gourav Sarkar
 * 
 * @issue Serializeble interface is breaking the serialization process in
 *  child methods-Fails session serialization
 */
abstract class AbstractContent extends AbstractAnnonymosContent
{
    protected $user;
    
    public function __construct() {
        parent::__construct();
        
        $this->user = new User();
    }

    /*
     * Setter method for Owenr
     */

    public function setUser(User $owner=null) {
        $this->crud->setFieldCache("user");
        $this->user = $owner;
    }
    public function getUser() {
        return $this->user;
    }

}