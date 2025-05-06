<?php

class GetProducts extends Dbh
{
    protected function getProducts($category = null, $sortOption = null, $offset = 0, $limit = 10)
    {
        $where = '';

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

        $allowedSort = [
            'name_asc' => 'products.id ASC',
            'price_asc' => 'products.price ASC',
            'price_desc' => 'products.price DESC',
        ];

        $orderBy = $allowedSort[$sortOption] ?? 'products.id ASC';
        $sql = "SELECT products.*, under_categories.name AS under_category_name FROM products JOIN under_categories ON products.under_category_id = under_categories.id $where ORDER BY $orderBy LIMIT :limit OFFSET :offset;";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    protected function searchProducts($searchTerm, $offset = 0, $limit = 0, $sortOption = null)
    {
        $allowedSort = [
            'name_asc' => 'products.id ASC',
            'price_asc' => 'products.price ASC',
            'price_desc' => 'products.price DESC',
        ];

        $orderBy = $allowedSort[$sortOption] ?? 'products.id ASC';

        $sql = "SELECT products.*, under_categories.name AS under_category_name FROM products JOIN under_categories ON products.under_category_id = under_categories.id JOIN categories ON under_categories.category_id = categories.id WHERE products.name LIKE ? OR under_categories.name LIKE ? OR categories.name LIKE ? ORDER BY $orderBy LIMIT ? OFFSET ?;";
        $stmt = $this->connect()->prepare($sql);
        $searchWildcard = '%' . $searchTerm . '%';

        $stmt->bindValue(1, $searchWildcard, PDO::PARAM_STR);
        $stmt->bindValue(2, $searchWildcard, PDO::PARAM_STR);
        $stmt->bindValue(3, $searchWildcard, PDO::PARAM_STR);
        $stmt->bindValue(4, (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(5, (int)$offset, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    protected function totalProducts($category = null, $searchTerm = null)
    {
        $where = '';
        $params = [];

        if ($category) {
            switch ($category) {
                case 'bears':
                    $where .= 'under_categories.category_id = 3';
                    break;
                case 'birds':
                    $where .= 'under_categories.category_id = 2';
                    break;
                case 'aliens':
                    $where .= 'under_categories.category_id = 1';
                    break;
            }
        }

        if ($searchTerm) {
            $searchClause = "(products.name LIKE :search OR under_categories.name LIKE :search OR categories.name LIKE :search)";
            $params[':search'] = '%' . $searchTerm . '%';

            if (!empty($where)) {
                $where .= ' AND ' . $searchClause;
            } else {
                $where .= $searchClause;
            }
        }

        $sql = "SELECT COUNT(*) FROM products 
            JOIN under_categories ON products.under_category_id = under_categories.id 
            JOIN categories ON under_categories.category_id = categories.id";

        if (!empty($where)) {
            $sql .= " WHERE " . $where;
        }

        $stmt = $this->connect()->prepare($sql);
        foreach ($params as $key => $val) {
            $stmt->bindValue($key, $val);
        }

        if (!$stmt->execute()) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        return $stmt->fetchColumn();
    }

    protected function totalSearchProducts($searchTerm)
    {
        $sql = "SELECT COUNT(*) 
            FROM products 
            JOIN under_categories ON products.under_category_id = under_categories.id 
            JOIN categories ON under_categories.category_id = categories.id 
            WHERE products.name LIKE ? OR under_categories.name LIKE ? OR categories.name LIKE ?;";

        $stmt = $this->connect()->prepare($sql);

        $searchWildcard = '%' . $searchTerm . '%';

        $stmt->execute([
            $searchWildcard,
            $searchWildcard,
            $searchWildcard
        ]);

        return $stmt->fetchColumn();
    }
}
