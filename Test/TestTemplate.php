<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TestTemplate
 *
 * @author Gourav Sarkar
 */
class Bar
{
    private $foo=13;
    public function getFoo()
    {
        return $this->foo;
    }
}

class TestTemplate {
    //put your code here
    private $placeholder; //It is object it will use getter method to get properties
    private $template;
    
    public function TestTemplate()
    {
        $this->template="template.php";
    }
    public function add($obj)
    {
        $this->placeholder=$obj;
    }
    
    public function setup($tmp)
    {
        $this->template=$tmp;
    }
    
    public function render()
    {
        ob_start();
        include $this->template;
        //$output=ob_get_contents();
        return ob_get_clean();
    }
}

$Barinst=new Bar();
$tmp= new TestTemplate();
$tmp->add($Barinst);
echo $tmp->render();
?>
