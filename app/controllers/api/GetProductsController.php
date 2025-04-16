<?php

class GetProductsController extends GetProducts {
    private $products;
    private $response = [];

    public function useGetProducts() {
        $sortOption = $_GET['sort'] ?? 'id_asc';
        $category = $_GET['category'] ?? null;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 10; // Number of products per page
        $offset = ($page - 1) * $limit;

        $this->products = $this->getProducts($category, $sortOption, $offset, $limit);
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