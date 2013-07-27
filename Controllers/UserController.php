<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserController
 *
 * @author Gourav Sarkar
 */
class UserController {
    //put your code here
    private $user;
    
    public function __construct() {
        $this->user=new User();
    }
    
    public function create()
    {
        echo __METHOD__;
        $this->user->setNick($_POST['nick']);
        $this->user->setPassword($_POST['password']);
        $this->user->setEmail($_POST['email']);     
        $this->user->setConnection(DatabaseHandle::getConnection());        
        $this->user->create();
    }
    public function auth()
    {
        echo __METHOD__;
        $this->user->setNick($_POST['nick']);
        $this->user->setPassword($_POST['password']);
        $this->user->auth();
    }
    public function show()
    {
        $this->user->setID($_GET['user']);
        //$this->user->read();
        $this->user->Softread();
        
        echo $this->user->render(new Template('user-profile'));
    }
}

?>
