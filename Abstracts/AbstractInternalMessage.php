<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 * all internal message should be cacheble
 */

/**
 * Description of AbstractInternalMessage
 *
 * @author Gourav Sarkar
 */
class AbstractInternalMessage {
    //put your code here
    const prefix="CORE_SETTING";
    
    private $target;
    
    private $FileDump; /* setting stored as text */
    /*
     * Load string in APC
     * Load
     */
    public function __constrcut($target)
    {
        $this->target=$target;
        
    }
    
    private function getKey()
    {
        return sprintf("%s_%s_%s"
                        ,static::prefix
                        ,get_class($this)
                        ,get_class($target)
                    );
    }
}

?>
