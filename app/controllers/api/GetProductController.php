<?php

class GetProductController extends GetProduct {
    private $products;
    private $response = [];

    public function useGetProduct($id) {
        $this->products = $this->getProduct($id);
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