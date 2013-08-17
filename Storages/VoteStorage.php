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
class VoteStorage extends AbstractContentObjectStorage {

    //put your code here
    protected $votes = 0;
    protected $hasVoted = false;
    protected $formatedVotes=0;

    /*
      private $dependency;

      public function __construct(AbstractContent $deps) {
      parent::__construct();
      $this->dependency=new DependencyObject($deps);
      }
     * 
     */

    public function setHasVoted($isVoted) {
        if (!empty($isVoted)) {
            $this->hasVoted = $isVoted;
        }
    }

    public function getHasVoted() {
        return $this->hasVoted;
    }

    public function getVotes() {
        return $this->votes; 
    }

    public function setVotes($votes) {
        if (!empty($votes)) {

            $this->votes = $votes;
            $this->formatVote();
        }
    }
    
     
    private function formatVote() {
         $this->formatedVotes=number_format($this->votes,2);
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

    private function calculateVote(AbstractVote $vote) {
        /*
         * Get total votes
         */
        $query = sprintf("SELECT SUM(weight)/COUNT(weight) FROM %s  WHERE %s=? GROUP BY weight"
                , $vote
                , $vote->getReference()
        );

        $stmt = DatabaseHandle::getConnection()->prepare($query);
        $stmt->execute(array($vote->getReference()->getID()));

        $this->votes = $stmt->fetch(PDO::FETCH_NUM)[0];
    }



}

?>
