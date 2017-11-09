<?php
require 'connect.php';
require 'models/User.php';

    try {
        $connect = new PDO('mysql:host=localhost;dbname=instaMane;charset=utf8', $id, $pwd);
    } catch (PDOException $e) {
        die($e->getMessage());
    }

    $user = new User($connect);

    // 제대로 입렵된 폼의 개수를 체크하기위한 변수
    $formCount = 0;

    // email
    if (empty($_POST['email'])) {
        echo "이메일을 입력하지 않았습니다."."<br>";
    } else  {
        $emailDupChk = $user->emailDupChk($_POST['email']);

        if (!$emailDupChk) {
            echo "이미 존재하는 이메일입니다."."<br>";
        } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            echo "이메일 형식에 맞지 않습니다."."<br>";
        } else $formCount++;
    }

    // name
    if (empty($_POST['name'])) {
        echo "이름을 입력하지 않았습니다."."<br>";
    } else if ((strlen($_POST['name']) > 4) || (strlen($_POST['name']) < 2)) {
        echo "이름 2~4자만 허용합니다."."<br>";
    } else $formCount++;

    // nickname
    if (empty($_POST['nickname'])) {
        echo "닉네임을 입력하지 않았습니다."."<br>";
    } else {
        $nicknameDupChk = $user->nicknameDupChk($_POST['nickname']);

        if (!$nicknameDupChk) {
            echo "이미 존재하는 닉네임입니다."."<br>";
        } else if ((strlen(($_POST['nickname'])) > 8) || (strlen(($_POST['nickname'])) < 2)) {
            echo "닉네임 2~8자만 허용합니다."."<br>";
        } else $formCount++;
    }

    // password
    if (empty($_POST['password'])) {
        echo "패스워드를 입력하지 않았습니다.."."<br>";
    } else if ((strlen(($_POST['password'])) > 16) || (strlen(($_POST['password'])) < 8)) {
        echo "비밀번호 8~16자만 허용합니다."."<br>";
    } else $formCount++;

    echo $formCount;

    // 모두 정확히 입력되었는지 확인 후 등록
    if (filter_var(($formCount==4), FILTER_VALIDATE_BOOLEAN)) {
        $user->register();
        header('Location: /main.php');
    }

?>
