<?php
/**
*
*/
class MainModel
{

    protected $connect;

    public function __construct($connect)
    {
        $this->connect = $connect;
    }

    public function articles() {
        $stmt = $this->connect->prepare('SELECT * FROM articles');
        $stmt->execute();
        $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $articles;
    }

    public function authors() {
        $stmt = $this->connect->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        // $id = $articles[$i]['users_id'];
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
