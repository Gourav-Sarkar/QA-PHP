<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'abstracts/AbstractAnnonymosContent.php';
require_once 'storages/journalStorage.php';
/**
 * Description of Journal
 *
 * @author gourav sarkar
 */
class Journal extends AbstractAnnonymosContent{
    //put your code here
    private $passCode;
    
    public function setPassCode($passcode)
    {
        $this->crud->setFieldCache("passCode");
        $this->passCode=$passcode;
    }
    public function getPassCode()
    {
        return $this->passCode;
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
