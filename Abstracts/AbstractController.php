<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'DependencyObject.php';
/**
 * Description of AbstractController
 * @todo layout basic controller set up
 * @todo Ensure intigrity of controllers- methods are public,final,no args
 * @author Gourav Sarkar
 */
abstract class AbstractController {
    //put your code here
    protected $model;
    protected $view;
    
    public function __constrcut()
    {
        $this->view=new Render();
    }
    abstract public function create();
    abstract public function delete();
    abstract public function show();
    abstract public function edit();
}

?>
