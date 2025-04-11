<?php

class GetProductsController extends GetProducts {
    private $products;
    private $response = [];

    public function useGetProducts() {
        $this->products = $this->getProducts();
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