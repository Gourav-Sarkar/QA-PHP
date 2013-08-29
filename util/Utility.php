<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Utility
 *
 * @author Gourav Sarkar
 */
class Utility {
    //put your code here
    /*
     *@issue XSLT passes node in array
     */
    public static function timeDiff($timestamp)
    {
        //var_dump($timestamp[0]->nodeValue);
        if(is_array($timestamp))
        {
            assert('$timestamp[0] instanceof DOMNode');
            $timestamp=$timestamp[0]->nodeValue;
        }
        
        $dateString='';
        $d= new DateTime();
        
        $cd=new DateTime();
        $cd->setTimestamp($timestamp);
        
        $diff=$cd->diff($d);
        
        //var_dump($diff);
        $dates=explode(',' , $diff->format("%h,%i,%s"));
        if($dates[0]<24)
        {
        $dateString .=($dates[0])?"{$dates[0]} H ":'';
        $dateString .=($dates[1])?"{$dates[1]} M ":'';
        $dateString .=($dates[2])?"{$dates[2]} S ":'';
       
        $dateString .="ago ";
        }
        else
        {
            return $cd->format(DateTime::W3C);
        }
       return $dateString;
    }
    
    public function resolve($url)
    {
        
    }
    
    public static function bulkLoad()
    {
        $itr= new RecursiveIteratorIterator(new RecursiveDirectoryIterator('e:/wamp/www/stackoverflow'));
        
        foreach($itr as $path=>$file)
        {
            if(in_array('php' , explode('.' , $file->getFileName())))
            {
                echo $path;
                require_once $path;
            }
        }
    }
    
    
    /*
     * Link to any object
     */
    /*
    public static function getLink($objectNode,$action)
    {
        var_dump($objectNode);
        $object=$objectNode[0]->getValue;
        
        
          $query=array(
            'module'=>(string) $object
            ,'action'=>$action
            ,"$object"=>$object->getID()
          );
          
          if($object->hasDependency())
          {
              $query=array_merge($query,array((string) $object->getDependency()));
          }
          
        return sprintf("/stackoverflow/index.php?%s"
                    ,http_build_query($query,null,"&amp;")
                    );
         
    }
     * 
     */
    
    public static function formatVote($vote)
    {
        
         if(is_array($vote))
        {
            assert('$vote[0] instanceof DOMNode');
            $vote=$vote[0]->nodeValue;
            $formatVote=$vote;
        }
        
        
        $vote=number_format($vote, 1);
        
        
        return $vote;
    }
}

?>
