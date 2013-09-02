<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'abstracts/abstractController.php';
/**
 * Description of AdminPanelController
 *
 * @author Gourav Sarkar
 */
class AdminPanelController extends AbstractController{
    //put your code here
    
    public function show()
    {
        parent::__construct();
        $this->view->addTemplate("adminPanel");
        
        $this->view->setModel(SettingHandler::initSettingHandler()->getRawSetting());
        
        echo $this->view->render();
    }
}

?>
