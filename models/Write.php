<?php

class Write
{

    protected $connect;

    public function __construct($connect)
    {
        $this->connect = $connect;
    }

    public function registArticle()
    {
        $stmt = $this->connect->prepare("INSERT INTO articles(users_id, content, created) VALUES(:users_id, :content, :created)");
        $stmt->bindParam(":users_id", $users_id);
        $stmt->bindParam(":content", $content);
        $stmt->bindParam(":created", $created);

        $users_id = $_SESSION['id'];
        $content = $_POST['content'];
        $created = date("YmdHis");

        $stmt->execute();
    }

    public function getArticleId($users_id)
    {
        $stmt = $this->connect->prepare("SELECT id FROM articles WHERE users_id = :users_id ORDER BY created DESC LIMIT 1");
        $stmt->bindParam(':users_id', $users_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function registPic($articles_id, $url)
    {
        $stmt = $this->connect->prepare("INSERT INTO pics(articles_id, url) VALUES(:articles_id, :url)");
        $stmt->bindParam(":articles_id", $articles_id);
        $stmt->bindParam(":url", $url);

        $stmt->execute();
    }
}
?>
