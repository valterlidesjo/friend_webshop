<?php

class GetPopularProductsController extends GetPopularProducts {
    private $products;
    private $response = [];

    public function useGetPopularProducts() {
        $this->products = $this->getPopularProducts();
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