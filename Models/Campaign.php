<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Abstracts/AbstractContent.php';

/**
 * Description of Campaign
 * @author Gourav Sarkar
 */
class Campaign extends AbstractContent{
    
    const CAMPAIGN_TYPE_VISIT=1;
    
    //put your code here
    private $fund; //SENSITIVE
    private $expectedTraffic;
    private $type; //Ad type like CPM, per register,per visit, per impression
    private $approve;
    
    public function setAprrove($apr)
    {
        $this->approve=$apr;
    }
    
    public function getApprove()
    {
        return $this->approve;
    }
    
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
