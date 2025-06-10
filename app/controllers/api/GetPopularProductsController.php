<?php

class GetPopularProductsController {
    private $products;
    private $response = [];
    private $getPopularProductsModel;
    public function __construct() {
        $this->getPopularProductsModel = new GetPopularProducts();
    }

    public function useGetPopularProducts() {
        $this->products = $this->getPopularProductsModel->getPopularProducts();
        if (empty($this->products)) {
            $this->response['status'] = 'error';
            $this->response['message'] = 'No products found';
            echo json_encode($this->response);
            return;
        }
        $this->response['status'] = 'success';
        $this->response['data'] = $this->products;
        return $this->response;    
    }
}