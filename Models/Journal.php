<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'abstracts/AbstractAnnonymosContent.php';
require_once 'models/emotion.php';

require_once 'storages/journalStorage.php';
require_once 'storages/EmotionStorage.php';
require_once 'storages/ArticleStorage.php'; //fake
require_once 'storages/DefaultContentStorage.php';
require_once 'models/JournalTagMap.php';
/**
 * Description of Journal
 *
 * @author gourav sarkar
 */
class Journal extends AbstractAnnonymosContent{
    //put your code here
    private $passCode;
    
    /*
     * Attatched pictures with entry
     */
    private $pictures;
    private $emotions;
    private $tags;
    
    public function __construct() {
        parent::__construct();
        
        $this->pictures=new ArticleStorage("article");
        $this->emotions=new EmotionStorage("emotion");
        $this->tags=new JournalTagMap($this,new Tag($this));
        
    }


    public function setPassCode($passcode)
    {
        $this->crud->setFieldCache("passCode");
        $this->passCode=$passcode;
    }
    public function getPassCode()
    {
        return $this->passCode;
    }
    
    /*
     * @PARAM array
     */
    public function addEmotion($emotions)
    {
        foreach($emotions as $emotion)
        {
            $emObj=new Emotion($this);
            $emObj->setTitle($emotion);
            $emObj->populate();
            
            //Replace with storage create for optimisation
            $this->emotions->attach($emObj, $emObj);
            $emObj->create();
        }
    }
    
    /*
     * @Security
     * Encrypt fields you want to fill
     */
    private function Encrypt()
    {
        
    }
    
    /*
     * @Security
     * Decrypt fields you want to fill
     */
    private function Decrypt()
    {
        
    }
    
    public function create() {
        if(!empty($this->passCode))
        {
            $this->Encrypt();
        }
        
        return parent::create();
    }
    
    public function read() {
        //Read from database
        $obj=parent::read();
        
        //if pass key is set decrypt the data
        if(!empty($this->passCode))
        {
            $obj->Decrypt();
        }
        
        //return object as parent;
        return $obj;
    }

    public static function listing(\DatabaseInteractbleInterface $reference, $args = array()) {
        $journalStore=new JournalStorage("journal");
        
        $queryFrags=parent::listing($reference, $args);
        
        var_dump($queryFrags);
        
        if(isset($args['time']))
        {
            $today=new DateTime("today");
        }
        
            //@todo Add automated field name generator
            $queryFrags[CRUDobject::QFRAG_IDF_WHERE] .= sprintf("journal.time>%d AND journal.time<%d"
                                ,$today->getTimestamp()
                                ,$today->getTimestamp()+86400);
        
        $query=sprintf("%s WHERE %s",$queryFrags[CRUDobject::QFRAG_IDF_MAIN],$queryFrags[CRUDobject::QFRAG_IDF_WHERE]);
        var_dump($query);
        
        $stmt=DatabaseHandle::getConnection()->prepare($query);
        $stmt->execute();
        
        while($data=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            $objs=CRUDobject::map($data);
            $journalStore->attach($objs['journal'], $objs['journal']);
        }
        
        return $journalStore;
    }
    
}

?>
