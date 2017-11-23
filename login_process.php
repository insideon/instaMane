<?php
session_start();
require 'Database.php';
require 'models/User.php';

    $database = new Database();
    $user = new User($database->connect);

    // 필터링
    $email = filter_input(INPUT_POST, 'email', FILTER_DEFAULT);
    $password = filter_input(INPUT_POST, 'password', FILTER_DEFAULT);

    // 로그인 검증
    if (!empty($email) && !empty($password)) {
        $loginChk = $user->loginChk($email);

        if ($email == $loginChk['email'] && password_verify($password, $loginChk['password'])) {
            $_SESSION['is_login'] = true;
            $_SESSION['id'] = $loginChk['id'];
            $_SESSION['nickname'] = $loginChk['nickname'];
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
