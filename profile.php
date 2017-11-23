<?php
session_start();
if (!isset($_SESSION['is_login'])) {
    header('Location: login.php');
    exit;
}

require 'Database.php';
require 'models/Profile.php';

    $database = new Database();
    $nickname = $_GET['nickname'];
    $profile = new Profile($database->connect);
    $author = $profile->author($nickname);
    $article = $profile->article($nickname);

require 'views/profile.php';
?>
