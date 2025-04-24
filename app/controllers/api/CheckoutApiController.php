<?php

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
    public function decreaseQuantity($cartId, $productId)
    {
        $cartItems = $this->getCartItems($cartId);

        foreach ($cartItems as $item) {
            if ($item['product_id'] == $productId) {
                if ($item['quantity'] <= 1) {
                    return 'confirmDelete';
                } else {
                    return parent::decreaseQuantity($cartId, $productId);
                }
            }
        }

        return false;
    }
    public function deleteFromCart($cartId, $productId)
    {
        return parent::deleteFromCart($cartId, $productId);
    }
}
