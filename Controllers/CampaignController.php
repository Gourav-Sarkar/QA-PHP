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
    }
    
    public function getList()
    {
        var_dump(__METHOD__);
    }
    public function show()
    {
        $this->model->setID($_GET['campaign']);
        $campaign=$this->model->read();
        
        $this->view->addModel($this->model->xmlSerialize());
        
        echo $this->view->render();
    }
}

?>
