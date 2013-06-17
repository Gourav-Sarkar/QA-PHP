<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//require_once 'ListbleInterface.php';
//require_once 'RenderbleTrait.php';
require_once 'Interfaces/RenderbleInterface.php';
require_once 'Interfaces/XMLserializeble.php';
/**
 * Description of AbstractContentObjectStorage
 *
 * @author Gourav Sarkar
 */
abstract class AbstractContentObjectStorage 
extends SplObjectStorage 
implements RenderbleInterface
//,XMLSerializeble
//implements ListbleInterface
{
    //put your code here
    //use RenderbleTrait;
    
   //protected $reference;
   //protected $connection;
   
    public function getHash($object) {
        $id=$object->getID();
        //echo $id;
        //Ensure id is there
        //assert('empty($id);');
        return (string)$id;
    }
    /*
    public function setReference(AbstractContent $obj)
    {
        $this->reference=$obj;
    }
    public function setConnection(PDO $con)
    {
        $this->connection=$con;
    }
    
    abstract function getList();
    */
    /*
     * It could be implemeted into iterator too
     * Just looping the objectstorage will make the data render
     */
    public function render(Template $template)
    {
        $output='';
        //$i=0;
        
        //No entry in database
        /*
        if($this->count()<=0)
        {
            return "Default message";
        }
            */
        //echo $this->count();
        
        foreach($this as $object)
        {
            //++$i;
            //var_dump(get_Class($object));
            //var_dump($object->getName());
            $output .= $object->render($template);
            //$output .= "VOILA";
            //$output .= printr_($object,true);
            //echo $output;
        }
       //echo $i;
        return $output;
    }
    
    public function getLink($action) {
        trigger_error(__METHOD__ . "Blocked", E_USER_ERROR);
    }
    
    public function xmlSerialize() {
    }
}

?>
