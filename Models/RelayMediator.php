<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'Abstracts/AbstractUniqueClassObjectStorage.php';
require_once 'interfaces/RelayInterface.php';
/**
 * Description of RelayMediator
 *
 * @author Gourav Sarkar
 */
class RelayMediator 
    extends AbstractUniqueClassObjectStorage
    implements SplObserver
                ,SplSubject
                ,RelayInterface
{
    //put your code here
    private $origin;
    private $message;
    
    public function Relay($msg) 
    {
        $this->message=$msg;
    }
    public function getRelayMessage()
    {
        return $this->message;
    }
    
    /*
     * Emmits E_STRICT error
     */
    public function attach(\SplObserver $observer) {
        parent::attach($observer, $observer);
    }
    
    /*
     * Emmits E_STRICT error
     */
    public function detach(\SplObserver $observer) {
        parent::detach($observer);
    }
    public function notify() {
        //echo "Relaying message";
        //var_dump($this->target);
        
        foreach($this as $observer)
        {
            /*
             * Up[date ovservers and pass RelayMediator as event message
             */
            $observer->update($this);
        }
    }
    public function update(\SplSubject $subject) {
        $this->origin=$subject;
        $this->notify();
    }
    
    public function getOrigin()
    {
        return $this->origin;
    }
}

?>
