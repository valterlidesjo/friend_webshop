<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class ConfirmationApiController
{
    private $getConfirmationModel;

    public function __construct()
    {
        $this->getConfirmationModel = new Confirmation();
    }
    public function deleteCartItems($cartId)
    {
        return $this->getConfirmationModel->deleteCartItems($cartId);
    }
}
