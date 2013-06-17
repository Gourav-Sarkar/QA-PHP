<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$xml=new XMLWriter();
$xml->openMemory();
$xml->writeElement('Alpha','beta');
echo $xml->outputMemory();
?>
