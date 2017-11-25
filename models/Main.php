<?php

class Main
{

    protected $connect;

    public function __construct($connect)
    {
        $this->connect = $connect;
    }

    public function articles()
    {
        $stmt = $this->connect->prepare('SELECT * FROM articles ORDER BY id DESC');
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function authors($id)
    {
        $stmt = $this->connect->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function pics($articles_id)
    {
        $stmt = $this->connect->prepare('SELECT * FROM pics WHERE articles_id = :articles_id');
        $stmt->bindParam(':articles_id', $articles_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function likeCnt($articles_id)
    {
        $stmt = $this->connect->prepare('SELECT count(*) cnt FROM likes WHERE articles_id = :articles_id AND up = 1');
        $stmt->bindParam(':articles_id', $articles_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    public function likeUsers($articles_id)
    {
        $stmt = $this->connect->prepare('SELECT * FROM likes JOIN users ON likes.users_id = users.id WHERE articles_id = :articles_id LIMIT 2');
        $stmt->bindParam(':articles_id', $articles_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function comments($articles_id)
    {
        $stmt = $this->connect->prepare('SELECT * FROM comments JOIN users ON comments.users_id = users.id WHERE articles_id = :articles_id');
        $stmt->bindParam(':articles_id', $articles_id, PDO::PARAM_INT);
        $stmt->execute();

        $rows = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $rows[] = $row;
        }

        return $rows;
    }

    public function addComment($articles_id)
    {
        $stmt = $this->connect->prepare('INSERT INTO comments(users_id, articles_id, content) VALUES(:users_id, :articles_id, :content)');
        $stmt->bindParam(":users_id", $users_id);
        $stmt->bindParam(":articles_id", $articles_id);
        $stmt->bindParam(":content", $content);

        $users_id = $_SESSION['id'];
        $content = $_POST['content'];

        $stmt->execute();
    }
}
