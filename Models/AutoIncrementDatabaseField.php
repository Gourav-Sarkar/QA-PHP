<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AutoIncrementDatabaseField
 *
 * @author Gourav Sarkar
 */
class AutoIncrementDatabaseField {
    //put your code here
    private $dependency;
    
    public function __construct(AbstractContent $ref) {
        $this->dependency=$ref;
    }
    
    public function incrementField($fieldName,$increment=1)
    {
        if(method_exists($this->dependency, $fieldName))
        {
            
            return true;
        }
        
        trigger_error("Invalid Field to Auto increment");
    }
}

?>
