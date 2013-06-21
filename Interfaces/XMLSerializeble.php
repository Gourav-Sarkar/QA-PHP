<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Implements objects who need to be serialized in XML
 * Only XMLSerializble will be serailized to XML. Any object must have to implement this
 * to get serialized otherwise it will not be serialized
 * 
 * Each object may have different implemenetation ob XML serialization
 * 
 * Not nescarily all of the properties of a object need to be seralized. In that case
 *  Last time cleanup should be done in xmlserialize()
 * @author Gourav Sarkar
 */
interface XMLSerializeble {
    //put your code here
    public function xmlSerialize();
}

?>
