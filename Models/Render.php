<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Interfaces/RenderbleInterface.php';
/**
 * Description of Render
 *
 * @author Gourav Sarkar
 */
class Render{
    //put your code here
    
    
    private $model;
    private $transformer;
    private $baseTemplate;
    
    /*
     * Dumper location dump and debug Raw data
     */
    private $dumper;
    
    
    private $mode;
    
    public function __construct() {
        
        $this->transformer=new DOMDocument();
        $this->transformer->load('templates/ProjectBaseTemplate.xsl');
    }
    
     public function setModel($modelData) {
        $this->model=new DOMDocument('1.0','utf-8');
        
        //$node=$this->model->createDocumentFragment()->appendXml($modelData);
        
        /*
         * Root element
         */
        $page=$this->model->createElement('page');
        $this->model->appendChild($page);
        
        /*
         * Object based root element
         */
        //$objRoot=$this->model->createElement((String))
        
        $fragment=$this->model->createDocumentFragment();
        $fragment->appendXML($modelData);
                
        $page->appendChild($fragment);
        
     }
    /*
     * Transform
     */
    public function Render() {
        $transformer=new XSLTProcessor();
        
        /*
        $b=$transformer->hasExsltSupport();
        var_dump($b);
        */
        
        $transformer->importStylesheet($this->transformer);
        echo $transformer->transformToXml($this->model);
        
        //echo $this->model->saveXML();
        
        /*
         * Debug dumper
         */
        $this->dump($this->model->saveXMl());
    }
    
    /*
     * @todo ensure correct file location
     */
    public function setDumper($file)
    {
        $this->dumper=$file;
    }
    public function getDumper()
    {
        return $this->dumper;
    }
    
    
    private function dump($data)
    {
        if(!is_null($this->dumper))
        {
            file_put_contents($this->dumper, $data);
        }
    }
    
}

?>
