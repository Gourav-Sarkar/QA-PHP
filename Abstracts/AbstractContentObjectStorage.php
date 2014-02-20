<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//require_once 'ListbleInterface.php';
//require_once 'RenderbleTrait.php';
require_once 'Interfaces/RenderbleInterface.php';
require_once 'Interfaces/XMLserializeble.php';
require_once 'Models/Pagination.php';

require_once 'interfaces/DatabaseInteractbleInterface.php';
/**
 * Description of AbstractContentObjectStorage
 *
 * @author Gourav Sarkar
 */
abstract class AbstractContentObjectStorage extends SplObjectStorage implements XMLSerializeble,DatabaseInteractbleInterface {

    //put your code here
    //use RenderbleTrait;
    protected $storageType;
    /*
     * Pagination $pager used to paginate objects
     * Some object list dont need to paginate they need to show everything 
     */
    protected $pager;

    /*
     * @PARAM $objType must be a name of valid class
     */

    public function __construct($objType) {

        if (empty($this->storageType)) {
            $this->storageType = $objType;
        }

        //ObjectStorage must have declare its storage type
        //assert('!empty($this->storage_type)');
    }

    /*
     * 
     */
    public function setPager(Pagination $pager)
    {
        $this->pager = $pager;
    }
    
    public function getHash($object) {
        assert('$object instanceof ' . $this->storageType);
        $id = $object->getID();
        //echo $id;
        //Ensure id is there
        assert('!empty($id);');
        return (string) $id;
    }

    /*
     * @CAUTION Can break xml serialization
     */

    public function __toString() {
        return get_class($this);
    }

    public function xmlSerialize() {


        $xmlSer = new XMLSerialize($this);
        $xmlSer->getWriter()->startElement((string) $this);
        $xmlSer->getWriter()->writeRaw($xmlSer->xmlSerialize());
        foreach ($this as $content) {
            $xmlSer->getWriter()->writeRaw($content->xmlSerialize());
        }
        $xmlSer->getWriter()->endElement();
        //var_dump($xmlSer->xmlSerialize());
        return $xmlSer->getWriter()->outputMemory(true);
    }

}

?>
