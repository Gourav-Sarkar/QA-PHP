<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

//require_once 'interfaces/RednerbleInterface.php';
/**
 * Description of SettingHandler
 * Handles setting 
 * Settings are XML files
 * @author Gourav Sarkar
 */
class SettingHandler {

    //put your code here

    private static $singleInstance;
    private $settingObject;

    public static function initSettingHandler() {

        //If settingHandler is not initialized do the initialization
        if (!static::$singleInstance instanceof SettingHandler) {
            static::$singleInstance = new SettingHandler();

            static::$singleInstance->settingObject = new SimpleXMLElement(SETTING_ROOT . 'setting.xml', NULL, TRUE);
        }
        
        //new or old object Reference for object setting should be changed everytime
        
        return static::$singleInstance;
    }

    /*
     * @todo Should have throw exception in case of noNodefound error
     */

    public function get($xpath) {
        //if node not found throw exception
        //var_dump($this->module, $node);
        $settingList= $this->settingObject->xpath($xpath);
        
        //Ensure unique setting per module
        //var_dump(count($settingList));
        assert('count($settingList) == 1');

        return (string) $settingList[0];
    }

    /*
      private function isLeafNode($node)
      {
      if(isset($node['type']))
      {
      return true;
      }

      return false;

      }

      public function Render(\Template $template) {
      ;
      }
     *
     */
}

?>
