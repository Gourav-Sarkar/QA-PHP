<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'models/DefaultFile.php';
/**
 * Description of DownloadContentController
 *
 * @author Gourav Sarkar
 */
class FileController {
    //put your code here
    private $model;
    
    public function __construct() {
        echo get_current_user();
        var_dump($_FILES,$_POST);
        $this->model=new DefaultFile($_FILES['movie']['tmp_name']);
    }


    /*
     * Get IMDB API data and show it in page
     * @Fetch object should b object or different trait
     */
    public function fetch()
    {
        $this->model->setTitle($_POST['title']);
        $dlcList=$this->model->fetch();
        echo $dlcList->render(new Template('movie-list'));
    }
    
    /*
     * Get IMDB ID and fetch data and get user uploaded file
     * store data to databse and file location to database and 
     * downloadble content to filesystem
     */
    public function upload()
    {
        echo __METHOD__;
        $this->model->upload();
    }
}

?>
