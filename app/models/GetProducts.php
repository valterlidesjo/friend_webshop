<?php

class GetProducts extends Dbh {
    protected function getProducts() {
        $sql = "SELECT products.*, under_categories.name AS under_category_name FROM products JOIN under_categories ON products.under_category_id = under_categories.id ORDER BY RAND();";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute()) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}