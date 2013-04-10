<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Abstracts/Abstractcontent.php';
/**
 * Description of Role
 *
 * @author Gourav Sarkar
 */
class Role extends AbstractContent{
    private $title;
    protected $permission;
    
    
    public function __construct() {
        parent::__construct();
    }
    //put your code here
    public function setTitle($title)
    {
        $this->setFieldCache("title");
        $this->title=$title;
    }
    public function getTitle()
    {
        return $this->title;
    }
    
    public static function listing(\AbstractContent $reference) {
        $query="SELECT * 
                FROM roleUserMapper AS rumap 
                LEFT OUTER JOIN permission AS perm
                ON rumap.role =perm.role
                WHERE user=?";
        
        $stmt=static::$connection->prepare($query);
        
        $stmt->execute([$reference->getID()]);
        
        var_dump($stmt->fetchAll());
        
        /*
         * 
         */
    }
}

?>
