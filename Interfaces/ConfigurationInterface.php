<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Gourav Sarkar
 */
interface ConfigurationInterface {
    //put your code here
    public function getModule();
    public function getTarget();
    public function getActor();
    public function getAction();
}

?>
