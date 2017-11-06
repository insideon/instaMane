<?php

class MainModel
{

    protected $connect;

    public function __construct($connect)
    {
        $this->connect = $connect;
    }

    public function articles()
    {
        $stmt = $this->connect->prepare('SELECT * FROM articles');
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

    public function pics($id)
    {
        $stmt = $this->connect->prepare('SELECT * FROM pics WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function likeCnt($articles_id)
    {
        $stmt = $this->connect->prepare('SELECT count(*) cnt FROM likes WHERE articles_id = :articles_id');
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
}
