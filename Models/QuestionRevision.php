<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of QuestionRevision
 *
 * @author Gourav Sarkar
 */
class QuestionRevision
    extends AbstractQuestion
    //implements SplObserver
{
    private $question;
    //put your code here
    public function __construct(Question $question) {
        //parent::__construct();
        $this->fieldCache[]='question';
        $this->question=$question;
    }
    
    public function create()
    {
        //$query=""
        
                
        $this->setUser($this->question->getUser());
        $this->setTime($this->question->getTime());
        $this->setTitle($this->question->getTitle());
        $this->setContent($this->question->getContent());
        
        parent::create();
        //var_dump($this);
        
        //echo "total $j of $i";
         /* 
         */
        
        
    }
    public function push()
    {
        $quesTemp = newQuestion();
        $quesTemp->setID($this->question->getID());
        
        //Get Data from DB
        $this->question->setUser($owner);
        $this->question->setContent($content);
        $this->question->setTitle($title);
        parent::edit($quesTemp);
    }
    public function edit(\AbstractContent $tempObj) {
        trigger_error("Invalid operation",E_USER_ERROR);
    }

    public function delete() {
        trigger_error("Invalid operation",E_USER_ERROR);
    }
    public function read() {
        return parent::read();
    }
    public static function listing(AbstractContent $content, Pagination $pager=null) {
        $revisionStorage= new RevisionStorage();
        
        $query="SELECT
            qrev.*
            ,user.id AS userID
            ,user.nick AS userNick
            FROM 
            questionRevision AS qrev
            LEFT OUTER JOIN user AS user
            ON qrev.user=user.id
            WHERE qrev.question=?
            ";
        
        $stmt=  static::$connection->prepare($query);
        $stmt->bindValue(1,$content->getID());
        $stmt->execute();
        
        
        //echo "PICK ABOO " .$content->getID();
        //var_dump($stmt->fetchAll());
        
        
        while($data=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            $qrev=new QuestionRevision($content);
            
            $owner=new User();
            $owner->setID($data['userID']);
            $owner->setNick($data['userNick']);
            
            $qrev->setID($data['id']);
            $qrev->setContent($data['content']);
            $qrev->setTime($data['time']);
            $qrev->setID($data['id']);
            $qrev->setTitle($data['title']);
            $qrev->setUser($owner);
            
            
            //echo "<b>bold</b><br/>" . var_dump($qrev);
            $revisionStorage->attach($qrev,$qrev);
        }
        //echo "<b>bold</b>" .$revisionStorage->count();
        return $revisionStorage;
    }
    
     public function getQuestion()
    {
        return $this->question;
    }
    
    
    /*
     * Takes an object array and calculate to create aggregate object
     */
    
    public function aggregate(SplObjectStorage $objectArray)
    {
        $aggObj=new DefaultAggregateObject($this);
    }
     /* 
     */
}

?>
