<?php
session_start();
require 'models/User.php';
require __DIR__ . '/vendor/autoload.php';

    $dotenv = new Dotenv\Dotenv(__DIR__);
    $dotenv->load();

    try {
        $connect = new PDO(getenv('DB_CONNECTION').":host=".getenv('DB_HOST').";dbname=".getenv('DB_DATABASE').";charset=utf8", getenv('DB_USERNAME'), getenv('DB_PASSWORD'));
    } catch (PDOException $e) {
        die($e->getMessage());
    }

    $user = new User($connect);

    // 필터링
    $email = filter_input(INPUT_POST, 'email', FILTER_DEFAULT);
    $password = filter_input(INPUT_POST, 'password', FILTER_DEFAULT);

    // 로그인 검증
    if (!empty($email) && !empty($password)) {
        $loginChk = $user->loginChk($email);

        if ($email == $loginChk['email'] && password_verify($password, $loginChk['password'])) {
            // 마이페이지에 사용 할 사용자 정보를 세션에 담아놓기
            $profileArticle = $user->profileArticle($email);
            $_SESSION['is_login'] = true;
            $_SESSION['nickname'] = $loginChk['nickname'];
            $_SESSION['icon'] = $loginChk['icon'];
            $_SESSION['profile_article'] = $profileArticle;
            header('Location: main.php');
            exit;
        } else if ($email != $loginChk['email']) {
            $_SESSION['errorMessage'] = "존재하지 않는 이메일 주소입니다.";
            header('Location: login.php');
            exit;
        } else {
            $_SESSION['errorMessage'] = "잘못된 비밀번호 입니다.";
            header('Location: login.php');
        }
    } else {
        $_SESSION['errorMessage'] = "이메일과 비밀번호를 다시 확인해주세요";
        header('Location: login.php');
    }
?>
