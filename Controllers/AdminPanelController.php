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
    
    public function __construct() {
        parent::__construct();
        $this->view->addTemplate("adminPanel");
    }
    public function show()
    {
        
        $this->view->addModel(SettingHandler::initSettingHandler()->getRawSetting());
        
        echo $this->view->render();
    }
    
    /*
     * Up date each field
     */
    public function updateSetting()
    {
        SettingHandler::initSettingHandler()->update($_POST['field'],$_POST['value']);
    }
}

?>
