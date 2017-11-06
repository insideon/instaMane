<?php
include 'models/connect.php';
include 'models/MainModel.php';

    try {
        $connect = new PDO('mysql:host=localhost;dbname=instaMane;charset=utf8', $id, $pwd);
    } catch (PDOException $e) {
        die($e->getMessage());
    }

    $mainModel = new MainModel($connect);
    $articles = $mainModel->articles();

    for($i=0; $i < count($articles); $i++) {

        // 등록한 유저
        $articles[$i]['authors'] = $mainModel->authors($articles[$i]['users_id']);

        // 업로드한 사진
        $articles[$i]['pics'] = $mainModel->pics($articles[$i]['users_id']);

        // 좋아요 갯수
        $articles[$i]['likesCnt'] = $mainModel->likeCnt($articles[$i]['id']);

        // 좋아요 누른 유저 (아직 사용하지 않음)
        $articles[$i]['like_users'] = $mainModel->likeUsers($articles[$i]['id']);

        // 코멘트 내용
        $articles[$i]['comments'] = $mainModel->comments($articles[$i]['id']);
    }

include 'views/main.php';
?>
