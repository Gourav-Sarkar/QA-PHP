<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/*
require_once 'traits/CounterTrait.php';
require_once 'traits/VoteableTrait.php';
require_once 'traits/CounterTrait.php';
*/
require_once 'Abstracts/AbstractQuestion.php';
require_once 'Pagination.php';
require_once 'Answer.php';
require_once 'QuestionComment.php';
require_once 'AnswerComment.php';
require_once 'AnswerStorage.php';
require_once 'commentStorage.php';
require_once 'RevisionStorage.php';
require_once 'QuestionRevision.php';
require_once 'tagQuestionMapper.php';
require_once 'tagStorage.php';
require_once 'QuestionStorage.php';
require_once 'interfaces/RelayInterface.php';
require_once 'QuestionCache.php';
require_once 'RelayMediator.php';
require_once 'Reputation.php';

/* 
 */


/**
 * Description of Question
 * Question is type of AbstractContent > AbstractQuestion which is CRUDEable
 * Question is indipendent and can stand alone
 * Question object is made of answer,comments,tag,revision object
 *
 * @author Gourav Sarkar
 */

class Question 
    extends AbstractQuestion
    implements SplSubject
                ,RelayInterface
                //VoteableInterface,
                //CommentableInterface,
                //AnswerableInterface,
                //ListbleInterface,
                //CachebleInterface
{
    
    /*
     * Counte Trait
     * Used to keep track of visit counter
     */
    //use CounterTrait;
    /*
     * VoteableTrait
     * Trait of voteble items. The objects which can be voted
     */
    //use VoteableTrait;
    
    
    private $answerCount=0; //Count the total answers, cache the count of total answer
    
    //SPLObjectStorage
    private $answerList;
    private $commentList; /*DATASBASE TEST */
    private $revisionList;
    private $tagList;
    
    /*
     * Reference to answer object which is selected as choosen answer
     * One Question can have only one choosen answer
     * Before making a answer object a selected it have to make sure the answer is belongs to
     *  certain question object
     * @todo One question may have multiple choosen answer
     */
    private $selectedAnswer;
     
    private $observers;
    /*
     * Pager object used to paginate question objects
     * @todo Check the usage of $pager. Most probably it is limited to Question::listing() which is static
     */
    private $pager;
    
    
    
    private $views;
    private $votes;
    
    //need verification about passing id param
    public function Question()
    {
        //call parent constructor;
        parent::__construct();
        //VoteableTrait::__construct();
        
        /*
         * Set up a object storage for answer and comment list
         */
        $this->answerList=new AnswerStorage();
        $this->commentList=new CommentStorage();
        $this->revisionList=new RevisionStorage();
        $this->tagList=new tagStorage();
        //
        $this->revisions=new QuestionStorage();
        $this->selectedAnswer=new Answer($this);
        
        $this->observers=new RelayMediator();
        
        
       
        //$this->SetfieldCache("votes");
    }
    
    
    
   
    public function setAnswerCount($count)
    {
        $this->answerCount=$count;
    }
    /*
    * 
    */
    
    
    
    
    public function getAnswerCount()
    {
        return $this->answerCount;
    }
    
    /*
     * @PARAM $tags comma seperated string 
     */
    public function setTags($tags)
    {
        
        $tagList=array();
        
        if(!empty($tags))
        {
            $tagList=explode(',' , $tags);
        }
        
        if(empty($tagList))
        {
            throw new Exception("Need at least one tag");
        }
        
        
         foreach($tagList as $tag)
        {
            $tagObj = new Tag($this); 
            $tagObj->setName($tag);
            
            $this->tagList->attach($tagObj,$tagObj);
        }
    }
    public function setPager(Pagination $pager)
    {
        $this->pager=$pager;
    }
    public function setObserver(RelayMediator $observers)
    {
        $this->observers=$observers;
    }
    
    public function getPager()
    {
        return $this->pager;
    }
    public function getTags()
    {
        return $this->tagList;
    }
    
    
    
    public function addAnswer(Answer $answer)
    {
        $this->answerList->attach($answer,$answer);
        $answer->create();
    }
    
    public function addComment(AbstractComment $comment)
    {
        //echo($this->setting->get('commentEnable'));
        //Check Setting for adding comments
        if(!$this->setting->get('commentEnable'))
        {
            //Debug purpose
            //trigger_error('Comenting closed by admin');
            throw new PermissionDeniedException("Commenting is closed by admin");
        }
        //Add comments to current question
        $this->commentList->attach($comment,$comment);
        
        //Create Comment
        $comment->create();
        
        $comment->getQuestion()->read();
        
        /*
         * Set meessage for relaying message to observers
         */
        //$this->observers->setMessage(__FUNCTION__);
        /*
         * $this->observers->notify();
        */
    }
    
    
    public function editAnswer(\AnswerableInterface $answer) {
        ;
    }
    
    /*
     * @Deprecated in favor of objectstorage
     */
    public function getAnswers()
    {
        //Need verification
        //$this->answerList=Answer::getList($this);
        return $this->answerList;
    }
   
    public function getComments()
    {
        return $this->commentList;
    }
    public function getRevisions()
    {
        return $this->revisionList;
    }
    
    public function create()
    {
        
        parent::create();
        
        $tagMap=new TagQuestionMapper($this);
        $tagMap->create();
        /*
        $cache =new QuestionCache($this);
        $cache->create();
        
         * 
         */
        
        /*
        $sm= new XMLSitemap("sitemap",$this);
        $sm->create();
        
         * 
         */
        
        //publish a message
        /*
        $pubSubManager= new pubSubManager();
        $this->attach($pubSubManager);
        $this->notify("create");
         * 
         */
        
        return $this;
    }
    
    
    public function edit(\DatabaseInteractbleInterface $tempObj) {
        //Get 
        
        //Get current question
        //var_dump($tempObj);
        $currentQuestion = $tempObj->read();
        var_dump($currentQuestion);
        //var_dump($currentQuestion);
        $qrev= new QuestionRevision($currentQuestion);
        /*This will replaced with clone when create can deep copy data in database
         * Refer to CRUDLTrait::create();
         */
        $qrev->create(); //Creates revision of current question
        parent::edit($tempObj);
        
        
        //parent::edit($tempObj); //Update current question by new question
        
        
        
        //If owner of template Object is same as createor of the question
    }


    /*
     * Update Question and make a revision of it
     */
    
    public function read()
    {
        try
        {
            $cache =new QuestionCache($this);
            return $cache->read();
        }
        catch(Exception $e) //No entry found exception and no extension found exception
        {
            //echo "Cache empty";
            
            parent::read();
            $this->answerList =  Answer::listing($this);
            $this->commentList = QuestionComment::listing($this);
            $this->revisionList = QuestionRevision::listing($this);
            $this->tagList = TagQuestionMapper::listing($this);
           
            /*
             * @DEBUG Moved to observer
             */
            //$cache->create();
            
            return $this;
        }
    }
    
    /*
     *  
     */
    public static function listing(DatabaseInteractbleInterface $reference)
    {
        //$calcFoundRows='';
        $totTag=0;
        $questions = new QuestionStorage();
        
        $query="
            SELECT
            SQL_CALC_FOUND_ROWS
            q.id
            ,q.title
            ,q.time
            ,q.views
            ,q.answerCount
            ,u.id AS userID
            ,u.nick AS userNick
            ,GROUP_CONCAT(tagQuesMap.tag) AS tags
            FROM (
                    SELECT
                    MAX(tempTable.time) lastTime
                    ,tempTable.id
                    FROM
                    (
            
                        (
                        SELECT
                        A.question AS id
                        ,A.time AS time
                         FROM answer AS A
                        )
                        UNION ALL
                        (
                        SELECT
                        Q.id AS id
                        ,Q.time AS time
                        FROM question Q
                        )
                    )
                    AS tempTable
                    GROUP BY tempTable.id
                    /* ORDER BY lastTime DESC */
                )
                AS lastEntry
           LEFT OUTER JOIN question AS q
           ON lastEntry.id=q.id
           LEFT OUTER JOIN user AS u
           ON q.user=u.id
           LEFT OUTER JOIN tagQuestionMapper AS tagQuesMap
           ON q.id=tagQuesMap.question
            ";
        
        /*
         * If there is tag set in reference map it
         */
        $tags=$reference->getTags();
        if($totTag=$tags->count())
        {
          
            $tagString=implode(',' , array_fill(0,$totTag,'?'));
            
            $query .=sprintf(
                    " WHERE tagQuesMap.tag IN(%s)"
                    ,$tagString);
            
        }
        
       
        $query .=' GROUP BY q.id';
        $query .=" ORDER BY lastEntry.lastTime DESC"; 
        /*
         * If $pager is set paginate
         */
        if(!empty($reference->pager))
        {
            $query .= sprintf(" LIMIT %s,%s", $reference->pager->getOffset(), $reference->pager->getItemCount());
            
        }
        
        //@DEBUG
        //var_dump($query);
        
        $stmt=static::$connection->prepare($query);
              
        $i=1;
         foreach($tags as $tag)
         {
            $stmt->bindValue($i,$tag->getName());
            ++$i;
         }
            
            
        //var_dump($query);
        
        $stmt->execute();
        
        while($data=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            //echo "loop";
            $question= new Question();
            
            $user= new User();
            $user->setID($data['userID']);
            $user->setNick($data['userNick']);
        
            $question->setID($data['id']);
            $question->setTags($data['tags']);
            $question->setTime($data['time']);
            $question->setViews($data['views']);
            $question->setTitle($data['title']);
            $question->setAnswerCount($data['answerCount']);
            $question->setUser($user);
            
            //var_dump($question);
            
            $questions->attach($question,$question);
        }
        
         
        if(!empty($reference->pager))
        {
            $reference->pager->countTotalPage();
        }
        
        return $questions;
    }
    
    public function getLink($action)
    {
        $query=array();
        
        $queryString = parent::getLink($action);
        
        //return $queryString;
        /*
        foreach($this->tagList as $tag)
        {
            $query[]="tags[]=" . $tag->getName();
        }
        
        if(!empty($query))
        {
            $queryString .= '&amp;' . implode("&amp;" , $query);
        }
        echo $queryString . '<hr/>';
        /*
        if(!empty($this->pager))
        {
            $queryString .= http_build_query(["page"=>  $this->pager->getPage()]);
        }
        */
        return $queryString;
    }
    
    public function setSelectedAnswer($ans)
    {
        //Answer object
        /*
        $query="UPDATE question SET selectedAnswer=?";
        $stmt=  Question::$connection->prepare($query);
        $stmt->execute();
          */
        
        $this->selectedAnswer=$ans;
    }
     public function getSelectedAnswer()
    {
        //Answer object
        return $this->selectedAnswer;
    }
    
    
    /*
     *  Implemented methods of SPLSubject
     *  Update the observers
     * Intended use: Cache classes will observe and make cache when applciable
     */
    public function attach(\SplObserver $observer) {
        $this->observers->attach($observer,$observer);
    }
    
    public function detach(\SplObserver $observer) {
        $this->observers->detach($observer);
    }
    
    public function notify() {
      
        $this->observers->update($this);
    }
    public function relay($msg)
    {
        $this->observers->relay($msg);
        $this->notify();
    }
    
   /*
    * @todo Check if question has been changed or not
    * @todo one setting for stream polling time interval
    */
    
    public static function stream()
    {
        $qstore=new QuestionStorage();
        
        $query="SELECT * FROM question WHERE time BETWEEN ? AND ?";
        $stmt=DatabaseHandle::getConnection()->prepare($query);
        $stmt->execute(array(time()-10,time()));
        
        //echo $query;
        
        while($data=$stmt->fetch())
        {
            $ques=new Question();
            $ques->setID($data['id']);
            $ques->setTime($data['time']);
            $ques->setTitle($data['title']);
            $ques->setContent($data['content']);
            
            $qstore->attach($ques,$ques);
        }
        
        return $qstore;
    }
    
    
    
    public function setViews($views)
    {
        $this->views=$views;
    }
    public function setVotes($votes)
    {
        $this->votes=$votes;
    }
    
    
    public function getVotes()
    {
        return $this->votes;
    }
    
    public function getViews()
    {
        return $this->viiews;
    }
    
    
}

/**DEBUG
 * purpose
 * CRUDE test
 */
/*
$ques= new Question();
$ques->seTitle("Hello world?");
$ques->setOwner(new User());
$ques->setContent("Hello world content");
//$ques->setTime(1234567);
$ques->setConnection(DatabaseHandle::getConnection());
$ques->save();
var_dump($ques);
 * 
 */
?>
