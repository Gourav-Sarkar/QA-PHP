<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Abstracts/AbstractContentObjectStorage.php';
/**
 * Description of VoteStorage
 *
 * @author Gourav Sarkar
 */
class VoteStorage extends AbstractContentObjectStorage{
    //put your code here
    protected $votes=0;
    
    /*
    private $dependency;
    
    public function __construct(AbstractContent $deps) {
        parent::__construct();
        $this->dependency=new DependencyObject($deps);
    }
     * 
     */
    
    public function getVotes()
    {
        return $this->formatVote();
    }
    public function setVotes($votes)
    {
        $this->votes=$votes;
    }
    
    public function attach($object, $data = null) {
        $object->create();
        parent::attach($object, $data);
        $this->calculateVote($object);
    }
    public function detach($object) {
        $object->create();
        parent::detach($object);
        $this->calculateVote($object);
    }
    
    private function calculateVote(AbstractVote $vote)
    {
        /*
         * Get total votes
         */
        $query=sprintf("SELECT SUM(weight)/COUNT(weight) FROM %s  WHERE %s=? GROUP BY weight"
                        ,$vote
                        ,$vote->getQuestion()
                        
                );
                
        $stmt=DatabaseHandle::getConnection()->prepare($query);
        $stmt->execute(array($vote->getQuestion()->getID()));
        
        $this->votes=$stmt->fetch(PDO::FETCH_NUM)[0];
        
    }
    
    /*
     * return short form of votes
     * two decimel number
     * G,K,M,B
     */
    private function formatVote()
    {
        return $this->votes;
    }
    
    
}

?>
