<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Abstracts/AbstractContent.php';
require_once 'Models/Click.php';
require_once "Storages/CampaignStorage.php";

/**
 * Description of Campaign
 * @author Gourav Sarkar
 */
class Campaign extends AbstractContent{
    
    const CMP_TYPE_VISIT=1;
    const CMP_TYPE_SM=2;
    const CMP_TYPE_REG=3;
    
    //put your code here
    private $capital; //SENSITIVE
    private $targetTraffic;
    private $type; //Ad type like CPM, per register,per visit, per impression
    private $approve;
    //private $uniqueIpTimeSpan=86400;
    private $area;
    private $title;
    private $url;
    
    
    public function __construct() {
        parent::__construct();
    }
    
    public function setTitle($title)
    {
        $this->title=$title;
    }
    public function getTitle()
    {
        return $this->title;
    }
    
    /*
     * @todo Only allow constants of CPM_TYPE_*
     */
    public function setType($type)
    {
        $this->type=$type;
    }
    
    public function getType()
    {
        return $this->type;
    }
    
    public function setUrl($url)
    {
        $this->url=$url;
    }
    
    public function getUrl()
    {
        return $this->url;
    }
    
    public function setArea($area)
    {
        $this->area= $area;
    }
    public function getArea()
    {
        return $this->title;
    }
    
    
    public function setAprrove($apr)
    {
        $this->approve=$apr;
    }
    
    public function getApprove()
    {
        return $this->approve;
    }
    
    public function setCapital($fund)
    {
        //Must be string and numeric
        $this->capital=$fund;
        
    }
    public function getCapital()
    {
        return $this->capital;
    }
    
    public function setTargetTraffic($expTraffic)
    {
        $this->targetTraffic=$expTraffic;
        
    }
    public function getTargetTraffic()
    {
        return $this->targetTraffic;
    }
    
    /*
     * Unique hit can be anything click,register,like, algorith changes accordingly at later
     * parts depending on campaign type
     */
    public function getUniqueHit()
    {
        
    }
    public function getHits()    
    {
        
    }
    
    
    
    public function getList()
    {
        
    }
    
    public static function listing(\DatabaseInteractbleInterface $reference) {
        $campaignList=new CampaignStorage("Campaign");
        
        $query="SELECT
            *
            FROM campaign
            ";
        
        $stmt=DatabaseHandle::getConnection()->prepare($query);
        
        $stmt->execute();
        
        while($data=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            $cmp=new Campaign();
            $cmp->setID($data['id']);
            
            //var_dump($cmp);
            
            $campaignList->attach($cmp, $cmp);
        }
        
        return $campaignList;
    }
}

?>
