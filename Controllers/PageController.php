<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Models/page.php';
/**
 * Description of PageController
 *
 * @author Gourav Sarkar
 */
class PageController {
    //put your code here
    private $model;
    
    public function __construct() {
        $this->model=new Page();
    }
    
    public function show()
    {
        echo 'SHOW simple CMS page';
        
        $this->model->setTitle($_GET['page']);
        echo $this->model->render(new Template('cms-page'));
    }
}

?>
