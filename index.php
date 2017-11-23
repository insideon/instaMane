<?php
session_start();
if(isset($_SESSION['is_login'])){
    header('Location: main.php');
    exit;
}

require 'views/index.php';
?>
