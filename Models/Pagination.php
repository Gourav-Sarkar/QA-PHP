<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pagination
 *
 * @author Gourav Sarkar
 */
class Pagination {
    //put your code here
    //use RenderbleTrait;
    
    const ITEM_PER_PAGE=2;
    
    private $page;
    private $offset=0;
    private $totalPage=0;
    
    private $reference;
    
    public function __construct(AbstractContent $ref) {
        $this->reference=$ref;
        $this->reference->setPager($this);
    }
    
    public function setPage($page)
    {
        $this->page=$page;
    }

    public function getOffset()
    {
        if($this->page>1)
        {
            $this->offset=(($this->page-1) * static::ITEM_PER_PAGE);
        }
        
        return $this->offset;
    }
    public function getItemCount()
    {        
        return static::ITEM_PER_PAGE;
    }
    public function getPage()
    {
        return $this->page;
    }
    public function getTotalPage()
    {
        return $this->totalPage;
    }
    public function getReference()
    {
        return $this->reference;
    }
    public function CountTotalPage()
    {
        $stmt=DatabaseHandle::getConnection()->query("SELECT FOUND_ROWS()");
        $data=$stmt->fetch();
        $this->totalPage=$data[0] / static::ITEM_PER_PAGE;
    }
    
    public function prevPage()
    {
        if($this->page>1)
        {
            return $this->page-1;
        }
        
        return false;
    }
    
    public function nextPage()
    {
        if($this->page < $this->totalPage)
        {
            return $this->page+1;
        }
        
        return false;
    }
    
    
    public function getLink($action)
    {
        $query=array();
        $queryString=  $this->reference->getLink($action);
        
        //Check tags
        foreach($this->reference->getTags() as $tag)
        {
            $query[]="tags[]=" . $tag->getName();
        }
        
        if(!empty($query))
        {
            $queryString .= "&amp;" . implode("&amp;", $query);
        }
        return $queryString;
    }
     /* 
     */
    public function __toString() {
        return get_class($this);
    }
}

?>
