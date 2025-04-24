<section class="home-start-container">
    <div class="test">
        <div class="start-text">
            <p>A <span class="friend">FRIEND.</span> <br>
                MADE <br>
                FOR YOU</p>
        </div>
        <div class="start-image">
            <img src="/dashboard/webbshop-uppgift/app/src/assets/alien1.jpg" alt="Alien holding hand">
        </div>
    </div>
    <div class="start-button">
        <button class="scroll-btn">
            <p>Discover more</p>
        </button>

    </div>
</section>
<section class="popular-container" id="more">
    <div class="popular-text">
        <p>POPULAR FRIENDS</p>
    </div>
    <div class="popular">
        <?php
        require_once 'app/database/dbh.classes.php';
        require_once 'app/models/GetPopularProducts.php';
        require_once 'app/controllers/api/GetPopularProductsController.php';

        $controller = new GetPopularProductsController();
        $response = $controller->useGetPopularProducts();

        if ($response['status'] === 'success') {
            $counter = 2;
            $products = $response['data'];
            foreach ($products as $index => $product) {

                if ($counter % 2 === 0) {
                    echo '<div class="popular-box">';
                }

                $header = $product['name'];
                $secHeader = $product['under_category_name'];
                $price = '$' . $product['price'];
                $image = '/dashboard/webbshop-uppgift/app' . $product['image_url'];
                $id = $product['id'];

                include view('components/friendbox.php');

                if (($counter + 1) % 2 === 0 || $index === count($products) - 1) {
                    echo '</div>';
                }

                $counter++;
            }
        } else {
            echo "Något gick fel vid hämtning av produkter.";
        }
        ?>

    </div>

</section>
<section class="categories-container">
    <div>
        <p class="categories-header">OUR CATEGORIES</p>
    </div>
    <div class="categories-sec-container">
        <a href="products?category=bears" class="category-btn">
            <p>Bears</p>
        </a>
        <a href="products?category=birds" class="category-btn">
            <p>Birds</p>
        </a>
    </div>
    <a href="products?category=aliens" class="category-btn">
        <p>Aliens</p>
    </a>
</section>