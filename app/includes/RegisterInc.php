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
    include_once '../utils/Validator.php';

    $v = new Validator($_POST);
    $register = new RegisterController($name, $email, $password, $passwordRepeat, $street, $postal, $city);

    $v->field('name')->required()->alpha([' '])->min_len(2)->max_len(50);
    $v->field('email')->required()->email()->min_len(6)->max_len(50);
    $v->field('password')->required()->alpha_num(['!@#$%&/\=*<>-_:;,."£'])->min_len(8)->max_len(30);
    $v->field('passwordRepeat')->required()->equals($password);
    $v->field('adress')->required()->alpha_num([' '])->min_len(5)->max_len(50);
    $v->field('city')->required()->alpha([' '])->min_len(2)->max_len(50);
    $v->field('postCode')->required()->numeric()->min_len(3)->max_len(10);
    if ($v->is_valid()) {
        $register->useRegisterUser();
        header("location: ../../login?success=registered");
        exit();
    } elseif (!$v->is_valid()) {
        session_start();
        $errors = [];
        foreach ($_POST as $key => $value) {
            $msg = $v->get_error_message($key);
            if ($msg !== "") {
                $errors[$key] = $msg;
            }
        }

        $_SESSION['validation_errors'] = $errors;
        $_SESSION['old_input'] = $_POST;

        header("Location: ../../register");
        exit();
    }
} else {
    header("location: ../../?error=notRegistered");
}
