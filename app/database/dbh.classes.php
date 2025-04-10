<?php 

class Dbh {
    protected function connect() {
        try {
            $username = "root";
            $password = "root";
            $dbh = new PDO('mysql:host=localhost;dbname=friend_webbshop', $username, $password);
            return $dbh;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            die();
        }
    }
}