<?php
/* 
 * Permanant and temporary both cache file should be revaildate if any changes happens in
 * cache file. if it changes withing system revalidate everytime(admin panel)
 * 
 * Textual data can be compressed to save diskspace
 * 
 * Things that should be cached by priority
 * 
 * Core levele system
 * User credential for each user to resolve subdomain to load appropiate application strcuture
 * Configuration files for system
 * Configuration file for each user
 * System message,object configuration,object behaviour file for each user
 * common object like (tags) for each user
 * Session management (time constrained)
 * Question caching if server permits (time limited)
 */
ini_set("xdebug.var_display_max_data", -1);
require_once "config.php";
require_once 'DatabaseHandle.php';
require_once 'sessionDatabase.php';
require_once 'util/utility.php';

require_once 'models/user.php';
require_once 'models/resource.php';
require_once 'controllers/userController.php';
require_once 'controllers/questionController.php';
require 'exception/PermissionDeniedException.php';


session_set_save_handler(new SessionDatabase(DatabaseHandle::getConnection()),true);
session_start();

/*
        $ques = new Question();
        $ques->setConnection(DatabaseHandle::getConnection());
        $data= $ques->get(1);
        echo "<pre>" .print_r($data,true) . "</pre>";
        
        echo "<br/>";
        $answer=$ques->getAnswers();
        //var_dump($data,$answer);
        
        echo "<pre>" .print_r($answer,true) . "</pre>";
 * 
 */



/*
 * Initialize system setting,error,message files
 */

/*
 * Initiliize controller of model
 * $perm = new Permission($model);
 * $perm->setAction($_GET['action');
 * $perm->setActor($_SESSION['self']);
 * 
 * $perm->hasPermission();
 */
//var_dump(__FILE__ . "get roles");
    
//var_dump($_SESSION['self']->getRoles()->count());

//DO NOT DELETE/Comment IMPORTANT FOR DEBUGGING CACHE PROBLEM
//var_dump(apc_cache_info("user"));
apc_clear_cache("user");
//var_dump(hash_algos());

//var_dump($_SERVER);

//Normalize GET POST
//array_change_key_case($_GET);
$resource=new Resource();
$resource->setController($_GET['module']);
$resource->setAction($_GET['action']);


$resource->get();

/*
try
{
    User::getActiveUser()->hasPermission($resource); //Throw Permission denied
    $resource->get();
}
 catch (PermissionDeniedException $e)
 {
    var_dump($e->getMessage());
     //$resource->get();
 } 
 
//*/

//$_SESSION['self']->hasPermission($resource);

//file_get_contents("dummyText.txt");
?>
         