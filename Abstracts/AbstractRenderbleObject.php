<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once "Models/BaseObject.php";
/**
 * Description of AbstarctRenderbleObject
 *
 * could be move this class to base object though
 * @author gourav sarkar
 */
class AbstractRenderbleObject extends BaseObject implements XMLSerializeble{
    //put your code here
    
    public function xmlSerialize() {

        $writer = new XMLWriter();
        $writer->openMemory();

        $writer->startElement((string) $this);
        $xmlSer = new XMLSerialize($this);
        $writer->writeRaw($xmlSer->xmlSerialize());
        $writer->endElement();


        return $writer->outputMemory(true);
    }
}

?>
