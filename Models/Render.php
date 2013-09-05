<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Interfaces/RenderbleInterface.php';
require_once 'Exception/IOException.php';

/**
 * Description of Render
 * @todo multiple model setting on single view
 * @author Gourav Sarkar
 * 
 * @todo Give a interface to set page core title meta and other information
 * 
 * @todo
 * Application specific header and footer
 * Global heaeder and footer
 * Wys to dynamically add header and footer
 * 
 * Template can be used either in context based or flat
 * Context based temlate have benifit of non repeating code. Restricted template edit. rigid to common temp[late
 *      Context template can be put inside root of template folder
 * Flat template can be repeptetive. but gives frredom to manipulate template freely. lack common template
 *      Flat templates are stored in seperate directory for each project. because each template differs froma nother (project specific)
 * 
 */
class Render {
    //put your code here

    const MODE_FRAGMENT = 'FRAGMENT';
    const MODE_DOCUMENT = 'DOCUMENT';
    
    const DEBUG_STYLE_LOC='styleDump.xml';

    private $model;
    private $transformer;
    private $baseTemplate;
    private $templates; //Stores templates to be applied to model
    private $stylsheet;
    private $mappedClass = array('utility');

    const STATIC_PAGE_IDENTIFIER = "static";
    const RENDER_ROOT_NAME="pageRoot";
    const RENDER_MODE_IDENTIFIER="renderMode";

    /*
     * Dumper location dump and debug Raw data
     */

    private $dumper;
    private $mode;

    public function __construct() {


        $this->transformer = new XSLTProcessor();

        $this->stylsheet = new DOMDocument();
        $this->stylsheet->load(DOCUMENT_ROOT . 'templates/ProjectBaseTemplate.xsl');
        $this->mode = static::MODE_DOCUMENT;
        $this->templates=array();

        /*
         * Load utility functions
         */
        $this->loadUtilityModule();
        $this->initRender();
    }

    /*
     * @PARAM $mode RENDER::MODE_* constant 
     * 
     */

    public function setMode($mode) {
        $this->mode = $mode;
    }

    private function initRender() {
        $this->model = new DOMDocument('1.0', 'utf-8');

        $page = $this->model->createElement(static::RENDER_ROOT_NAME);


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
    }

    /*
     * @todo should add attribute 'name' to distinguish same type of objects AKA same node name
     * @todo add Model tag as wrapper
     */

    public function addModel($modelData, $mode = null) {
        $page = $this->model->documentElement;
        assert('$page instanceof DOMElement');

        if (!empty($modelData)) {
            $fragment = $this->model->createDocumentFragment();


            $fragment->appendXML($modelData);

            $modelNode=$page->appendChild($fragment);
            
            /*
             * If there is name for model append the it as attribute
             * It will help to distinguish different node which have same node name
             */
            if (!empty($mode)) {
                $modelNode->setAttribute('mode',$mode);
            }
        }
    }

    /*
     * Transform
     */

    public function Render() {
        
        /*
         * load additional template before applying stylsheet styling
         */
        $this->loadTemplates();

        $this->transformer->importStylesheet($this->stylsheet);
        echo $this->transformer->transformToXml($this->model);

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

    /*
     * Dumps model and stylesheet
     */

    private function dump($data) {
        /*
         * Dump models
         */
        if (!is_null($this->dumper)) {
            file_put_contents($this->dumper, $data);
        }
        
        $this->stylsheet->save(DOCUMENT_ROOT . static::DEBUG_STYLE_LOC);
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

    public function addTemplate($name,$namespace='') {
        $formatedName=$name;
        if(!empty($namespace))
        {
            $formatedName="$namespace/$name";
        }
        
        $this->templates[] = $formatedName;
    }

    
    /*
     * @todo Throws NoFileFoundException instead of NoEntryFoundException
     */
    private function loadTemplates() {
        foreach ($this->templates as $template) {
            
            $fileName=DOCUMENT_ROOT . "templates/{$template}Template.xsl";
            
            $styleAttr=$this->stylsheet->createAttribute("href");
            $styleAttr->value=$fileName;
            
            if(!(file_exists($fileName)))
            {
                Throw new IOException("Unable to load template");
            }
            
            $stylesheetNode=$this->stylsheet->createElementNS('http://www.w3.org/1999/XSL/Transform', 'xsl:include');
            $stylesheetNode->appendChild($styleAttr);
            
            $this->stylsheet->documentElement->insertBefore($stylesheetNode,$this->stylsheet->documentElement->firstChild);
        }
    }

}

?>
