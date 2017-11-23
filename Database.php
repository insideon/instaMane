<?php
require __DIR__ . '/vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

class Database
{

    public $connect;
    public $error;

    public function __construct()
    {
        try {
            $this->connect = new PDO(getenv('DB_CONNECTION').":host=".getenv('DB_HOST').";dbname=".getenv('DB_DATABASE').";charset=utf8", getenv('DB_USERNAME'), getenv('DB_PASSWORD'));
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
        }
    }
}
?>
