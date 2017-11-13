<?php
session_start();
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
// print_r($email);exit;
if(!$email) {
    // echo "here";exit;
    $_SESSION['errorMessage'] = '이메일이 입력되지 않았거나, 유효한 이메일이 아닙니다.';
    header('location: index2.php');
}
?>
