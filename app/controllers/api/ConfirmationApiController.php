<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class ConfirmationApiController extends Confirmation
{
    public function deleteCartItems($cartId)
    {
        return parent::deleteCartItems($cartId);
    }
}
