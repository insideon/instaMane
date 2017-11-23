<?php
session_start();
require 'Database.php';
require 'models/User.php';

    $database = new Database();
    $user = new User($database->connect);

    // 필터링
    $email = filter_input(INPUT_POST, 'email', FILTER_DEFAULT);
    $name = filter_input(INPUT_POST, 'name', FILTER_DEFAULT);
    $nickname = filter_input(INPUT_POST, 'nickname', FILTER_DEFAULT);
    $password = filter_input(INPUT_POST, 'password', FILTER_DEFAULT);

    // 제대로 입렵된 폼의 개수를 체크하기위한 변수
    $formCount = 0;

    // email
    if (empty($email)) {
        $_SESSION['errorMessage'] = "이메일을 입력하지 않았습니다.";
        header('Location: index.php');
        exit;
    } else {
        $emailDupChk = $user->emailDupChk($email);

        if ($emailDupChk) {
            $_SESSION['errorMessage'] = "이미 존재하는 이메일입니다.";
            header('Location: index.php');
            exit;
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['errorMessage'] = "이메일 형식에 맞지 않습니다.";
            header('Location: index.php');
            exit;
        } else $formCount++;
    }

    // name
    if (empty($name)) {
        $_SESSION['errorMessage'] = "이름을 입력하지 않았습니다.";
        header('Location: index.php');
        exit;
    } else if (strlen($name) == 6 || strlen($name) == 9 || strlen($name) == 12) {
        $formCount++;
    } else {
        $_SESSION['errorMessage'] = "이름 2~4자만 허용합니다.";
        header('Location: index.php');
    }

    // nickname
    if (empty($nickname)) {
        $_SESSION['errorMessage'] = "닉네임을 입력하지 않았습니다.";
        header('Location: index.php');
        exit;
    } else {
        $nicknameDupChk = $user->nicknameDupChk($nickname);

        if ($nicknameDupChk) {
            $_SESSION['errorMessage'] = "이미 존재하는 닉네임입니다.";
            header('Location: index.php');
            exit;
        } else if ((strlen($nickname) > 8) || (strlen($nickname) < 2)) {
            $_SESSION['errorMessage'] = "닉네임 2~8자만 허용합니다.";
            header('Location: index.php');
            exit;
        } else $formCount++;
    }

    // password
    if (empty($password)) {
        $_SESSION['errorMessage'] = "비밀번호를 입력하지 않았습니다.";
        header('Location: index.php');
        exit;
    } else if ((strlen($password) > 16) || (strlen($password) < 8)) {
        $_SESSION['errorMessage'] = "비밀번호 8~16자만 허용합니다.";
        header('Location: index.php');
        exit;
    } else $formCount++;

    // 모두 정확히 입력되었는지 확인 후 등록
    if ($formCount==4) {
        $user->register();
        header('Location: main.php');
    }
?>
