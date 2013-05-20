<stream><?php
 $questions=Question::stream();
        //var_dump($questions->count());
        
        foreach($questions as $question)
        {
            echo $question->render(new Template('question-summary'));
    
        }
?></stream>