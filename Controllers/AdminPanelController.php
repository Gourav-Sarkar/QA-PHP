<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Models/SettingHandler.php';
/**
 * Description of AdminPanelController
 *
 * @author Gourav Sarkar
 */
class AdminPanelController {
    //put your code here
    
    public function show()
    {
        require_once "templates/admin-panel.php";
        
        

        $sh=new SettingHandler('notification');
        $sh->generateForm();
    }
}

?>
