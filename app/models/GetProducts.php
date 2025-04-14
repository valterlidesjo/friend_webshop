<?php

class GetProducts extends Dbh
{
    protected function getProducts($category = null, $sortOption = null)
    {
        $where = '';
        $orderBy = 'products.id ASC';

        if ($category) {
            switch ($category) {
                case 'bears':
                    $where = 'WHERE under_categories.category_id = 3';
                    break;
                case 'birds':
                    $where = 'WHERE under_categories.category_id = 2';
                    break;
                case 'aliens':
                    $where = 'WHERE under_categories.category_id = 1';
                    break;
            }
        }

        if ($sortOption) {
            switch ($sortOption) {
                case 'name_asc':
                    $orderBy = 'products.id ASC';
                    break;
                case 'price_asc':
                    $orderBy = 'products.price ASC';
                    break;
                case 'price_desc':
                    $orderBy = 'products.price DESC';
                    break;
                default:
                    $orderBy = 'RAND()';
            }
        }
        $sql = "SELECT products.*, under_categories.name AS under_category_name FROM products JOIN under_categories ON products.under_category_id = under_categories.id $where ORDER BY $orderBy;";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute()) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    protected function searchProducts($searchTerm)
    {
        $sql = "SELECT products.*, under_categories.name AS under_category_name FROM products JOIN under_categories ON products.under_category_id = under_categories.id JOIN categories ON under_categories.category_id = categories.id WHERE products.name LIKE ? OR under_categories.name LIKE ? OR categories.name LIKE ?;";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([
            '%' . $searchTerm . '%',
            '%' . $searchTerm . '%',
            '%' . $searchTerm . '%'
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
