<?php
/*
spl_autoload_register(function($name)
                        {
                            require_once "$name.php";
                        }
                    , true);


session_set_save_handler(new SessionDatabase(DatabaseHandle::getConnection()),true);
session_start();

var_dump($_SESSION);
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$doc=new DOMDocument();
$doc->load('setting/setting.xml');

$stylesheet=new DOMDocument();
$stylesheet->load('setting/setting.xsl');

$procs=new XSLTProcessor();
$procs->importStylesheet($stylesheet);

echo $procs->transformToDoc($doc)->saveHTML();
?>
