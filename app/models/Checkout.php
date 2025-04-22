<?php

class Checkout extends Dbh
{
    protected function getShoppingCart($userId)
    {
        $sql = "SELECT * FROM shopping_carts WHERE customer_id = ?;";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($userId))) {
            $stmt = null;
            header("location: ../../?error=stmtfailed");
            exit();
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    protected function getCartItems($cartId)
    {
        $sql = "SELECT 
            cart_items.*, 
            products.name AS product_name, 
            products.price AS product_price, 
            products.image_url AS image_url,
            under_categories.name AS under_category_name
        FROM cart_items
        JOIN products ON cart_items.product_id = products.id
        JOIN under_categories ON products.under_category_id = under_categories.id
        WHERE cart_items.cart_id = ?;";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($cartId))) {
            $stmt = null;
            header("location: ../../?error=stmtfailed");
            exit();
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    protected function totalCartItems($cartId)
    {
        $sql = "SELECT SUM(quantity) FROM cart_items WHERE cart_id = ?;";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($cartId))) {
            $stmt = null;
            header("location: ../../?error=stmtfailed");
            exit();
        }
        return $stmt->fetchColumn();
    }
    protected function totalCartCost($cartId)
    {
        $sql = "SELECT SUM(ci.quantity * p.price) AS total_cost
                FROM cart_items ci
                JOIN products p ON ci.product_id = p.id
                WHERE ci.cart_id = ?;
                ";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($cartId))) {
            $stmt = null;
            header("location: ../../?error=stmtfailed");
            exit();
        }
        return $stmt->fetchColumn();
    }
    protected function createCart($userId)
    {
        $sql = "INSERT INTO shopping_carts (customer_id) VALUES (?);";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($userId))) {
            $stmt = null;
            header("location: ../../?error=stmtfailed");
            exit();
        }
        return true;
    }
    protected function addToCart($cartId, $productId)
    {
        $sql = "INSERT INTO cart_items (cart_id, product_id) VALUES (?, ?);";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($cartId, $productId))) {
            $stmt = null;
            header("location: ../../?error=stmtfailed");
            exit();
        }
        return true;
    }
    protected function increaseQuantity($cartId, $productId)
    {
        $sql = "UPDATE cart_items SET quantity = quantity + 1 WHERE cart_id = ? AND product_id = ?;";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($cartId, $productId))) {
            $stmt = null;
            header("location: ../../?error=stmtfailed");
            exit();
        }
        return true;
    }
    protected function decreaseQuantity($cartId, $productId)
    {
        $sql = "UPDATE cart_items SET quantity = quantity - 1 WHERE cart_id = ? AND product_id = ?;";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($cartId, $productId))) {
            $stmt = null;
            header("location: ../../?error=stmtfailed");
            exit();
        }
        return true;
    }
    protected function deleteFromCart($cartId, $productId)
    {
        $sql = "DELETE FROM cart_items WHERE cart_id = ? AND product_id = ?;";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute(array($cartId, $productId))) {
            $stmt = null;
            header("location: ../../?error=stmtfailed");
            exit();
        }
        return true;
    }
}
