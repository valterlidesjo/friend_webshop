<?php
session_start();
?>
<nav class="nav">
    <div class="nav-container">
        <a href="/dashboard/webbshop-uppgift/">FRIEND.</a>

        <div class="nav-right">
            <form method="GET" class="search-form" action="/dashboard/webbshop-uppgift/products">
                <input type="text" name="q" value="<?php echo $q; ?>" placeholder="Search...">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
            <button id="menu-toggle" class="hamburger">
                <span class="span-1"></span>
                <span class="span-2"></span>
            </button>
        </div>
    </div>
</nav>
<div class="nav-dropdown" id="nav-dropdown">
    <div class="nav-dropdown-content">
        <a href="/dashboard/webbshop-uppgift/">HOME.</a>
        <a href="/dashboard/webbshop-uppgift/products">PRODUCTS.</a>
        <?php if (isset($_SESSION['userid']) && isset($_SESSION['username'])): ?>
            <a href="/dashboard/webbshop-uppgift/app/includes/LogoutInc.php">LOGOUT.</a></p>
        <?php else: ?>
            <a href="/dashboard/webbshop-uppgift/register">REGISTER.</a>
            <a href="/dashboard/webbshop-uppgift/login">LOGIN.</a>
        <?php endif; ?>
        <?php if (isset($_SESSION['cartid'])): ?>
            <a href="/dashboard/webbshop-uppgift/checkout">CHECKOUT.</a>
        <?php endif; ?>
    </div>
</div>