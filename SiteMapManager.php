<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SiteMapManager
 *
 * @author Gourav Sarkar
 */
class SiteMapManager {
    //put your code here
    private $sitemapManager;
    private $siteMap;
    
    const FILE_NAME="sitemap/SiteMapIndex.xml";
    const SITEMAP_XML="sitemap";
    
    public function __construct() {
        /*
         * @TODO handle exception if file does not exist
         */
        $this->sitemapManager=new SimpleXMLElement(static::FILE_NAME,null,true);
    }
    
    public function update()
    {
        $sitemaps=$this->sitemapManager->sitemap;
        var_dump($sitemaps);
    }
}

$sm=new SiteMapManager();
$sm->update();
?>
