<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Interfaces/XMLSerializeble.php';

/**
 * Description of XMLSerialize
 * @todo Need iprovement
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

    
    public function getWriter()
    {
        return $this->xmlResource;
    }
    /*
     * Handle null value
     * 
     * @isssue array converting
     */

    public function xmlSerialize() {



        $depRefl = new ReflectionObject($this->dependency);
        //var_dump($this->dependency);
        /*
         * get All property
         */
        $props = $depRefl->getProperties();

        //Different Writer
        /*
        $objWriter=new XMLWriter();
        $objWriter->openMemory();
        $objWriter->setIndent(true);
        $objWriter->startElement((string) $this->dependency);
        */



        /*
         * Traverse through each property of the object
         */
        foreach ($props as $property) {
            $property->setAccessible(true);

            $propertyData = $property->getValue($this->dependency);
            
            
            /*
             * If data is scalar type show the value
             *
             */
            if (!is_object($propertyData)) {
                //echo " Setting scalar data";

                /*
                 * @NeedThinking
                 * Handle Boolean value. As False does not get printed it needs to
                 * convey its value. Boolean equivalant 1 or 0
                 * 
                 * Reason for commented:
                 * Though it is intended for XSLT stylesheet it may not be nesacry to do this
                 * As XSLT false represents empty nodes
                 */
                /*
                  if(is_bool($propertyData))
                  {
                  $propertyData=1;
                  if(!$propertyData)
                  {
                  $propertyData=0;
                  }
                  }
                 * 
                 */

                //@todo $property data can be get via getter to get data constantly
                //var_dump($propertyData);

                $this->xmlResource->writeElement($property->getName(), $propertyData);
                
                
            } else {
                /*
                 * Handle different type of object
                 * Dependency object and basic xmlSerializable object
                 * Different object need to be serialized differently
                 */
                if ($propertyData instanceof DependencyObject) {
                    $this->xmlResource->startElement("Dependency");
                    $this->xmlResource->writeElement((string) $propertyData->getReference(), (string) $propertyData->getReference()->getID());
                    $this->xmlResource->endElement();
                    
                    
                } elseif ($propertyData instanceof XMLSerializeble) {
                    
                    //Calls content serialize methods
                    $this->xmlResource->startElement($property->name);
                    $this->xmlResource->writeRaw($propertyData->xmlSerialize());
                    $this->xmlResource->endElement();
                    
                }
            }
        }

        //echo '<hr/>';
        /*
        if ($this->dependency instanceof AbstractContentObjectStorage) {
            foreach ($this->dependency as $content) {
                $this->xmlResource->writeRaw($content->xmlSerialize());
            }
        }
         * 
         */
        /*
        $objWriter->endElement();
        $objWriter->WriteRaw($this->xmlResource->outputMemory(true));
        return $objWriter->outputMemory(true);
        
         * 
         */
       return $this->xmlResource->outputMemory(true);
    }
    
    /*
    public function addData($content)
    {
        $this->xmlResource->writeRaw($content);
    }
     * 
     */
}

?>
