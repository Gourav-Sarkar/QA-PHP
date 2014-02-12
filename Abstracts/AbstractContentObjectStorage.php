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

/**
 * Description of AbstractContentObjectStorage
 *
 * @author Gourav Sarkar
 */
abstract class AbstractContentObjectStorage extends SplObjectStorage implements XMLSerializeble {

    //put your code here
    //use RenderbleTrait;
    protected $storage_type;
    protected $pager;

    /*
     * @PARAM $objType must be a name of valid class
     */

    public function __construct($objType) {
        $this->pager = new Pagination();

        if (empty($this->storage_type)) {
            $this->storage_type = $objType;
        }

        //ObjectStorage must have declare its storage type
        //assert('!empty($this->storage_type)');
    }

    public function getHash($object) {
        assert('$object instanceof ' . $this->storage_type);
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
