<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AbstractController
 *
 * @author Gourav Sarkar
 */
abstract class AbstractController {
    //put your code here
    public function __constrcut($model,$depedency=null)
    {
        if(!is_null($depedency))
        {
            $this->model=new $model($dependency);
        }
        else
        {
            $this->model=new $model();
        }
        
        AbstractContent::setConnection(DatabaseHandle::getConnection());
    }
    abstract public function create();
    abstract public function delete();
    abstract public function show();
    abstract public function edit();
}

?>
