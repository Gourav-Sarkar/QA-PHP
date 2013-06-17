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
    
    /*
     * @issue $server could not resolveded to correct ip address in 5.3
     *  Where as 5.4 resolved it well
     */
    private static $server="127.0.0.1";
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

