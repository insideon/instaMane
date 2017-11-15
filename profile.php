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

    $email = $_SESSION['email'];
    $profile = new Profile($connect);
    $author = $profile->author($email);
    $article = $profile->article($email);

require 'views/profile.php';
?>
