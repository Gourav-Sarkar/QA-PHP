<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Custom session handling in database
 * 
 * @version PHP 5.4 uses SessionHandlerInterface
 * @version PHP 5.3 uses generic
 *
 * @author Gourav Sarkar
 */
class SessionDatabase 
//@version PHP 5.4 dependble
//implements SessionHandlerInterface
{
    //put your code here
    private $connection;
    
    public function SessionDatabase($con)
    {
        $this->connection=$con;
    }
    
    public function open($path,$id)
    {
        //Database connection is the path here
        //$this->connection=$path;
        //echo "opening session database";
        return (bool) $this->connection;
    }
    
    public function close()
    {
        
        //echo "closing session database";
        unset($this->connection);
        return true;
        
    }
    
    public function read($session_id) {
        
        //echo "reading session database";
        
        $query="SELECT content FROM session WHERE id=? AND ip=?";
        $stmt=$this->connection->prepare($query);
       
        /*
         * @version PHP 5.4 
         */
        /*
        $stmt->execute([$session_id, ip2long($_SERVER['REMOTE_ADDR'])]);
        */

        /*
         * @version PHP 5.3 
         */
        $stmt->execute(array($session_id, ip2long($_SERVER['REMOTE_ADDR'])));
        //var_dump($r);
        //var_dump($stmt->fetch()['content']);
        
        /*
         * @version PHP 5.4 
         */
        /*
         * return $stmt->fetch()['content']; 
         */
        
        /*
         * @version PHP 5.3 
         */
        $data=$stmt->fetch();
        return $data['content'];
    }
    
    public function write($session_id, $session_data) {
        //$ip=ip2long($_SERVER['REMOTE_ADDR']);
        //$time=time();
        
        //echo "writiing session database";
        
        $query="INSERT INTO session(id,content,ip,time) VALUES(?,?,?,?)
                ON DUPLICATE KEY
                UPDATE content=?,time=?";
        $stmt=$this->connection->prepare($query);
        
        /*
         * @version PHP 5.4 
         */
        /*
        $stmt->execute(
                        [$session_id
                        ,$session_data
                        ,ip2long($_SERVER['REMOTE_ADDR'])
                        ,time()
                        ,$session_data 
                        ,time()
                        ]
                       );
         * 
         */
        /*
         * @version PHP 5.3 
         */
        $stmt->execute(array
                        ($session_id
                        ,$session_data
                        ,ip2long($_SERVER['REMOTE_ADDR'])
                        ,time()
                        ,$session_data 
                        ,time()
                        )
                       );
        
    }
    
    public function gc($maxlifetime) {
        ;
    }
    
    public function destroy($session_id) {
        $query="DELETE FROM session WHERE id=?";
        $stmt=  $this->connection->prepare($query);
        
        /*
         * @version PHP 5.4 
         */
        //$stmt->execute([$session_id]);
        
        /*
         * @version PHP 5.3 
         */
        $stmt->execute(array($session_id));
    }
    
    
}

//session_set_save_handler(new SessionDatabase(DatabaseHandle::getConnection()),true);
/*
 * PHP 5.4 uses sessionHandlerInterface
 * Check the php version if it is lower than 5.4 use fallback
 * otherwise go normal way
 * 
 */

//session_set_save_handler(new SessionDatabase(DatabaseHandle::getConnection()),true);

$sesdb=new SessionDatabase(DatabaseHandle::getConnection());
        session_set_save_handler(       
                                 array($sesdb,'open')
                                ,array($sesdb,'close')
                                ,array($sesdb,'read')
                                ,array($sesdb,'write')
                                ,array($sesdb,'destroy')
                                ,array($sesdb,'gc')
                                );

?>
