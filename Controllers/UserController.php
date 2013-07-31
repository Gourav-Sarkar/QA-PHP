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
    private $view;
    public function __construct() {
        $this->user=new User();
        $this->view=new Render();
    }
    
    public function create()
    {
        echo __METHOD__;
        $this->user->setNick($_POST['nick']);
        $this->user->setPassword($_POST['password']);
        $this->user->setEmail($_POST['email']);    
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
        var_dump($this->user);
        
        $this->view->setModel($this->user->xmlSerialize());
        $this->view->setDumper('dumper.xml');
        echo $this->view->Render();
        
    }
}

?>
