<?php
session_start();
$cartId = $_SESSION['cartid'] ?? '6969420';
$email = $_SESSION['email'] ?? 'default@email.com';
$checkoutTotal = $_SESSION['checkouttotal'] ?? 0;
?>
<section>
    <h1>Thank you for your order!</h1>
    <h3>Your order number is <b><?php echo $cartId; ?></b></h3>
    <h3>The total cost for your order is <b>$<?php echo $checkoutTotal; ?></b></h3>
    <h3>We have sent a confirmation to your email <?php echo $email; ?></h3>
    <h3>Hope you enjoy your new friends!</h3>
    <h3>Best regards,</h3>
    <h3>Friend.</h3>
    <div class="shop-more">
        <p>Want more friends? <a href="/dashboard/webbshop-uppgift/products">Continue shopping</a></p>
    </div>
</section>