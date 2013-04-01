<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VoteableTrait
 *
 * @author Gourav Sarkar
 */
trait VoteableTrait {
    //put your code here
    
    private $votes=0;
    
    
   
    private function vote($type)
    {
        
        try {
        $vote= new QuestionVote($this);
        $vote->setUser($_SESSION['self']);
        $vote->setTime();
        $vote->setType($type);
        $vote->setWeight();
        $vote->setConnection();
        
        $vote->create();
        
        
        echo __METHOD__;
        
        $query=sprintf("UPDATE %s SET votes=votes%s WHERE id=?"
                        ,get_class($this)
                        ,$vote->getWeight()
                        );
        echo $query;
        $stmt=static::$connection->prepare($query);
        $stmt->bindValue(1,$this->getID());
        
        $stmt->execute();
        }
        catch(PDOException $e)
        {
            //var_dump($e->errorInfo);
            if($e->errorInfo[1]===1062)
            {
                echo "discard";
               $vote= new QuestionVote($this);
               $vote->setUser($_SESSION['self']);
               $vote->setConnection();
               $vote->delete();
               
               $this->discardVote();
            }
        }
    }
    
    public function discardVote()
    {
        $query=sprintf("UPDATE %s SET votes=votes+(SELECT weight FROM questionVote WHERE question=? AND user=?) WHERE id=?"
                        ,get_class($this)
                        
                        );
        $stmt=static::$connection->prepare($query);
        $stmt->bindValue(1,$this->getID());
        $stmt->bindValue(2,$this->getUser()->getID());
        $stmt->bindValue(3,$this->getID());
        
        $stmt->execute();
    }
    
   public function getVotes()
   {
       return $this->votes;
   }
   public function setVotes($votes)
   {
       return $this->votes=$votes;
   }
   
   public function upVote()
   {
       $this->vote(AbstractVote::VOTE_UP);
   }
   
   public function downVote()
   {
       $this->vote(AbstractVote::VOTE_DOWN);
   }
}

?>
