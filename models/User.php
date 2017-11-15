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
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $stmt->execute();
    }

    public function emailDupChk($email)
    {
        $stmt = $this->connect->prepare("SELECT email FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_INT);
        $stmt->execute();

        return !empty($stmt->fetch(PDO::FETCH_ASSOC));
    }

    public function nicknameDupChk($nickname)
    {
        $stmt = $this->connect->prepare("SELECT nickname FROM users WHERE nickname = :nickname");
        $stmt->bindParam(':nickname', $nickname, PDO::PARAM_INT);
        $stmt->execute();

        return !empty($stmt->fetch(PDO::FETCH_ASSOC));
    }

    public function loginChk($email)
    {
        $stmt = $this->connect->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function profileArticle($email)
    {
        $stmt = $this->connect->prepare("SELECT articles.id, pics.url FROM pics LEFT JOIN articles ON pics.articles_id = articles.id LEFT JOIN users ON articles.users_id = users.id where email = :email ORDER BY articles.id DESC");
        $stmt->bindParam(':email', $email, PDO::PARAM_INT);
        $stmt->execute();

        $rows = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $rows[] = $row;
        }

        return $rows;
    }
}
