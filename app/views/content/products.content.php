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
        require_once 'app/utils/SearchEngine.php';

        $q = $_GET['q'] ?? "";
        $sort = $_GET['sort'] ?? "name_asc";
        $page = $_GET['page'] ?? "1";
        $pageSize = "10";

        if (empty($sort)) {
                $sortField = 'title';
                $sortOrder = 'asc';
            } else {
                switch ($sort) {
                    case 'price_asc':
                        $sortField = 'price';
                        $sortOrder = 'asc';
                        break;
                    case 'price_desc':
                        $sortField = 'price';
                        $sortOrder = 'desc';
                        break;
                    case 'name_asc':
                        $sortField = 'title';
                        $sortOrder = 'asc';
                        break;
                    default:
                        $sortField = 'title';
                        $sortOrder = 'asc';
                        break;
                }
            }

        $searchEngine = new SearchEngine();

        $result = $searchEngine->search($q,$sortField, $sortOrder, $page, $pageSize);
        // var_dump($result);
        
       $formattedProducts = array_map(function ($hit) {
                return [
                    'id' => $hit['_source']['webid'],
                    'title' => $hit['_source']['title'],
                    'description' => $hit['_source']['description'],
                    'price' => $hit['_source']['price'],
                    'image_url' => $hit['_source']['image_url'],
                    'categoryName' => $hit['_source']['categoryName'],
                    'underCategoryName' => $hit['_source']['underCategoryName'],
                    'stockLevel' => $hit['_source']['stockLevel'],
                    'categoryid' => $hit['_source']['categoryid'],
                    'underCategoryid' => $hit['_source']['underCategoryid']
                ];
            }, $result['data']);
            // $this->response['status'] = 'success';
            // $this->response['data'] = $formattedProducts;
            // $this->response['pagination'] = [
            //     'currentPage' => $page,
            //     'totalPages' => $searchResults['num_pages'],
            //     'total' => count($searchResults['data']),
            //     'perPage' => $limit
            // ];


        if ($formattedProducts) {
            $counter = 2;
            foreach ($formattedProducts as $index => $product) {

                if ($counter % 2 === 0) {
                    echo '<div class="products-box">';
                }

                $header = $product['title'];
                $secHeader = $product['underCategoryName'];
                $price = '$' . $product['price'];
                $image = '/dashboard/webbshop-uppgift/app' . $product['image_url'];
                $id = $product['id'];

                include view('components/friendbox.php');

                if (($counter + 1) % 2 === 0 || $index === count($formattedProducts) - 1) {
                    echo '</div>';
                }

                $counter++;
            }
        } else {
            echo "<p class=''>Products not formatted correct or wrong result</p>";
        }
        ?>

    </div>
    <?php if ($formattedProducts): ?>
        <?php
        $totalPages = $result['num_pages'];
        $baseParams = $_GET;
        ?>

        <div class="pagination">
            <?php if ($page > 1): ?>
                <?php
                $baseParams['page'] = $page - 1;
                $prevQuery = http_build_query($baseParams);
                ?>
                <a href="?<?php echo $prevQuery; ?>" class="prev-btn">Prev</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <?php
                $baseParams['page'] = $i;
                $pageQuery = http_build_query($baseParams);
                $activeClass = ($i === $page) ? 'page-active' : '';
                ?>
                <a href="?<?php echo $pageQuery; ?>" class="page-btn <?php echo $activeClass; ?>"><?php echo $i; ?></a>
            <?php endfor; ?>

            <?php if ($page < $totalPages): ?>
                <?php
                $baseParams['page'] = $page + 1;
                $nextQuery = http_build_query($baseParams);
                ?>
                <a href="?<?php echo $nextQuery; ?>" class="next-btn">Next</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>


</section>