<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'abstracts/abstractController.php';
require_once DOCUMENT_ROOT.'models/campaign.php';
/**
 * Description of CampaignController
 *
 * @author Gourav Sarkar
 */
class CampaignController extends AbstractController{
    //put your code here
    
    public function __construct() {
        parent::__construct();
        
        $this->model=new Campaign();
        
        $this->view->addTemplate("campaign");
        $this->view->addTemplate("user");
    }
    
    public function create()
    {
        var_dump($_POST['area']);
        
        $this->model->setTitle($_POST['title']);
        $this->model->setContent($_POST['content']);
        $this->model->setCapital($_POST['capital']);
        //$this->model->setMoneyTransactID()
        $this->model->setArea($_POST['area']);
        $this->model->setTargetTraffic($_POST['target_traffic']);
        $this->model->setInvisible(true);
        
        $this->model->create();
    }
    
    /*
     * Shows only activated campaign list (for user)
     */
    public function getActiveCampaignList()
    {
        var_dump(__METHOD__);
    }
    
    /*
     * Show all campaign (for admin)
     */
    public function getListAll()
    {
        $campaigns=Campaign::listing(new Campaign());
        $this->view->addModel($campaigns->xmlSerialize(),"userModes");
        
        echo $this->view->render();
    }
    
    /*
     * General getlist (for owner/advertiser)
     */
    public function getList()
    {
        var_dump(get_defined_constants("campaign"));
    }
    
    public function approve()
    {
        
    }
    
    public function disapprove()
    {
        
    }
    
    public function remove()
    {
        
    }
    public function show()
    {
        $this->model->setID($_GET['campaign']);
        $this->model->read();
        
        $this->view->addModel($this->model->xmlSerialize());
        
        echo $this->view->render();
    }
    
    public function promote()
    {
        
        
        /*
         * Fetch url which is target of promotion
         */
        $this->model->setID($_GET['campaign']);
        $this->model->read();
        
        
        /*
         * Enlist 
         */
        $click=new Click();
        $click->setTime();
        $click->setIP();
        $click->setBrowser();
        $click->setUser(User::getActiveUser());
        $click->setInvisible();
        $click->setCampaign($this->model);
        
        $click->create();
        
        
        $url=$this->model->getURL();
        
        var_dump($this->model->getUrl());
        
        header("Location:$url");
        exit();
    }
}

?>
