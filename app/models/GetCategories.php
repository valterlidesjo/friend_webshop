<?php 
class GetCategories extends Dbh {
    protected function getCategories() {
        $sql = "SELECT * FROM categories;";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute()) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}