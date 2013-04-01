<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Template.php';
/**
 * RenderTrait has ability to render html content using Templates
 * RenderbleInterface will be implemented who have ability to render but it may
 * or may not have capability to render itself. Who have capability to render itslef will
 * use RenderbleTrait
 * @author Gourav Sarkar
 */
trait RenderbleTrait{
    //put your code here
    public function render(Template $template)
    {    
        //xdebug_print_function_stack( 'Your own message' );
        
        
        $output='';
        /*It is possible to catch exception for unavilablity of property or object itself
         * In that case we can discard the result;
         * If tries to get property of non object discard rendering
         */
        $pathPieces=[Template::TEMPLATE_ROOT_PATH,$this,$template->getTemplate()];
        ob_start();
        require implode('/', $pathPieces); //require_once also working. STRANGE!
        $output=ob_get_clean();
        //var_dump($output);
        return $output;
    }
    
    public function getLink($action)
    {
        //echo "booooooo" . get_class($this);
        
        $link=["module"=>  get_class($this)
                                       ,  strtolower(get_class($this))=>$this->getID()
                                       ,"action"=>"$action"
                                        ];
        
       /*
        * Reference property tell it is a dependent class
        * [TODO] MORE ELEGANT It is also possible to check DependebleTrait to ensure it is dependeble class
        * If a class is dependeble, dependent class id should be passed into link
        */
        if(isset($this->reference))
        {
            
            //var_dump($this->dependency);
            
            $deps=[get_class($this->reference) => $this->getReference()->getID()];
            
            $link=array_merge($link,$deps);
        }
        //var_dump($this->dependency);
        //var_dump($link);
        
        return sprintf("/stackoverflow/index.php?%s"
                    ,http_build_query($link,null,"&amp;")
                    );
          
         
    }
}

?>
