<section class="checkout-container">
    <div class="checkout-header">
        <h1>Your Products</h1>
        <h3>By placing your order, you agree to Friend.'s <a href="https://valterlidesjo.se/">Privacy</a> and <a href="https://valterlidesjo.se/">Policy</a></h3>
    </div>

    <div class="checkout-products">
        <?php
        session_start();
        $userId = $_SESSION['userid'] ?? null;
        $cartId = $_SESSION['cartid'] ?? null;
        $email = $_SESSION['email'] ?? '';
        $cartTotal = $_SESSION['carttotal'] ?? 0;

        if (!$userId || !$cartId) {
            echo "<p>Something went wrong. Please log in again.</p>";
            exit();
        }

        require_once 'app/database/dbh.classes.php';
        require_once 'app/models/Checkout.php';
        require_once 'app/controllers/api/CheckoutApiController.php';

        $controller = new CheckoutApiController($userId);
        $cartItems = $controller->getCartItems($cartId);

        if (!empty($cartItems)) {
            foreach ($cartItems as $product) {

                echo '<div class="checkout-box">';

                $header = $product['product_name'];
                $secHeader = $product['under_category_name'];
                $price = '$' . $product['product_price'];
                $image = '/dashboard/webbshop-uppgift/app' . $product['image_url'];
                $quantity = $product['quantity'];
                $id = $product['id'];
                $productId = $product['product_id'];

                include view('components/checkoutbox.php');

                echo '</div>';
            }
        } else {
            echo "<p class=''>" . $response['message'] . "</p>";
        }

        ?>

    </div>

    <div class="shop-more">
        <p>Want more friends? <a href="/dashboard/webbshop-uppgift/products">Continue shopping</a></p>
    </div>
    <div class="delivery">
        <h2>Delivery</h2>
        <div class="fast-delivery">
            <div class="delivery-text">
                <h3>$4.99 - Fast delivery</h3>
                <p>Get your Friend tomorrow</p>
            </div>
            <input type="radio" name="shipping" value="fast" checked>
        </div>
        <div class="free-delivery">
            <div class="delivery-text">
                <h3>Free delivery</h3>
                <p>Get your Friend in 4-5 work days</p>
            </div>
            <input type="radio" name="shipping" value="free">
        </div>
    </div>
    <article class="checkout-details">
        <h2>Payment Details</h2>
        <form action="">
            <label for="email">Email adress</label>
            <input type="email" name="email" id="email" required value="<?php echo htmlspecialchars($email); ?>">
            <p>Not your email? <a href="/dashboard/webbshop-uppgift/app/includes/LogoutInc.php">Logout</a></p>

            <label for="payment-methods">Select payment method</label>
            <div class="payment-methods">
                <label class="payment-option">
                    <input type="radio" name="payment" value="card" checked>
                    <div class="content">
                        <i class="fa-solid fa-credit-card"></i>
                        <p>Debit/Credit card</p>
                    </div>
                </label>

                <label class="payment-option">
                    <input type="radio" name="payment" value="cash">
                    <div class="content">
                        <i class="fa-solid fa-money-bill-wave"></i>
                        <p>Cash</p>
                    </div>
                </label>
            </div>

            <label for="card-details">Card details</label>
            <input type="text" name="card-details" placeholder="Name on card">
            <input type="number" placeholder="Card number">
            <div class="bottom-card-details">
                <input type="text" placeholder="MM/YY">
                <input type="text" placeholder="CVC">
            </div>
            <div class="checkout-total">
                <h3>Total amount:</h3>
                <p>
                    $<?php echo htmlspecialchars($cartTotal); ?>
                </p>
            </div>
            <div class="checkout-btn">
                <button type="submit" name="submit">Place order</button>
            </div>
        </form>
    </article>

</section>