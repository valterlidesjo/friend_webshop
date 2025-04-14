<?php
require_once 'app/database/dbh.classes.php';
require_once 'app/models/GetProduct.php';
require_once 'app/controllers/api/GetProductController.php';

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
<section class="flex flex-col items-center p-8" style="margin-top: 3rem;">
    <div class="w-full flex justify-center items-center">
        <img src="/dashboard/webbshop-uppgift/app<?php echo $image_url ?>" alt="Friend Image" class="object-contain">
    </div>
    <article class="flex flex-col items-center w-full h-auto pb-8">
        <div class="flex items-start w-full">
            <p class="font-['Jomhuria'] text-[60px] text-orange-500"><?php echo $name ?></p>
        </div>
        <div class="w-full flex justify-between items-center pb-4 font-['Geist_Mono']">
            <p>Category:</p>
            <p class="font-bold"><?php echo $category ?></p>
        </div>
        <div class="w-full flex justify-between items-center pb-4 font-['Geist_Mono']">
            <p>Race:</p>
            <p class="font-bold"><?php echo $race ?></p>
        </div>
        <div class="w-full flex justify-between items-center pb-4 font-['Geist_Mono']">
            <p>Stocklevel:</p>
            <p class="font-bold"><?php echo $stock ?></p>
        </div>
        <div class="w-full flex justify-between items-center font-['Geist_Mono']">
            <p>Popularity, max 100:</p>
            <p class="font-bold"><?php echo $popularity ?></p>
        </div>
    </article>
    <div class="w-full flex justify-center items-center">
        <button class="flex flex-col items-center justify-center w-full bg-orange-500 rounded-4xl">
            <p class="font-['Jomhuria'] text-[42px] text-white">Buy now</p>
        </button>

    </div>
</section>