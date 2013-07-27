<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 * Answer table could be set in two ways (DB constraint)
 *      One answer per question
 *      multiple answer per question
 * $answer=new Answer($question);
 * $answer->addComment(new Comment());
 */


require_once 'Abstracts/AbstractContent.php';
require_once 'Pagination.php';
require_once 'AnswerComment.php';
require_once 'AnswerStorage.php';
require_once 'commentStorage.php';
require_once 'RevisionStorage.php';
require_once 'QuestionStorage.php';
require_once 'interfaces/RenderbleInterface.php';
require_once 'DependencyObject.php';
//require_once 'traits/DependebleTrait.php';

/**
 * Description of Answer
 *
 * @author Gourav Sarkar
 */
class Answer extends AbstractContent 
//implements RenderbleInterface
//,Serializable
//implements CommentableInterface,
//ListbleInterface,
//VoteableInterface  
{

    //use \DependebleTrait;

    //put your code here
    //Object array or object storage
    private $commentList;
    private $vote;
    private $dependency;

    /* Give answer to certain question
     *  An answer does not exist unless its parent class does not exist (eg question). So there should be a question before you create
     *  an answer
     */

    public function Answer(Question $ques) {
        parent::__construct();
        
        /*
         * Create dependency on a object
         * update its fieldcache
         * @todo There should be an interface to dependency which can update field cache for
         *  parent object. See DependencyObject
         */
        $this->dependency=new DependencyObject($ques);
        $this->crud->setFieldCache((string)$ques);

        $this->commentList = new CommentStorage();
    }

    public function addComment(AbstractComment $comment) {
        //Change it to object storage for better object handling
        $this->commentList->attach($comment, $comment);
    }

    public function getComments() {
        return $this->commentList;
    }
    public function getQuestion()
    {
        return $this->dependency->getReference();
    }

    //Interface wont have id
    //Returns objectStorage
    /*
     * @todo IT now fetches comment all togeteher. It can be replaced with
     * two query
     */
    public static function listing(DatabaseInteractbleInterface $question, Pagination $pager = null) {

        $answerStorage = new AnswerStorage();
        // parent::get();

        /*
         * Get answer and their comments
         * 
         */

        $query = "SELECT 
               A.id
               ,A.content
               ,A.time
               ,AC.id AS commentID
               ,AC.content AS commentContent
               ,AC.time AS commentTime
                FROM question AS Q
                LEFT OUTER JOIN Answer AS A
                ON Q.id=A.question
                LEFT OUTER JOIN AnswerComment AS AC
                ON A.id=AC.answer
                WHERE A.question=?";

        /*
         */
        //Debug test
        //$query="SELECT * FROM answer";

        $stmt =  DatabaseHandle::getConnection()->prepare($query);
        $stmt->bindValue(1, $question->getid());
        $stmt->execute();

        //var_dump($stmt->fetchAll(PDO::FETCH_ASSOC));
        //$i=$j=0;

        while ($data = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
            //Debug
            //var_dump($data);
            //Setup answer

            $answer = new Answer($question);
            $answer->setID($data['id']);
            $answer->setContent($data['content']);
            //$answer->setContent($data['time']);
            //get comments

            $comments = new AnswerComment($answer);
            $comments->setID($data['commentID']);
            $comments->setContent($data['commentContent']);
            $comments->setTime($data['commentTime']);

            //$meta=$stmt->getColumnMeta(2);
            //var_dump($meta);
            //echo ++$i . 'entries<br/>';

            /*
             * If answer is previously fetched dont initialize another answer
             * instead take the rest of properties/objects and assign it to previously
             * Initialized answer
             */
            if (!$answerStorage->offsetExists($answer)) {
                //Answer is new so attacth it to storage
                $answerStorage->attach($answer, $answer);
                //debug
                //echo ++$j . 'Distinct entries <br/>';
            }

            if ($comments->getID() != NULL) {
                $answerStorage->offsetGet($answer)->addComment($comments);
            }
        }
        /*
          foreach($answerStorage as $ans)
          {
          echo "object";
          var_dump($ans);
          }
         *
         */
        return $answerStorage;
    }

    public function isSelectedAnswer() {
        return (bool) $this->reference->getSelectedAnswer()->getID() === $this->id;
    }

    /*
      public function serialize() {

      //Set reference to dependency to its id $reference->id

      xdebug_print_function_stack('Serialization stack trace for' . __METHOD__);

      $className=  get_class($this->reference);
      $newRef= new $className();
      $newRef->setID($this->reference->getID());
      unset($this->reference);

      $this->reference=$newRef;
      }

      public function unserialize($serialized) {


      //echo $serialized;
      xdebug_print_function_stack('Deserialization stack trace for' . __METHOD__);
      }

     */
}

/* TEST
 * 
 */
?>
