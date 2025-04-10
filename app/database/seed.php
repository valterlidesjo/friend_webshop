<?php
require_once __DIR__ . '\dbh.classes.php';
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

        $this->seedUnderCategories();
        $this->seedCategories();
        $this->seedProducts();
    }

    private function seedUnderCategories()
    {
        $pdo = $this->connect();

        $underCategories = ['Skyfish', 'Gray', 'Greenman', 'Parrot', 'Eagle', 'Vulture', 'Brownbear', 'Polarbear', 'Grizzlybear'];

        foreach ($underCategories as $underCategory) {
            $stmt = $pdo->prepare("INSERT INTO under_categories (name) VALUES (?)");
            $stmt->execute([$underCategory]);
        }

        echo "Seeded under categories!";
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
        $imageCategory = ['Alien', 'Bird', 'Bear'];

        $pdo = $this->connect();

        for ($i = 1; $i <= 100; $i++) {
            $name = "Friend $i";
            $description = "This is Friend $i, a great companion!";
            $price = rand(10, 500);
            $stock = rand(1, 20);
            $category_id = rand(1, 3);
            $imageNumber = rand(1, 3);
            $image_url = "/src/assets/" . $imageCategory[$category_id - 1] . $imageNumber . ".jpg";
            $popularity = rand(0, 100);

            $stmt = $pdo->prepare("INSERT INTO products (name, description, price, image_url, stock, category_id, popularity)
                                   VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$name, $description, $price, $image_url, $stock, $category_id, $popularity]);
        }

        echo "Seeded 100 products!";
    }
}
