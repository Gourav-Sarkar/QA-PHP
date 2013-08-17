<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Interfaces/XmlSerializeble.php';
/**
 * Description of AbstractPseudoObjectStorage
 *
 * @author Gourav Sarkar
 */
abstract class AbstractPseudoObjectStorage 
//implements XMLSerializeble
{
    //put your code here
    protected $data=array();
    
    public function attach($object)
    {
        $this->data[$this->getHash($object)]=$object;
    }
    
    public function detach($object)
    {
        unset($this->data[$this->getHash($object)]);
    }
    
    abstract public function getHash($object);
    
    public function offsetGet($object)
    {
        return $this->data[$this->getHash($object)];
    }
    public function count() 
    {
        return count($this->data);
    }
    public function contains($object)
    {
        return isset($this->data[$this->getHash($object)]);
    }
    
    
    
    public function __toString() {
        return get_class($this);
    }
    
    /*
    public function xmlSerialize() {

        $output = '';

        //Handle object storage data structure
         
        $subWriter = new XMLWriter();
        $subWriter->openMemory();

        $subWriter->startElement((String) $this);


        // Handle regular property
         
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
    */
}

?>
