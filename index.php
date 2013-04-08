<?php
/* Things that should be cached by priority
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
require_once 'controllers/userController.php';
require_once 'controllers/questionController.php';

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


//DO NOT DELETE/Comment IMPORTANT FOR DEBUGGING CACHE PROBLEM
//var_dump(apc_cache_info("user"));
apc_clear_cache("user");
//var_dump(hash_algos());

//var_dump($_SERVER);

//Normalize GET POST
//array_change_key_case($_GET);

//Normalize module
$module=  strtolower($_GET['module']);

$controlerClass= "{$_GET['module']}Controller";
//Find and append controller class
$model = new $controlerClass($module);

if(method_exists($model, $_GET['action']))
{
    
    $model->$_GET['action']();
}
else {
    trigger_error("Invalid Request",E_USER_ERROR);
}

//file_get_contents("dummyText.txt");
?>
         