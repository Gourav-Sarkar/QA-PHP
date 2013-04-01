<?php

require_once 'DatabaseHandle.php';
require_once 'SessionDatabase.php';
session_set_save_handler(new SessionDatabase(DatabaseHandle::getConnection()),true);
session_start();
echo $_SESSION['demo'];
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
