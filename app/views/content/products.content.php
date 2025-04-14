<?php
$sortOptions = [
    'name_asc' => 'Name ↑',
    'price_asc' => '<i class="fa-solid fa-arrow-down-short-wide"></i>',
    'price_desc' => '<i class="fa-solid fa-arrow-down-wide-short"></i>'
];

$currentParams = $_GET;
?>

<section class="flex flex-col items-center h-auto w-full bg-[#FFFDCF] px-8">
    <article class="flex items-center justify-between h-auto w-full" style="margin-top: 64px;">
        <div class="w-full flex flex-col justify-center items-center">
            <h1 class="text-[60px] text-orange-500 font-['Jomhuria'] w-full">FRIENDS</h1>
            <p class="text-[14px] font-['Geist_Mono']">Find a suitable friend of your liking, all happy and sustainable.</p>
            <div class="flex gap-2">
                <?php foreach ($sortOptions as $key => $label): ?>
                    <?php
                    $params = $currentParams;
                    $params['sort'] = $key;
                    $queryString = http_build_query($params);
                    ?>
                    <a href="?<?php echo $queryString; ?>"
                        class="rounded-full border-black border-2 px-4 py-1 text-xl">
                        <?php echo $label; ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="">
            <img src="/dashboard/webbshop-uppgift/app/src/assets/street.jpg" alt="Street map image">
        </div>
    </article>
    <div class="w-full flex flex-col justify-between">
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
                    echo '<div class="flex w-full justify-between pb-8">';
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
            echo "<p class='text-center text-red-500'>".$response['message']."</p>";
        }
        ?>

    </div>

</section>