<?php

class GetProductsController extends GetProducts
{
    private $products;
    private $response = [];

    public function useGetProducts()
    {
        $sortOption = $_GET['sort'] ?? 'id_asc';
        $category = $_GET['category'] ?? null;
        $searchTerm = $_GET['q'] ?? null;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        if ($searchTerm) {
            $allResults = $this->searchProducts($searchTerm);
            $total = count($allResults);
            $this->products = array_slice($allResults, $offset, $limit);
        } else {
            $this->products = $this->getProducts($category, $sortOption, $offset, $limit);
            $total = $this->totalProducts($category, null);
        }

        if (empty($this->products)) {
            $this->response['status'] = 'error';
            $this->response['message'] = 'No products found';
            return;
        }

        $this->response['status'] = 'success';
        $this->response['data'] = $this->products;
        $this->response['pagination'] = [
            'currentPage' => $page,
            'totalPages' => ceil($total / $limit),
            'total' => $total,
            'perPage' => $limit
        ];
        return $this->response;
    }
    public function useSearchProducts()
    {
        $q = $_GET['q'] ?? null;
        $sortOption = $_GET['sort'] ?? 'id_asc';
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        if ($q) {
            $this->products = $this->searchProducts($q, $offset, $limit, $sortOption);

            if (empty($this->products)) {
                $this->response['status'] = 'error';
                $this->response['message'] = 'No products found';
                return $this->response;
            }
            $total = $this->totalSearchProducts($q);
            $totalPages = ceil($total / $limit);

            $this->response['status'] = 'success';
            $this->response['data'] = $this->products;
            $this->response['pagination'] = [
                'currentPage' => $page,
                'totalPages' => $totalPages,
                'totalItems' => $total,
                'limit' => $limit
            ];
            return $this->response;
        }
        return null;
    }
}
