<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'abstracts/AbstractContentObjectStorage.php';
/**
 * Description of DefaultStorage
 *
 * @author gourav sarkar
 */
class DefaultContentStorage extends AbstractContentObjectStorage{
    //put your code here
    /*
     * Attribute can be removed
     */
    
    /*
     public function xmlSerialize() {


        $xmlSer = new XMLSerialize($this);
        $xmlSer->getWriter()->startElement((string) $this);
        $xmlSer->getWriter()->writeAttribute('name',$this->storageType);
        $xmlSer->getWriter()->writeRaw($xmlSer->xmlSerialize());
        foreach ($this as $content) {
            $xmlSer->getWriter()->writeRaw($content->xmlSerialize());
        }
        $xmlSer->getWriter()->endElement();
        //var_dump($xmlSer->xmlSerialize());
        return $xmlSer->getWriter()->outputMemory(true);
    }
     * 
     */
}

?>
