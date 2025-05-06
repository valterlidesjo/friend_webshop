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


use PHPMailer\PHPMailer\PHPMailer;

if (isset($_POST["submit"])) {

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'sandbox.smtp.mailtrap.io';
    $mail->SMTPAuth = true;
    $mail->Port = 2525;
    $mail->Username = '5a8c5838b22741';
    $mail->Password = 'a2e25a19b00c7e';

    $mail->From = "info@friend.com";
    $mail->FromName = "Friend.";
    $mail->addAddress($email);
    $mail->addReplyTo("noreply@friend.com", "No-Reply");
    $mail->isHTML(true);
    $mail->Subject = "Order Confirmation - Friend.";
    $mail->Body = "<h2>Thank you for your order!</h2> <br> Your order number is <b>$cartId</b><br> <h3>The total cost for your order is $$cartTotal</h3><br>Hope you enjoy your new friend's!<br> <h3>Best regards,</h3><br> <h3>Friend.</h3>";
    $mail->send();

    $confirmation = new ConfirmationApiController($cartId);
    $checkout = new CheckoutApiController($userId);
    $confirmation->deleteCartItems($cartId);
    $totalItems = $checkout->totalCartItems($cartId);
    $cartTotalCost = $checkout->totalCartCost($cartId);

    $_SESSION['totalitems'] = $totalItems;
    $_SESSION['carttotal'] = $cartTotalCost;

    header("location: ../../confirmation?success=orderPlaced");
} else {
    header("location: ../../checkout?error=notCheckedOut");
}
