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
        $stmt = $connect->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $id = $articles[$i]['users_id'];
        $stmt->execute();
        $articles[$i]['users'] = $stmt->fetch(PDO::FETCH_ASSOC);

        // 업로드한 사진
        $stmt = $connect->prepare('SELECT * FROM pics WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $id = $articles[$i]['id'];
        $stmt->execute();
        $articles[$i]['pics'] = $stmt->fetch(PDO::FETCH_ASSOC);

        // 좋아요 갯수
        $stmt = $connect->prepare('SELECT count(*) cnt FROM likes WHERE articles_id = :articles_id');
        $stmt->bindParam(':articles_id', $articles_id, PDO::PARAM_INT);
        $articles_id = $articles[$i]['id'];
        $stmt->execute();
        $articles[$i]['likesCnt'] = $stmt->fetchColumn();

        $stmt = $connect->prepare('SELECT * FROM likes JOIN users ON likes.users_id = users.id WHERE articles_id = :articles_id LIMIT 2');
        $stmt->bindParam(':articles_id', $articles_id, PDO::PARAM_INT);
        $articles_id = $articles[$i]['id'];
        $stmt->execute();
        $articles[$i]['like_users'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // 코멘트 내용
        $stmt = $connect->prepare('SELECT * FROM comments JOIN users ON comments.users_id = users.id WHERE articles_id = :articles_id');
        $stmt->bindParam(':articles_id', $articles_id, PDO::PARAM_INT);
        $articles_id = $articles[$i]['id'];
        $stmt->execute();

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $articles[$i]['comments'][] = $row;
        }
    }

include 'views/main.php';
?>
