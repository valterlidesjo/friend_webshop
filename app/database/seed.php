<?php
require_once('app/database/dbh.classes.php');
require_once('app/models/GetCategories.php');
require_once('app/controllers/api/GetCategoriesController.php');

class Seed extends Dbh
{

    public function runSeed()
    {

        $pdo = $this->connect();
        $stmt = $pdo->query("SELECT COUNT(*) FROM products");
        $stmt2 = $pdo->query("SELECT COUNT(*) FROM categories");
        $stmt3 = $pdo->query("SELECT COUNT(*) FROM under_categories");

        $count = $stmt->fetchColumn();
        $count2 = $stmt2->fetchColumn();
        $count3 = $stmt3->fetchColumn();

        if ($count > 0 && $count2 > 0 && $count3 > 0) {
            echo "Already seeded!";
            return;
        }

        $this->seedCategories();
        $this->seedUnderCategories();
        $this->seedProducts();
    }

    private function seedUnderCategories()
    {
        $categories = new GetCategoriesController();
        $data = $categories->useGetCategories();

        foreach ($data['data'] as $category) {
            $category_id = $category['id'];
            $category_name = $category['name'];
            if($category_name == 'Aliens'){
                $underCategories = ['Skyfish', 'Gray', 'Greenman'];
            } elseif($category_name == 'Birds'){
                $underCategories = ['Parrot', 'Eagle', 'Vulture'];
            } elseif($category_name == 'Bears'){
                $underCategories = ['Brownbear', 'Polarbear', 'Grizzlybear'];
            }
            foreach ($underCategories as $sub) {
                $pdo = $this->connect();
                $stmt = $pdo->prepare("INSERT INTO under_categories (name, category_id) VALUES (?, ?)");
                $stmt->execute([$sub, $category_id]);
            }
        }

    }

    private function seedCategories()
    {
        $pdo = $this->connect();

        $categories = ['Aliens', 'Birds', 'Bears'];

        foreach ($categories as $category) {
            $stmt = $pdo->prepare("INSERT INTO categories (name) VALUES (?)");
            $stmt->execute([$category]);
        }

        echo "Seeded categories!";
    }

    private function seedProducts()
    {

        $pdo = $this->connect();

        for ($i = 1; $i <= 100; $i++) {
            $name = "Friend $i";
            $description = "This is Friend $i, a great companion!";
            $price = rand(10, 500);
            $stock = rand(1, 20);
            $under_category_id = rand(1, 9);
            if ($under_category_id >= 1 && $under_category_id <= 3) {
                $imageCategory = "Alien";
            } elseif ($under_category_id >= 4 && $under_category_id <= 6) {
                $imageCategory = "Bird";
            } else {
                $imageCategory = "Bear";
            }    
            $imageNumber = rand(1, 3);
            $image_url = "/src/assets/" . $imageCategory . $imageNumber . ".jpg";        
            $popularity = rand(0, 100);

            $stmt = $pdo->prepare("INSERT INTO products (name, description, price, image_url, stock, under_category_id, popularity)
                                   VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$name, $description, $price, $image_url, $stock, $under_category_id, $popularity]);
        }

        echo "Seeded 100 products!";
    }
}
