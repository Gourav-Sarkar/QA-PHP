<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of APCSession
 *
 * @author Gourav Sarkar
 */
class APCSession implements SessionHandlerInterface{
    //put your code here
    private $path;
    private $sessionID;
    public function __construct()
    {
        $this->path=get_class($this);
    }
    public function open($save_path, $session_id) {
        $this->sessionID="{$this->path}_{$session_id}";
    }
    public function close()
    {
        
    }
    public function write($session_id, $session_data) {
        apc_store($this->sessionID, $session_data , ini_get("sesuuion.gc_maxlifetime"));
    }
    public function read($session_id) {
        apc_fetch($this->sessionID);
    }
    
    public function destroy($session_id) {
        apc_delete($this->sessionID);
    }
    public function gc($maxlifetime) {
        
    }
}

?>
