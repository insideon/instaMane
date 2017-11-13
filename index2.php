<?php
session_start();
// print_r($_SESSION);exit;
$errorMessage = isset($_SESSION['errorMessage']) ? $_SESSION['errorMessage'] : '';
unset($_SESSION['errorMEssage']);
?>
<html>
<h1>회원가입폼</h1>
<form action="register2.php" method="post">
    <input type="text" name="email">
    <input type="submit">
    <?php if($errorMessage): ?>
        <p><?=$errorMessage;?></p>
    <?php endif;?>
</form>
