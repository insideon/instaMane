<?php

class Profile
{

    protected $connect;

    public function __construct($connect)
    {
        $this->connect = $connect;
    }

    public function author($email)
    {
        $stmt = $this->connect->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function article($email)
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
?>
