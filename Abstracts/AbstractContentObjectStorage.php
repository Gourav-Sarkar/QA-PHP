<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//require_once 'ListbleInterface.php';
//require_once 'RenderbleTrait.php';
require_once 'Interfaces/RenderbleInterface.php';
require_once 'Interfaces/XMLserializeble.php';

/**
 * Description of AbstractContentObjectStorage
 *
 * @author Gourav Sarkar
 */
abstract class AbstractContentObjectStorage extends SplObjectStorage implements XMLSerializeble {

    //put your code here
    //use RenderbleTrait;
    protected $storage_type;

    /*
     * @PARAM $objType must be a name of valid class
     */

    public function __construct($objType='') {
        if (empty($this->storage_type)) {
            $this->storage_type = $objType;
        }
        
        assert('!empty($this->storage_type)');
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

        $output = '';

        /*
         * Handle object storage data structure
         */
        $subWriter = new XMLWriter();
        $subWriter->openMemory();

        $subWriter->startElement((String) $this);


        /*
         * Handle regular property
         */
        $writer = new XMLWriter();
        $writer->openMemory();

        $xmlSer = new XMLSerialize($this);
        $writer->writeRaw($xmlSer->xmlSerialize());

        $subWriter->writeRaw($writer->outputMemory(true));
        unset($writer);


        foreach ($this as $element) {
            //echo "<b>$element</b>" . $element->getID() . "<br/>";
            //var_dump($element);
            //$writer->startElement((string)$element);
            $writer = new XMLSerialize($element);
            $subWriter->startElement((String) $element);
            $subWriter->writeRaw($writer->xmlSerialize());
            $subWriter->endElement();
            //$writer->endElement();
        }

        $subWriter->endElement();


        return $output . $subWriter->outputMemory(true);
    }

}

?>
