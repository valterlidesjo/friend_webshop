<?php if (isset($_SESSION['userid']) && isset($_SESSION['cartid'])): ?>
    <div class="cart-circle-container">
        <a href="/dashboard/webbshop-uppgift/checkout" class="cart-circle">
            <i class="fa-solid fa-cart-shopping"></i>
            <span class="cart-count"><?php echo htmlspecialchars($_SESSION['totalitems']); ?></span>
        </a>
    </div>
<?php endif; ?>