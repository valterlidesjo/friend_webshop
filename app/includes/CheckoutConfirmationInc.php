<?php

require_once '../../vendor/autoload.php';
require_once '../database/dbh.classes.php';
require_once '../models/Confirmation.php';
require_once '../controllers/api/ConfirmationApiController.php';
require_once '../models/Checkout.php';
require_once '../controllers/api/CheckoutApiController.php';

session_start();
$userId = $_SESSION['userid'];
$cartId = $_SESSION['cartid'] ?? '6969420';
$email = $_SESSION['email'] ?? 'default@email.com';
$cartTotal = $_SESSION['carttotal'] ?? 0;
$_SESSION['checkouttotal'] = $cartTotal;

if (isset($_POST["submit"])) {

    $confirmation = new ConfirmationApiController();
    $checkout = new CheckoutApiController($userId);
    $cartItems = $checkout->getCartItems($cartId);
    var_dump($cartItems);
    $productExists = false;
    \Stripe\Stripe::setApiKey($_ENV['STRIPE_SECRET']);
    $lineitems = [];
    foreach ($cartItems as $item) {
        array_push($lineitems, [
        "quantity" => $item["quantity"],
        "price_data" => [
            "currency" => "sek",
            "unit_amount" => $item["product_price"]*100,
            "product_data" => [
                "name" => $item["product_name"]
            ]
        ]
    ]);
    }
        $checkout_session = \Stripe\Checkout\Session::create([
    "mode" => "payment",
    "success_url" => "http://localhost/dashboard/webbshop-uppgift/confirmation",
    "cancel_url" => "http://localhost/dashboard/webbshop-uppgift",
    "locale" => "auto",
    "line_items" => $lineitems
]);


    $confirmation->deleteCartItems($cartId);
    $totalItems = $checkout->totalCartItems($cartId);
    $cartTotalCost = $checkout->totalCartCost($cartId);

    $_SESSION['totalitems'] = $totalItems;
    $_SESSION['carttotal'] = $cartTotalCost;
http_response_code(303);
header("Location: " . $checkout_session->url);


} else {
    header("location: ../../checkout?error=notCheckedOut");
}
