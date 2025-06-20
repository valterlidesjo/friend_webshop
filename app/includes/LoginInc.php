<?php



if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    require_once '../database/dbh.classes.php';
    require_once '../models/Login.php';
    require_once '../models/Checkout.php';
    require_once '../controllers/api/CheckoutApiController.php';
    require_once '../controllers/api/LoginController.php';

    $login = new LoginController($email, $password);

    try {
        $login->loginUser();

        header("location: ../../products?success=loggedIn");
    } catch (Exception $e) {
        header("location: ../../login?error=LoginFailed");
    }
}
