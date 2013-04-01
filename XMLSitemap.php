<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once "AbstractSitemap.php";
/**
 * Description of XMLSitemap
 *
 * @author Gourav Sarkar
 */
class XMLSitemap extends AbstractSiteMap{
    //put your code here
    const CHANGE_FREQUENCY_ALWAYS="always";
    const CHANGE_FREQUENCY_HOURLY="hourly";
    const CHANGE_FREQUENCY_DAILY="daily";
    const CHANGE_FREQUENCY_WEEKLY="weekly";
    const CHANGE_FREQUENCY_YEARLY="yearly";
    const CHANGE_FREQUENCY_NEVER="never";
    
    protected $time;
    protected $changeFrequency=XMLSitemap::CHANGE_FREQUENCY_WEEKLY;
    protected $proiority=0;
    
    
    protected $node;
   
    
    public function __construct($file,RenderbleInterface $content) 
    {
        parent::__construct($file,$content);
        
        $this->sitemapResource=new SimpleXMLElement($this->siteMapFile,LIBXML_PARSEHUGE,true);
        $this->node= $this->sitemapResource->addChild("url");
        
        $this->isValid();
    }
        
    public function setTime($time)
    {
        asser('is_int($time);');
        $this->time=$time;
    }
    /*
     * $cfq must be one of the constant of the class
     */
    public function setChangeFrquency($cfq)
    {
        asser('is_int($time);');
        $this->changeFrequency=$cfq;
    }
    public function getTime()
    {
        $time= new DateTime($this->time);
        return $time->format(DateTime::W3C);
    }
        
    public function create()
    {
        $this->node->addChild("loc",$this->getLocation());
        $this->node->addChild("lastmod",$this->getTime());
        echo $this->sitemapResource->asXML($this->siteMapFile);
    }
    
    protected function isValid()
    {
        parent::isValid();
            
        if(count($this)>=static::SITEMAP_COUNT_LIMIT)
        {
            throw new LengthException("Total Link has been overflowed");
        }
    }
    public function count() {
        return $this->sitemapResource->count();
    }
    
    public function delete()
    {
            
    }
    public function read()
    {
            
    }
}

$q = new Question;
$q->setID(13);

/*
$sm=new SimpleXMLElement("sitemap.xml",null,true);

echo(htmlspecialchars($sm->AsXML()));
$root=$sm->addChild("url")->addchild("url2");
echo (htmlspecialchars($sm->AsXML("sitemap.xml")));
 /* *
 */
//echo file_get_contents("test.php");
//var_dump($_SERVER);
?>
