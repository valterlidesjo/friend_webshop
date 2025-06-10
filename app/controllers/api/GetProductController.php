<?php

class GetProductController {
    private $products;
    private $response = [];
    private $getProductModel;
    public function __construct() {
        $this->getProductModel = new GetProduct();
    }

    public function useGetProduct($id) {
        $this->products = $this->getProductModel->getProduct($id);
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