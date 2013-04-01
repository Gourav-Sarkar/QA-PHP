<?php

abstract class testconst {
    const YEY = 0;
    public function dosomething(){
            if(testconst::YEY == 0)
                    return "Awesome!";
    }
}
class test extends testconst {
    public function something(){
            return parent::dosomething();
    }
}

$t= new test();
echo $t->something();
?>
