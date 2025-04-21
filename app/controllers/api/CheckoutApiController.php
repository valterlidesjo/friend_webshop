<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class CheckoutApiController extends Checkout
{
    private $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }
    public function useGetShoppingCart()
    {
        return parent::getShoppingCart($this->userId);
    }
    public function useCreateCart()
    {
        return parent::createCart($this->userId);
    }
    public function getCartItems($cartId)
    {
        return parent::getCartItems($cartId);
    }
    public function totalCartItems($cartId)
    {
        return parent::totalCartItems($cartId);
    }
    public function totalCartCost($cartId)
    {
        return parent::totalCartCost($cartId);
    }
    public function addToCart($cartId, $productId)
    {
        return parent::addToCart($cartId, $productId);
    }
    public function increaseQuantity($cartId, $productId)
    {
        return parent::increaseQuantity($cartId, $productId);
    }
}
