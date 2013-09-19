<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'abstracts/abstractController.php';
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
}

?>
