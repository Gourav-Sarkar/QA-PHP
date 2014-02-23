<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once "dependencyObject.php";
/**
 * Description of tagMapper
 * Throws exception when tries to map a tag which does not exist,at least one tag is crucial
 * @author Gourav Sarkar
 */
class TagQuestionMapper implements CRUDLInterface{
    //put your code here
    private $dependency;
    
    public function __construct(AbstractQuestion $ques) {
        $this->dependency=new DependencyObject($ques);
    }
    
    
    public function create()
    {
        
        /*
         * First reference to question, second reference to tag
         */
        $query=sprintf("INSERT INTO %s VALUES(?,?)",  get_class($this));
        $stmt= DatabaseHandle::getConnection()->prepare($query);
        
        //var_dump($this->dependency->getReference());
        
        $id=$this->dependency->getReference()->getID();
        assert('!empty($id)');
        
        $tagList=$this->dependency->getReference()->getTags();
        
        foreach($tagList as $tag)
        {
            $name=$tag->getName();
            
            var_dump($name,$id);
            
            $stmt->execute(array($name,$id));
            
            //var_dump($e);
        }
    }
    
    public function delete() {
        throw new BadMethodCallException();;
    }
    
    public static function listing(\DatabaseInteractbleInterface $reference,$args=array()) {
        $tagStore=new TagStorage('tag');
        
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
