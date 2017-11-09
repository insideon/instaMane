<?php
require 'connect.php';
require 'models/User.php';

    try {
        $connect = new PDO('mysql:host=localhost;dbname=instaMane;charset=utf8', $id, $pwd);
    } catch (PDOException $e) {
        die($e->getMessage());
    }

    $user = new User($connect);

    // 필터링
    $email = filter_input(INPUT_POST, 'email', FILTER_DEFAULT);
    $name = filter_input(INPUT_POST, 'name', FILTER_DEFAULT);
    $nickname = filter_input(INPUT_POST, 'nickname', FILTER_DEFAULT);
    $password = filter_input(INPUT_POST, 'password', FILTER_DEFAULT);

    // 제대로 입렵된 폼의 개수를 체크하기위한 변수
    $formCount = 0;

    // email
    if (empty($email)) {
        echo "이메일을 입력하지 않았습니다."."<br>";
    } else  {
        $emailDupChk = $user->emailDupChk($email);

        if ($emailDupChk) {
            echo "이미 존재하는 이메일입니다."."<br>";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "이메일 형식에 맞지 않습니다."."<br>";
        } else $formCount++;
    }

    // name
    if (empty($name)) {
        echo "이름을 입력하지 않았습니다."."<br>";
    } else if ((strlen($name) > 4) || (strlen($name) < 2)) {
        echo "이름 2~4자만 허용합니다."."<br>";
    } else $formCount++;

    // nickname
    if (empty($nickname)) {
        echo "닉네임을 입력하지 않았습니다."."<br>";
    } else {
        $nicknameDupChk = $user->nicknameDupChk($nickname);

        if ($nicknameDupChk) {
            echo "이미 존재하는 닉네임입니다."."<br>";
        } else if ((strlen($nickname) > 8) || (strlen($nickname) < 2)) {
            echo "닉네임 2~8자만 허용합니다."."<br>";
        } else $formCount++;
    }

    // password
    if (empty($password)) {
        echo "패스워드를 입력하지 않았습니다.."."<br>";
    } else if ((strlen($password) > 16) || (strlen($password) < 8)) {
        echo "비밀번호 8~16자만 허용합니다."."<br>";
    } else $formCount++;

    // 모두 정확히 입력되었는지 확인 후 등록
    if ($formCount==4) {
        $user->register();
        header('Location: /main.php');
    }

?>
