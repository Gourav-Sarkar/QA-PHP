<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Interfaces/XMLSerializeble.php';
/**
 * Description of XMLSerialize
 *
 * @author Gourav Sarkar
 */
class XMLSerialize implements XMLSerializeble {
    //put your code here

    const XML_VERSION = '1.0';
    const XML_ENCODING = 'UTF-8';

    private $dependency;
    private $xmlResource;

    public function __construct(XMLSerializeble $obj) {
        $this->dependency = $obj;
        $this->xmlResource = new XMLWriter();
        $this->xmlResource->openMemory();
        $this->xmlResource->setIndent(true);
    }

    private function initXML() {
        $this->xmlResource->startDocument(static::XML_VERSION, static::XML_ENCODING);
    }

    public function xmlSerialize() {
        $depRefl = new ReflectionObject($this->dependency);
        //var_dump($this->dependency);
        /*
         * get All property
         */
        $props = $depRefl->getProperties();

        foreach ($props as $property) {
            $property->setAccessible(true);

            $propertyData = $property->getValue($this->dependency);
            //var_dump((string)$propertyData);
            /*
             * If data is scalar type show the value
             */
            //echo 'Setting ' . $property->getName() . '<br/>';
            if ($propertyData instanceof XMLSerializeble) {
                
                //var_dump((string)$propertyData, $this->xmlResource->writeRaw($propertyData->xmlSerialize()));
                //echo "Setting object  ";
                //var_dump('Nested data ' , $propertyData->xmlSerialize());
                //$property->getName();
                //var_dump('Dumping',(string)$propertyData,$propertyData->xmlSerialize());
               $this->xmlResource->startElement($property->getName());
               $this->xmlResource->writeRaw($propertyData->xmlSerialize());
               $this->xmlResource->endElement();
               
            }
            elseif(!is_object($propertyData))
            {
                //echo " Setting scalar data";
                $this->xmlResource->writeElement($property->getName(),$propertyData);
            }
            
            //echo '<hr/>';
        }
        
        return $this->xmlResource->outputMemory(true);
    }
    
    

}

?>
