<?php
session_start();
require_once '../database/dbh.classes.php';
require_once '../models/Checkout.php';
require_once '../controllers/api/CheckoutApiController.php';

$userId = $_SESSION['userid'];
$cartId = $_SESSION['cartid'] ?? null;
$productId = $_GET['product'] ?? null;
$action = $_GET['action'] ?? null;

if (!$userId || !$cartId || !$productId || !$action) {
    header("Location: ../../checkout?error=invalidRequest");
    exit();
}

$checkout = new CheckoutApiController($userId);

switch ($action) {
    case 'increase':
        $checkout->increaseQuantity($cartId, $productId);

        break;
    case 'decrease':
        $result = $checkout->decreaseQuantity($cartId, $productId);

        if ($result === 'confirmDelete') {
            $checkout->deleteFromCart($cartId, $productId);
        }
        break;
    case 'delete':
        $checkout->deleteFromCart($cartId, $productId);
        break;
    default:
        header("Location: ../../checkout?error=invalidAction");
        exit();
}

$_SESSION['totalitems'] = $checkout->totalCartItems($cartId);
$_SESSION['carttotal'] = $checkout->totalCartCost($cartId);

header("Location: ../../checkout?success=cartUpdated");
exit();
