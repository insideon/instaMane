<?php
session_start();
if (!isset($_SESSION['is_login'])) {
    header('Location: login.php');
    exit;
}

require 'views/write.php';
?>
