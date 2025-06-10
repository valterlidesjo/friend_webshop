<?php
session_start();
$cartId = $_SESSION['cartid'] ?? '6969420';
$email = $_SESSION['email'] ?? 'default@email.com';
$checkoutTotal = $_SESSION['checkouttotal'] ?? 0;
?>
<section class="confirmation-section">
    <h1>Thank you for your order!</h1>
    <div class="confirmation-info">

       
                    <h3>Hope you enjoy your new friends!</h3>
                    <h3>Best regards,</h3>
                    <h3 class="last-confirmation"><span>Friend.</span></h3>
    </div>
    <div class="shop-more">
        <p>Want more friends? </p>
        <a href="/dashboard/webbshop-uppgift/products">Continue shopping</a>
    </div>
</section>