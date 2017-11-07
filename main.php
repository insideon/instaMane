<?php
require 'connect.php';
require 'models/Main.php';

    try {
        $connect = new PDO('mysql:host=localhost;dbname=instaMane;charset=utf8', $id, $pwd);
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
