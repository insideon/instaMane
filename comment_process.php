<?php
session_start();
require 'Database.php';
require 'models/Main.php';

    $database = new Database();
    $main = new Main($database->connect);
    $articles = $main->articles();

    // 필터링
    $content = filter_input(INPUT_POST, 'content', FILTER_DEFAULT);
    $article_id = filter_input(INPUT_POST, 'article_id', FILTER_DEFAULT);

    // 코멘트 입력
    if (!empty($content)) {
        $main->addComment($article_id);
        header('Location: main.php');
    } else {
        header('Location: main.php');
    }
?>
