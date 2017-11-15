<?php
session_start();
require 'models/Profile.php';
require __DIR__ . '/vendor/autoload.php';

    $dotenv = new Dotenv\Dotenv(__DIR__);
    $dotenv->load();

    try {
        $connect = new PDO(getenv('DB_CONNECTION').":host=".getenv('DB_HOST').";dbname=".getenv('DB_DATABASE').";charset=utf8", getenv('DB_USERNAME'), getenv('DB_PASSWORD'));
    } catch (PDOException $e) {
        die($e->getMessage());
    }

    $nickname = $_GET['nickname'];
    $profile = new Profile($connect);
    $author = $profile->author($nickname);
    $article = $profile->article($nickname);

require 'views/profile.php';
?>
