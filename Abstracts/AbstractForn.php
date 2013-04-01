<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AbstractForn
 *
 * @author Gourav Sarkar
 */
class AbstractForn {
    
    use RenderbleTrait;
    //put your code here
    const FORM_POST='post';
    const FORM_GET='get';
    
    private $method;
    private $target;
    private $inputs;
    
    public function __construct()
    {
        $this->inputs=SplObjectStorage();
    }
    public function setMethod($method)
    {
        //assert();
        $this->method=$method;
    }
    public function settarget($targetLink)
    {
        //assert();
        $this->$target=$targetLink;
    }
    
    public function attach(AbstractInput $input)
    {
        $this->inputs->attach($input);
    }
}

?>
