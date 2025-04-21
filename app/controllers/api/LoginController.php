<?php

class LoginController extends Login
{
    private $email;
    private $password;

    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function loginUser()
    {
        if ($this->emptyInput() == false) {
            header("location: ../index.php?error=emptyinput");
            exit();
        }

        $user = $this->getUser($this->email, $this->password);

        if ($user) {
            session_start();
            $_SESSION["userid"] = $user["id"];
            $_SESSION["username"] = $user["name"];
            $_SESSION["email"] = $user["email"];

            $checkout = new CheckoutApiController($user["id"]);
            $cart = $checkout->useGetShoppingCart();

            if (!empty($cart)) {
                $cartId = $cart[0]["id"];
                $_SESSION["cartid"] = $cartId;

                $totalItems = $checkout->totalCartItems($cartId);
                $cartTotalCost = $checkout->totalCartCost($cartId);
                $_SESSION["carttotal"] = $cartTotalCost;
                $_SESSION["totalitems"] = $totalItems;
            } else {
                $_SESSION["cartid"] = null;
                $_SESSION["totalitems"] = 0;
                $_SESSION["carttotal"] = 0;
            }

            return true;
        } else {
            throw new Exception("Login failed");
        }
    }

    private function emptyInput()
    {
        return !empty($this->email) && !empty($this->password);
    }
}
