<?php
session_start();

$userId = $_SESSION['userid'];
$productId = $_GET['id'] ?? null;

if (!$userId) {
    header("location: ../../login?error=checkoutFailed");
    exit();
}


if (!$productId) {
    header("Location: ../../products?error=noProductId");
    exit();
}

require_once '../database/dbh.classes.php';
require_once '../models/Checkout.php';
require_once '../controllers/api/CheckoutApiController.php';

try {
    $checkout = new CheckoutApiController($userId);
    $cart = $checkout->useGetShoppingCart();

    if (empty($cart)) {
        $checkout->useCreateCart();
        $cart = $checkout->useGetShoppingCart();
    }
    if ($cart) {
        $_SESSION['cartid'] = $cart[0]['id'];
    }

    $cartId = $cart[0]['id'];
    $cartItems = $checkout->getCartItems($cartId);
    $productExists = false;

    foreach ($cartItems as $item) {
        if ($item['product_id'] == $productId) {
            $productExists = true;
            break;
        }
    }


    if ($productExists) {
        $checkout->increaseQuantity($cartId, $productId);
        $totalItems = $checkout->totalCartItems($cartId);
        $cartTotalCost = $checkout->totalCartCost($cartId);

        $_SESSION['totalitems'] = $totalItems;
        $_SESSION['carttotal'] = $cartTotalCost;
        header("Location: ../../products?success=productIncreased");
    } else {
        $checkout->addToCart($cartId, $productId);
        $totalItems = $checkout->totalCartItems($cartId);
        $cartTotalCost = $checkout->totalCartCost($cartId);

        $_SESSION['totalitems'] = $totalItems;
        $_SESSION['carttotal'] = $cartTotalCost;
        header("Location: ../../products?success=productAdded");
    }

    exit();
} catch (Exception $e) {
    header("location: ../../products?error=noCart");
}
