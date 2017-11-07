<?php
// print_r($_POST);
require 'models/connect.php';
require 'models/User.php';

    try {
        $connect = new PDO('mysql:host=localhost;dbname=instaMane;charset=utf8', $id, $pwd);
    } catch (PDOException $e) {
        die($e->getMessage());
    }

    $user = new User($connect);
    $user->register();

    header('Location: /main.php');
?>
