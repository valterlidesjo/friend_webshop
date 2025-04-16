<?php
$sortOptions = [
    'name_asc' => 'abc',
    'price_asc' => '<i class="fa-solid fa-arrow-down-short-wide"></i>',
    'price_desc' => '<i class="fa-solid fa-arrow-down-wide-short"></i>'
];

$currentParams = $_GET;
?>

<section class="products-container">
    <article class="products-header-container">
        <div class="products-header">
            <h1>FRIENDS</h1>
            <p>Find a suitable friend of your liking, all happy and sustainable.</p>
            <div class="products-sorting">
                <?php foreach ($sortOptions as $key => $label): ?>
                    <?php
                    $params = $currentParams;
                    $params['sort'] = $key;
                    $queryString = http_build_query($params);
                    ?>
                    <span>
                        <a href="?<?php echo $queryString; ?>">
                            <?php echo $label; ?>
                        </a>
                    </span>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="products-map">
            <img src="/dashboard/webbshop-uppgift/app/src/assets/street.jpg" alt="Street map image">
            <p class="products-map-text">
                <span>
                    Showroom <br>
                </span>
                6969 Downtown <br>
                Houston, TX <br>
                90210
            </p>
        </div>
    </article>
    <div class="products">
        <?php
        require_once 'app/database/dbh.classes.php';
        require_once 'app/models/GetProducts.php';
        require_once 'app/controllers/api/GetProductsController.php';

        $controller = new GetProductsController();
        $response = null;

        $q = $_GET['q'] ?? null;
        if ($q) {
            $response = $controller->useSearchProducts();
        } else {
            $response = $controller->useGetProducts();
        }

        if ($response['status'] === 'success') {
            $counter = 2;
            $products = $response['data'];
            foreach ($products as $index => $product) {

                if ($counter % 2 === 0) {
                    echo '<div class="products-box">';
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
            echo "<p class=''>" . $response['message'] . "</p>";
        }
        ?>

    </div>

</section>