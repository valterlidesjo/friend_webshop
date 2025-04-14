<section class="flex flex-col justify-evenly h-screen w-full px-8 pb-4">
    <div>
        <p class="font-['Jomhuria'] text-[100px] leading-[0.7] pt-16">A <span class="text-orange-500">FRIEND.</span> <br>
            MADE <br>
            FOR YOU</p>
    </div>
    <div class="flex justify-center items-center w-full">
        <img src="/dashboard/webbshop-uppgift/app/src/assets/alien1.jpg" alt="Alien holding hand" class="w-3/4">
    </div>
    <div class="w-full flex justify-center items-center">
        <button class="flex flex-col items-center justify-center w-full bg-orange-500 rounded-4xl scroll-btn">
            <p class="font-['Jomhuria'] text-[42px] text-white">Discover more</p>
        </button>

    </div>
</section>
<section class="flex flex-col items-center h-auto w-full bg-[#FFFDCF] px-8" id="more">
    <div class="w-full flex justify-center items-center">
        <p class="text-[50px] text-orange-500 font-['Jomhuria']">POPULAR FRIENDS</p>
    </div>
    <div class="w-full flex flex-col justify-between">
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
            echo "Något gick fel vid hämtning av produkter.";
        }
        ?>

    </div>

</section>
<section class="flex flex-col justify-evenly h-auto w-full px-8">
    <div>
        <p class="text-[60px] text-orange-500 font-['Jomhuria']">OUR CATEGORIES</p>
    </div>
    <div class="flex w-full justify-between items-center gap-4 pb-4">
        <a href="products?category=bears" class="flex flex-col items-center justify-center w-full bg-orange-500 rounded-4xl">
            <p class="font-['Jomhuria'] text-[42px] text-white">Bears</p>
        </a>
        <a href="products?category=birds" class="flex flex-col items-center justify-center w-full bg-orange-500 rounded-4xl">
            <p class="font-['Jomhuria'] text-[42px] text-white">Birds</p>
        </a>
    </div>
    <div class="flex w-full justify-center items-center">
        <a href="products?category=aliens" class="flex flex-col items-center justify-center w-[calc(50%-8px)] bg-orange-500 rounded-4xl">
            <p class="font-['Jomhuria'] text-[42px] text-white">Aliens</p>
        </a>
    </div>
</section>