<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Auth
 *
 * @author Gourav Sarkar
 */
abstract class AbsractAuth 
    implements AuthenticationInterface
    //implements AuthenticationInterface
{
    
    abstract public function auth();
}

?>
