<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tagMapper
 * Throws exception when tries to map a tag which does not exist,at least one tag is crucial
 * @author Gourav Sarkar
 */
class TagQuestionMapper implements CRUDLInterface{
    //put your code here
    private $question;
    
    public function __construct(AbstractQuestion $ques) {
        $this->question=$ques;
    }
    
    
    public function create()
    {
        $refClass=get_class($this->question);
        
        $query=sprintf("INSERT IGNORE INTO %s VALUES(?,?)",  get_class($this));
        $stmt= DatabaseHandle::getConnection()->prepare($query);
        
        $id=$this->question->getID();
        $stmt->bindValue(2,$id);
        
        
        $tagList=$this->question->getTags();
        
        foreach($tagList as $tag)
        {
            $name=$tag->getName();
            
            var_dump($name,$id);
            
            $stmt->bindParam(1,$name);
            $e=$stmt->execute();
            
            //var_dump($e);
        }
    }
    
    public function delete() {
        ;
    }
    
    public static function listing(\DatabaseInteractbleInterface $reference) {
        $tagStore=new TagStorage();
        
        $query=sprintf("SELECT * FROM tagQuestionMapper WHERE question=?");
        $stmt=DatabaseHandle::getConnection()->prepare($query);
        
        $stmt->execute(array($reference->getID()));
        
        while($data=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            $tag=new Tag($reference);
            $tag->setName($data['tag']);
            
            $tagStore->attach($tag,$tag);
            
            //var_dump($tagStore->count());
            //var_dump($data);
        }
        //var_dump($tagStore->count());
        
        return $tagStore;
    }

        
    
    
    
    public function edit(\DatabaseInteractbleInterface $tempObj) {
        trigger_error("Restricted method call");
    } 
    public function read() {
        trigger_error("Restricted method call");
    }
}

?>
