<?php

class GetProductsController extends GetProducts {
    private $products;
    private $response = [];

    public function useGetProducts() {
        $sortOption = $_GET['sort'] ?? 'id_asc';
        $category = $_GET['category'] ?? null;
        $this->products = $this->getProducts($category, $sortOption);
        if (empty($this->products)) {
            $this->response['status'] = 'error';
            $this->response['message'] = 'No products found';
            return;
        }
        $this->response['status'] = 'success';
        $this->response['data'] = $this->products;
        return $this->response;    
    }
    public function useSearchProducts(){
        $q = $_GET['q'] ?? null;
        if ($q) {
            $this->products = $this->searchProducts($q);
            if (empty($this->products)) {
                $this->response['status'] = 'error';
                $this->response['message'] = 'No products found';
                return $this->response;
            }
            $this->response['status'] = 'success';
            $this->response['data'] = $this->products;
            return $this->response;    
        }
        return null;
    }
}