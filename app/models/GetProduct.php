<?php

class GetProduct extends Dbh {
    public function getProduct($id) {
        $sql = "SELECT products.*, under_categories.name AS under_category_name, categories.name AS category_name FROM products JOIN under_categories ON products.under_category_id = under_categories.id JOIN categories ON under_categories.category_id = categories.id WHERE products.id = :id";        
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}