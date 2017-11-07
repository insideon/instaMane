<?php

class User
{
    protected $connect;

    public function __construct($connect)
    {
        $this->connect = $connect;
    }

    public function register()
    {
        $stmt = $this->connect->prepare("INSERT INTO users(email, name, nickname, password) VALUES(:email, :name, :nickname, :password)");
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":nickname", $nickname);
        $stmt->bindParam(":password", $password);

        $email = $_POST['email'];
        $name = $_POST['name'];
        $nickname = $_POST['nickname'];
        $password = $_POST['password'];

        $stmt->execute();
    }
}
