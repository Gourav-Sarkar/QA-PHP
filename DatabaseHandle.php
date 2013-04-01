<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DatabaseHandle
 *
 * @author Gourav Sarkar
 */
class DatabaseHandle {
    //put your code here

    private static $con; //IS not accessible,modifiable from out side
    
    //Database credentials
    private static $driver='mysql';
    private static $server="localhost";
    private static $password='';
    private static $userName="root";
    private  static $dbname="Stackoverflow";


    public static function getConnection()
    {
        //Only connect to database if $con is not set already
        if(!isset(DatabaseHandle::$con))
        {
            $dsn= DatabaseHandle::$driver .":host=" .DatabaseHandle::$server .";dbname=" . DatabaseHandle::$dbname;
            //var_dump($dsn);
            
            DatabaseHandle::$con= new PDO($dsn,  DatabaseHandle::$userName ,  DatabaseHandle::$password);
            DatabaseHandle::$con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            
        }
        
        return DatabaseHandle::$con;
    }
    
    public static function setDatabaseName($name)
    {
        static::$dbname=$name;
        
        //reset connection
        static::$con=null;
    }
}

//DEBUG statments
//$t=DatabaseHandle::getConnection();
//var_dump($t);
?>

