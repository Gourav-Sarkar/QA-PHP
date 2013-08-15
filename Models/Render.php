<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Interfaces/RenderbleInterface.php';

/**
 * Description of Render
 * @todo multiple model setting on single view
 * @author Gourav Sarkar
 */
class Render {
    //put your code here

    const MODE_FRAGMENT = 'FRAGMENT';
    const MODE_DOCUMENT = 'DOCUMENT';

    private $model;
    private $transformer;
    private $baseTemplate;
    private $stylsheet;
    private $mappedClass = array('utility');

    const STATIC_PAGE_IDENTIFIER = "static";

    /*
     * Dumper location dump and debug Raw data
     */

    private $dumper;
    private $mode;

    public function __construct() {


        $this->transformer = new XSLTProcessor();

        $this->stylsheet = new DOMDocument();
        $this->stylsheet->load('templates/ProjectBaseTemplate.xsl');
        $this->mode=static::MODE_DOCUMENT;

        /*
         * Load utility functions
         */
        $this->loadUtilityModule();
    }

    /*
     * @PARAM $mode RENDER::MODE_* constant 
     * 
     */

    public function setMode($mode) {
        $this->mode = $mode;
    }

    public function setModel($modelData) {
        $this->model = new DOMDocument('1.0', 'utf-8');

        //$node=$this->model->createDocumentFragment()->appendXml($modelData);

        $page = $this->model->createElement('pageRoot');


        /*
         * It is document fragment or whole document
         */
        $fragMode = $this->model->createAttribute("mode");
        $fragMode->value = $this->mode;
        $page->appendChild($fragMode);


        /* IMPORTANT NOTE
         * If document is not xml based and just a static page
         * static should be a signle page consist of fragment document in xsl
         * stylesheet. 
         * This can be moved into Controller part. More appropiately AbstractController
         * HArd code of GET variable should be inside controller part for better management
         */
        if (!empty($_GET[static::STATIC_PAGE_IDENTIFIER])) {
            $staticAttr = $this->model->createAttribute("static");
            $staticAttr->value = $_GET[static::STATIC_PAGE_IDENTIFIER];
            $page->appendChild($staticAttr);
        }

        $this->model->appendChild($page);

        /*
         * Object based root element
         */
        //$objRoot=$this->model->createElement((String))

        
        /*
         * Append if there is model data
         */
       $this->addSubModel($modelData);
    }
    
    /*
     * @todo should add attribute 'name' to distinguish same type of objects AKA same node name
     */
    public function addSubModel($modelData,$name=null)
    {
        $page=$this->model->documentElement;
        assert('$page instanceof DOMElement');
        
        if (!empty($modelData)) {
            $fragment = $this->model->createDocumentFragment();
            
            /*
             * If there is name for model append the it as attribute
             * It will help to distinguish different node which have same node name
             */
            if(!empty($name))
            {
                $nameAttr=$fragment->createAttribute("name");
                $nameAttr->value=$name;
                
                $fragment->appendChild($nameAttr);
            }
            
            $fragment->appendXML($modelData);

            $page->appendChild($fragment);
        }
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
       $this->setDumper('dump.xml');
        $this->dump($this->model->saveXMl());
    }

    /*
     * @todo ensure correct file location
     */

    public function setDumper($file) {
        $this->dumper = $file;
    }

    public function getDumper() {
        return $this->dumper;
    }

    private function dump($data) {
        if (!is_null($this->dumper)) {
            file_put_contents($this->dumper, $data);
        }
    }

    /*
     * @incomplete
     */

    private function loadUtilityModule() {
        $methods = array();

        assert('$this->transformer instanceof XSLTProcessor');

        foreach ($this->mappedClass as $class) {

            //Assume all methods are static
            $staticMethods = get_class_methods($class);
            foreach ($staticMethods as $method) {
                $methods[] = "$class::$method";
            }
        }

        //var_dump($methods);
        $this->transformer->registerPHPFunctions();
    }

}

?>
