<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'AbstractPersistantFileCache.php';
/**
 * Description of XMLFileCache
 *
 * @author Gourav Sarkar
 */
class XMLFileCache extends AbstractPersistantFileCache{
    //put your code here
    private $subject;
    
    public function update(\SplSubject $subject) {
        echo "Caching";
        $this->subject=$subject;
        $this->parse();
        
    }
    
    /*
     * @Issues Json encode does not happen in subject returns emty string
     */
    private function parse()
    {
        var_dump($this->subject);
        
        $arr=json_encode($this->subject,JSON_FORCE_OBJECT);
       
        var_dump($arr);
       
    }
    
    
}

?>
