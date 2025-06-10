<?php
require_once(__DIR__ . '/../../vendor/autoload.php');
use Dotenv\Dotenv;

class Dbh
{

    private $dbusername;
    private $dbpassword;
    private $dbhost;
    private $dbname;

    public function __construct()
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../..');
        $dotenv->load();

        $this->dbusername = $_ENV['DB_USERNAME'];
        $this->dbpassword = $_ENV['DB_PASSWORD'];
        $this->dbhost = $_ENV['DB_HOST'];
        $this->dbname = $_ENV['DB_NAME'];
    }


    protected function connect()
    {
        try {
            $username = $_ENV['DB_USERNAME'];
            $password = $_ENV['DB_PASSWORD'];
            $host = $_ENV['DB_HOST'];
            $name = $_ENV['DB_NAME'];

            
            $dbh = new PDO("mysql:host=$host;dbname=$name", $username, $password);

            return $dbh;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            die();
        }
    }
}
