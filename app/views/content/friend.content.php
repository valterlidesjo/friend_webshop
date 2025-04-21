<?php
require_once 'app/database/dbh.classes.php';
require_once 'app/models/GetProduct.php';
require_once 'app/controllers/api/GetProductController.php';

session_start();

$productId = $_GET['id'];
$getProduct = new GetProductController();
$response = $getProduct->useGetProduct($productId);
$product = $response['data'];

if ($product) {
    $productDetails = $product[0];

    $name = $productDetails['name'];
    $price = $productDetails['price'];
    $category = $productDetails['category_name'];
    $race = $productDetails['under_category_name'];
    $stock = $productDetails['stock'];
    $popularity = $productDetails['popularity'];
    $image_url = $productDetails['image_url'];
} else {
    echo "Produkten kunde inte hittas.";
    header("location: /dashboard/webbshop-uppgift/index.php?error=productnotfound");
}
?>
<section class="friend-container">
    <div class="friend-page-back-button">
        <button onclick="window.history.back()">
            <i class="fa-solid fa-arrow-left"></i>
        </button>
    </div>
    <div class="friend-page-image-container">
        <img src="/dashboard/webbshop-uppgift/app<?php echo $image_url ?>" alt="Friend Image" class="friend-page-image">
    </div>
    <article class="friend-info-container">
        <div class="friend-page-name">
            <p><?php echo $name ?></p>
        </div>
        <div class="friend-page-category">
            <p>Category:</p>
            <p class="friend-page-desc"><?php echo $category ?></p>
        </div>
        <div class="friend-page-race">
            <p>Race:</p>
            <p class="friend-page-desc"><?php echo $race ?></p>
        </div>
        <div class="friend-page-stock">
            <p>Stocklevel:</p>
            <p class="friend-page-desc"><?php echo $stock ?></p>
        </div>
        <div class="friend-page-popularity">
            <p>Popularity, max 100:</p>
            <p class="friend-page-desc"><?php echo $popularity ?></p>
        </div>
        <div class="friend-page-price">
            <p>Price</p>
            <p class="friend-page-desc">$<?php echo $price ?></p>
        </div>
    </article>
    <div class="buy-button">

        <?php if (isset($_SESSION['userid']) && isset($_SESSION['username'])): ?>
            <button>
                <a href="/dashboard/webbshop-uppgift/app/includes/CheckoutInc.php?id=<?php echo $_GET['id']; ?>">Buy now</a>
            </button>
        <?php else: ?>
            <button>
                <a href="/dashboard/webbshop-uppgift/login">Login to buy</a>
            </button>
        <?php endif; ?>

    </div>
</section>