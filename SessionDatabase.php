<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SessionDatabase
 *
 * @author Gourav Sarkar
 */
class SessionDatabase implements SessionHandlerInterface{
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
       
        $stmt->execute([$session_id, ip2long($_SERVER['REMOTE_ADDR'])]);
        //var_dump($r);
        //var_dump($stmt->fetch()['content']);
        return $stmt->fetch()['content'];
    }
    
    public function write($session_id, $session_data) {
        //$ip=ip2long($_SERVER['REMOTE_ADDR']);
        //$time=time();
        
        //echo "writiing session database";
        
        $query="INSERT INTO session(id,content,ip,time) VALUES(?,?,?,?)
                ON DUPLICATE KEY
                UPDATE content=?,time=?";
        $stmt=$this->connection->prepare($query);
        
        $stmt->execute(
                        [$session_id
                        ,$session_data
                        ,ip2long($_SERVER['REMOTE_ADDR'])
                        ,time()
                        ,$session_data 
                        ,time()
                        ]
                       );
        
    }
    
    public function gc($maxlifetime) {
        ;
    }
    
    public function destroy($session_id) {
        $query="DELETE FROM session WHERE id=?";
        $stmt=  $this->connection->prepare($query);
        $stmt->execute([$session_id]);
    }
}
?>
