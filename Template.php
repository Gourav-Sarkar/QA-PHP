<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Templae
 * EXP use
 * $question = new Question();
 * $listQues=$question->get();
 * 
 * 
 * @author Gourav Sarkar
 */
class Template {
    //put your code here
   const TEMPLATE_ROOT_PATH='Templates';
   private $template;
   private $model;
    
    /*
     * On each request anamyse the data and load appropiate templates with place holders
     */
    public function Template($template)
    {
        $this->template="{$template}-view.php";
        //$this->model=$model;
        
        /*
         * Model could be array of object or splobjectstorage
         
        if(is_array($model) || $model instanceof SplObjectStorage)
        {
            //Get the class of inside objects
            //though it could be arbitary class but It must have to one sepcfic type
        }
        */
    }
    
    
   
    
    public function getTemplate()
    {
        return $this->template;
    }
}

?>
