<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Abstracts/AbstractContent.php';

/**
 * Description of Campaign
 *
 * @author Gourav Sarkar
 */
class Campaign extends AbstractContent{
    //put your code here
    private $fund; //SENSITIVE
    private $expectedTraffic;
    private $type; //Ad type like CPM, per register,per visit, per impression
    
    public function setFund($fund)
    {
        //Must be string and numeric
        $this->fund=$fund;
        
    }
    public function getFund()
    {
        return $this->fund;
    }
    
    public function setExpectedTraffic($expTraffic)
    {
        $this->expectedTraffic=$expTraffic;
        
    }
    public function getExpectedTraffic()
    {
        return $this->expectedTraffic;
    }
}

?>
