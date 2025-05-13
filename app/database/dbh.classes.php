<?php

class Dbh
{

    private $dbusername;
    private $dbpassword;
    private $dbhost;
    private $dbname;

    public function __construct()
    {
        $this->dbusername = $_ENV['DBUSERNAME'];
        $this->dbpassword = $_ENV['DBPASSWORD'];
        $this->dbhost = $_ENV['DBHOST'];
        $this->dbname = $_ENV['DBNAME'];
    }


    protected function connect()
    {
        try {
            $username = $this->dbusername;
            $password = $this->dbpassword;
            $host = $this->dbhost;
            $dbname = $this->dbname;
            $dbh = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

            return $dbh;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            die();
        }
    }
}
