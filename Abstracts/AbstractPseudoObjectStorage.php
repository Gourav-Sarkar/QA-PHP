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
abstract class AbstractPseudoObjectStorage implements Iterator, ArrayAccess
//implements XMLSerializeble
{
    //put your code here
    protected $data=array();
    
    private $pointer=0;
    
    public function attach($object,$data)
    {
        $this->data[$this->getHash($object)]=$data;
    }
    
    public function detach($object)
    {
        unset($this->data[$this->getHash($object)]);
    }
    
    abstract public function getHash($object);
    
   
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
     * Array Access overriding 
     */
     public function offsetGet($object)
    {
         //$data=$this->data[$this->getHash($object)]);
         if(isset($this->data[$this->getHash($object)]))
         {
             return $this->data[$this->getHash($object)];
         }
         
         throw new UnexpectedValueException();
    }
    public function offsetExists($offset) {
        return isset($this->data[$offset]);
    }
    public function offsetUnset($offset) {
        unset($this->data[$offset]);
    }
    public function offsetSet($offset, $value) {
        $this->data[$offset]=$value;
    }
    
    
    /*
     * Iterator interface overriding 
     */
    public function current() {
        //var_dump("current" , $this->pointer);
        
        
        $keys=array_keys($this->data);
        //var_dump($keys[$this->pointer]);
        //var_dump($this->data);
        
        
        return $this->data[$keys[$this->pointer]];
    }
    public function next() {
        ++$this->pointer;
        //var_dump("next" , $this->pointer );
    }
    public function key() {
        //var_dump("key" , $this->pointer);
        $keys=array_keys($this->data);
        return $keys[$this->pointer];
    }
    public function valid() {
       // var_dump("valid" , $this->pointer);
        $keys=array_keys($this->data);
        
        //var_dump(isset($keys[$this->pointer]));
        
        return isset($keys[$this->pointer]);
    }
    public function rewind() {
        //var_dump("rewind" , $this->pointer);
        $this->pointer=0;
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
