<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Abstracts/AbstractContent.php';
/**
 * Description of Click
 *
 * @author gourav sarkar
 */
class Click extends AbstractContent{
    //put your code here
    
    private $campaign;
    private $browser;
    
    public function __construct() {
        parent::__construct();
        
        $this->campaign=new Campaign();
    }
    
    public function setContent($content) {
        //parent::setContent($content);
        throw new BadMethodCallException("Invalid method call");
    }
    
    public function getContent() {
        //parent::getContent();
        throw new BadMethodCallException("Invalid method call");
    }
    
    public function setBrowser($browser=null)
    {
        $this->crud->setFieldCache("browser");
        if(is_null($browser))
        {
            $browser=$_SERVER['HTTP_USER_AGENT'];
        }
        
        $this->browser=$browser;
    }
    
    public function getBrowser()
    {
        return $this->browser;
    }
    public function setCampaign(Campaign $camp)
    {
        $this->crud->setFieldCache("campaign");
        $this->campaign=$camp;
    }
    public function getCampaign()
    {
        return $this->campaign;
    }
}

?>
