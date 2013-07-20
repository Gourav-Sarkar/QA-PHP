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
abstract class AbstractContentObjectStorage extends SplObjectStorage implements XMLSerializeble
//implements ListbleInterface 
{

    //put your code here
    //use RenderbleTrait;
    //protected $reference;
    //protected $connection;

    public function getHash($object) {
        $id = $object->getID();
        //echo $id;
        //Ensure id is there
        //assert('empty($id);');
        return (string) $id;
    }

    public function __toString() {
        return get_class($this);
    }


    public function xmlSerialize() {
        
         $output='';
         
        /*
         * Handle regular property
         */
        $writer=new XMLWriter();
        $writer->openMemory();
        
        $writer->startElement((string) $this);
            $xmlSer = new XMLSerialize($this);
            $writer->writeRaw($xmlSer->xmlSerialize());
        $writer->endElement();
        
        $output=$writer->outputMemory(true);
        /*
         * Handle object storage data structure
         */
         $subWriter=new XMLWriter();
         $subWriter->openMemory();
         
         $subWriter->startElement((String) $this);
        
         foreach ($this as $element) {
            //echo "<b>$element</b>" . $element->getID() . "<br/>";
            //var_dump($element);
            //$writer->startElement((string)$element);
            $writer=new XMLSerialize($element);
            $subWriter->startElement((String)$element);
            $subWriter->writeRaw($writer->xmlSerialize());
            $subWriter->endElement();
            //$writer->endElement();
        }
        
        $subWriter->endElement();
        
        
        return $output . $subWriter->outputMemory(true);
    }

}

?>
