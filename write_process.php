<?php
session_start();
require 'Database.php';
require 'models/Write.php';

    $database = new Database();
    $write = new Write($database->connect);

    // 파일등록에 필요한 변수
    $target_dir = "images/";
    $file_rename = date("YmdHis") . $_SESSION['id'];
    $target_file = $target_dir . $file_rename . "." . basename($_FILES["fileToUpload"]["type"]);
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

    // 이미지를 등록했는지 안했는지 체크
    if(isset($_POST["yes"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check == false) {
            $_SESSION['errorMessage'] = "이미지를 등록해주세요.";
            header('Location: write.php');
            exit;
        }
    }

    // 파일 사이즈 체크
    if ($_FILES["fileToUpload"]["size"] > 5242880) {
        $_SESSION['errorMessage'] = "파일용량은 5M를 초과할 수 없습니다.";
        header('Location: write.php');
        exit;
    }

    // 허용하는 포맷인지 체크
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        $_SESSION['errorMessage'] = "JPG, JPEG, PNG, GIF 파일만 허용합니다.";
        header('Location: write.php');
        exit;
    }

    // 에러메세지가 없다면 등록
    if (!isset($_SESSION['errorMessage'])) {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $write->registArticle();
            $articles_id = $write->getArticleId($_SESSION['id']);
            $write->registPic($articles_id['id'], $target_file);
            header('Location: main.php');
        }
    }
?>
