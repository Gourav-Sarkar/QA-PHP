<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ContentCacheMediator
 *
 * @author Gourav Sarkar
 */
class ContentCacheMediator 
    implements SplObserver
                ,SplSubject
{
    
    private $state;
    //put your code here
    public function attach(\SplObserver $observer) {
        ;
    }
    public function detach(\SplObserver $observer) {
        ;
    }
    public function notify() {
        ;
    }
    public function update(\SplSubject $subject) {
        $subject->{"$this->state"}();
    }
    
    public function setState($state)
    {
        $this->state=$state;
    }
}

?>
