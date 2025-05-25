<?php
session_start();
require_once("database.php");

$db = new DBConnection();
    $user = $db->getUser();
    foreach ($user as $row) {
        
    }
?>