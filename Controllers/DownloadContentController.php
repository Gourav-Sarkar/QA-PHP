<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DownloadContentController
 *
 * @author Gourav Sarkar
 */
class DownloadContentController {
    //put your code here
    
    
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
        $this->model->upload($_FILES);
    }
}

?>
