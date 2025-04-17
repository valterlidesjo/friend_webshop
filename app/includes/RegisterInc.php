<?php

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["passwordRepeat"];
    $street = $_POST["adress"];
    $city = $_POST["city"];
    $postal = $_POST["postCode"];

    include_once '../database/dbh.classes.php';
    include_once '../models/Register.php';
    include_once '../controllers/api/RegisterController.php';

    $register = new RegisterController($name, $email, $password, $passwordRepeat, $street, $postal, $city);

    try {
        $register->useRegisterUser();
        header("location: ../../login?success=registered");
    } catch (Exception $e) {
        header("location: ../../?error=" . $e->getMessage());
    }
} else {
    header("location: ../../?error=notRegistered");
}
