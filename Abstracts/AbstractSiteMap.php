<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AbstractSiteMap
 *
 * @author Gourav Sarkar
 */
abstract class AbstractSiteMap
    implements CRUDLInterface
                ,  Countable
{
    
    
    const SITEMAP_SIZE_LIMIT=10485760 ; //10MB margin
    const SITEMAP_COUNT_LIMIT=50000;
    
    /* core property of each sitemap */
    protected $location;
   
    //put your code here
    protected $sitemapReference;
    protected $siteMapFile;
    protected $sitemapResource;
    
    /*
     * @TODO handle if file does not exist
     */
    public function __construct($file,RenderbleInterface $content) 
    {
        $this->sitemapReference=$content;
        $this->siteMapFile="{$file}.xml";
        
        $this->setLocation($this->sitemapReference->getLink("show"));
      
    }
    
    /*
     * @TODO validate URL so that it meets  mmeets Standard
     * @Ensure encoding to UTF-8 and escaping
     */
    public function setLocation($loc)
    {
        //echo $loc;
        $this->location=$loc;
    }
    public function getLocation()
    {
        return htmlentities($this->location,ENT_QUOTES | ENT_XML1, 'UTF-8');
    }
    
    
   

    protected function isValid()
    {
      if(stat($this->siteMapFile)['size']>=static::SITEMAP_SIZE_LIMIT)
      {
         throw new LengthException("Size of the sitemap has been overflowed");
      }
    }
    
    public function edit(DatabaseInteractbleInterface $content)
    {
        trigger_error("BLOCKED" . __METHOD__, E_USER_ERROR);
    }
    public static function listing(\DatabaseInteractbleInterface $reference) {
        
        trigger_error("BLOCKED" . __METHOD__, E_USER_ERROR);;
    }
   
    




    //abstract public function create();
}

?>
