<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ChartBarChart
 *
 * @author Gourav Sarkar
 */
class ChartHistogram {
    //put your code here
    const CHAR_MARGIN=10;
    
    private $data; //Each chart will have data
    
    public function __construct($data) {
        $this->setData($data);
    }
    
    public function setData($data)
    {
        /*
         * $data[]=['x'=>value
         *          ,'y'=>value
         *          ];
         */
    }
    
    public function render()
    {
        /*
         * Decide X width,Y height
         * SUM of x value data
         * SUM of y value data
         */
        
    }
}

?>
