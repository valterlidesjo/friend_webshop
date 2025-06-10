<?php

class CheckoutApiController
{
    private $userId;
    private $checkoutModel;

    public function __construct($userId)
    {
        $this->userId = $userId;
        $this->checkoutModel = new Checkout();
    }
    public function useGetShoppingCart()
    {
        return $this->checkoutModel->getShoppingCart($this->userId);
    }
    public function useCreateCart()
    {
        return $this->checkoutModel->createCart($this->userId);
    }
    public function getCartItems($cartId)
    {
        return $this->checkoutModel->getCartItems($cartId);
    }
    public function totalCartItems($cartId)
    {
        return $this->checkoutModel->totalCartItems($cartId);
    }
    public function totalCartCost($cartId)
    {
        return $this->checkoutModel->totalCartCost($cartId);
    }
    public function addToCart($cartId, $productId)
    {
        return $this->checkoutModel->addToCart($cartId, $productId);
    }
    public function increaseQuantity($cartId, $productId)
    {
        return $this->checkoutModel->increaseQuantity($cartId, $productId);
    }
    public function decreaseQuantity($cartId, $productId)
    {
        $cartItems = $this->getCartItems($cartId);

        foreach ($cartItems as $item) {
            if ($item['product_id'] == $productId) {
                if ($item['quantity'] <= 1) {
                    return 'confirmDelete';
                } else {
                    return $this->checkoutModel->decreaseQuantity($cartId, $productId);
                }
            }
        }

        return false;
    }
    public function deleteFromCart($cartId, $productId)
    {
        return $this->checkoutModel->deleteFromCart($cartId, $productId);
    }
}
