<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AbstractInternalMessage
 *
 * @author Gourav Sarkar
 */
class AbstractInternalMessage {
    //put your code here
    const prefix="CORE_SETTING";
    private $source;
    private $target;
    /*
     * Load string in APC
     * Load
     */
    public function __constrcut($target)
    {
        $this->target;
        //Check if it has been cached or not
        if($this->getKey())
        {
            
        }
    }
    
    public function getKey()
    {
        return sprintf("%s_%s_%s"
                        ,static::prefix
                        ,get_class($this)
                        ,get_class($target)
                    );
    }
}

?>
