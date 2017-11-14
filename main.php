<?php
require 'models/Main.php';
require __DIR__ . '/vendor/autoload.php';

    $dotenv = new Dotenv\Dotenv(__DIR__);
    $dotenv->load();

    try {
        $connect = new PDO(getenv('DB_CONNECTION').":host=".getenv('DB_HOST').";dbname=".getenv('DB_DATABASE').";charset=utf8", getenv('DB_USERNAME'), getenv('DB_PASSWORD'));
    } catch (PDOException $e) {
        die($e->getMessage());
    }

    $main = new Main($connect);
    $articles = $main->articles();

    for($i=0; $i < count($articles); $i++) {

        // 등록한 유저
        $articles[$i]['authors'] = $main->authors($articles[$i]['users_id']);

        // 업로드한 사진
        $articles[$i]['pics'] = $main->pics($articles[$i]['users_id']);

        // 좋아요 갯수
        $articles[$i]['likesCnt'] = $main->likeCnt($articles[$i]['id']);

        // 좋아요 누른 유저 (아직 사용하지 않음)
        $articles[$i]['like_users'] = $main->likeUsers($articles[$i]['id']);

        // 코멘트
        $articles[$i]['comments'] = $main->comments($articles[$i]['id']);
    }

require 'views/main.php';
?>
