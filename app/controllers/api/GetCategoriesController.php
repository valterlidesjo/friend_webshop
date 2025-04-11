<?php

class GetCategoriesController extends GetCategories {
    private $categories;
    private $response = [];

    public function useGetCategories() {
        $this->categories = $this->getCategories();
        if (empty($this->categories)) {
            $this->response['status'] = 'error';
            $this->response['message'] = 'No categories found';
            echo json_encode($this->response);
            return;
        }
        $this->response['status'] = 'success';
        $this->response['data'] = $this->categories;
        return $this->response;    
    }

}