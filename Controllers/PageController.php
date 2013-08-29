<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Models/page.php';
require_once 'Abstracts/AbstractController.php';
/**
 * Description of PageController
 *
 * @author Gourav Sarkar
 */
class PageController extends AbstractController {
    
    public function __construct() {
        parent::__construct();
        $this->model=new Page();
        
    }
    
    public function show()
    {
        echo 'SHOW simple CMS page';
        
        $this->model->setTitle($_GET['page']);
        $this->model->read();
        
        $this->view->setModel($this->model->xmlSerialize());
        
        $this->view->addTemplate($this->model->getTitle());
        echo $this->view->render();
    }
    
    public function edit()
    {
        
    }
}

?>
