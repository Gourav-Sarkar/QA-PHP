<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'models/DependencyObject.php';

/**
 * Description of AbstractController
 * @todo layout basic controller set up
 * @todo Ensure intigrity of controllers- methods are public,final,no args
 * @author Gourav Sarkar
 */
abstract class AbstractController {

    //put your code here
    protected $model;
    protected $view;
    //Boolean flag indicates if controller data is called via ajax request
    protected $isAjax = false;

    //Internationalise property. default to english

    public function __construct() {
        $lang = '';
        $this->view = new Render($lang);
        
        //var_dump($_SERVER);

        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=='AJAX') {
            $this->isAjax = TRUE;
            $this->view->setMode(Render::MODE_FRAGMENT);
        }

        if (isset($_GET['lang'])) {
            $lang = $_GET['lang'];
        }


        //var_dump($this->isAjax);
        //Common template for all module
        $this->view->addTemplate("user");
        $this->view->addTemplate("pagination");
    }

    
    public function render()
    {
        $this->view->Render();
    }
    /*
      abstract public function create();
      abstract public function delete();
      abstract public function show();
      abstract public function edit();
     * 
     */
}

?>
