<?php
 
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Abstracts/AbstractAnnonymosTitledContent.php';
/**
 * Description of Emotion
 *
 * @author gourav sarkar
 */
class Emotion extends AbstractAnnonymosTitledContent{
    //put your code here
    const EMO_STORE_NAME='emotion';
    
    private $dependency;
    private $rating;
    
    private $emotionList;
    private $emotionData=array();
    
    public function __construct(Journal $journal) {
        parent::__construct();
        $this->emotionList=new SimpleXMLElement(SETTING_ROOT . static::EMO_STORE_NAME .'.xml'
                                , null
                                , true);
        
        $this->dependency=new DependencyObject($journal);
    }
    
    public function setRating($rating)
    {
        //Must be between 1-5
        $this->rating=$rating;
    }
    public function getRating()
    {
        return $this->rating;
    }
    
    public function read() {
        parent::read();
    }
    
    public function setTitle($title) {
        parent::setTitle($title);
    }
    
    /*
     * @todo Bulk validation Move to corresponding Storage
     * @return boolean true/false
     * @throw NoEntryFoundException
     */
    private function isValidEmotion()
    {
        $xq="emotion[@name='%s']";
        
        //var_dump(x$q);
        
        $this->emotionData=$this->emotionList->xpath(sprintf($xq, $this->title));
        //var_dump($this->emotionData);
        if(empty($this->emotionData))
        {
            throw new NoEntryFoundException("There is no such emotion enlisted");
        }
    }
    
    
    public function populate()
    {
        $this->isValidEmotion();
        
        //get Node list
        $xmlNode=$this->emotionData[0];
        
        $this->setContent($xmlNode);
        $this->setID($xmlNode['id']);
        
        //var_dump($this);
        
    }
}

?>
