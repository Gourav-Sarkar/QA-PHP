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
    private $stylsheet;
    
    private $mappedClass=array('utility');
    
    /*
     * Dumper location dump and debug Raw data
     */
    private $dumper;
    
    
    private $mode;
    
    public function __construct() {
        
        
        $this->transformer=new XSLTProcessor();
        
        $this->stylsheet=new DOMDocument();
        $this->stylsheet->load('templates/ProjectBaseTemplate.xsl');
        
        /*
         * Load utility functions
         */
        $this->loadUtilityModule();
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
        
        /*
        $b=$transformer->hasExsltSupport();
        var_dump($b);
        */
        
        $this->transformer->importStylesheet($this->stylsheet);
        echo $this->transformer->transformToXml($this->model);
        
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
    
    
    /*
     * @incomplete
     */
    private function loadUtilityModule()
    {
        $methods=array();
        
        assert('$this->transformer instanceof XSLTProcessor');
        
        foreach($this->mappedClass as $class)
        {
            
            //Assume all methods are static
            $staticMethods=  get_class_methods($class);
            foreach($staticMethods as $method)
            {
                $methods[]="$class::$method";
            }
            
        }
        
        //var_dump($methods);
        $this->transformer->registerPHPFunctions();
        
    }
    
}

?>
