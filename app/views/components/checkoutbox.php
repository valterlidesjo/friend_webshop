<div class="checkoutbox-image">
    <img src="<?php echo $image ?? '/dashboard/webbshop-uppgift/app/src/assets/default-friend.jpg'; ?>" alt="A friend">
</div>
<div class="checkout-right">
    <div class="checkoutbox-text">
        <div class="checkoutbox-header">
            <h1>
                <?php
                if (isset($header)) {
                    echo $header;
                } else {
                    echo "<p>Inget innehåll kunde laddas – kontrollera sökvägen: $header</p>";
                }
                ?>
            </h1>
            <p>
                <?php
                if (isset($price)) {
                    echo $price;
                } else {
                    echo "<p>Inget innehåll kunde laddas – kontrollera sökvägen: $price</p>";
                }
                ?>
            </p>
        </div>
        <div class="checkoutbox-category">
            <p>
                <?php
                if (isset($secHeader)) {
                    echo $secHeader;
                } else {
                    echo "<p>Inget innehåll kunde laddas – kontrollera sökvägen: $secHeader</p>";
                }
                ?>
            </p>
        </div>
    </div>
    <div class="crud-icons">
        <div class="plus-minus">
            <a href="/dashboard/webbshop-uppgift/app/includes/UpdateCartInc.php?action=decrease&product=<?php echo $productId; ?>">
                <i class="fa-solid fa-minus"></i>
            </a>
            <?php
            if (isset($quantity)) {
                echo $quantity;
            } else {
                echo "<p>Inget innehåll kunde laddas – kontrollera sökvägen: $quantity</p>";
            }
            ?>
            <a href="/dashboard/webbshop-uppgift/app/includes/UpdateCartInc.php?action=increase&product=<?php echo $productId; ?>">
                <i class="fa-solid fa-plus"></i>
            </a>
        </div>
        <a href="/dashboard/webbshop-uppgift/app/includes/UpdateCartInc.php?action=delete&product=<?php echo $productId; ?>">
            <i class="fa-solid fa-trash-can"></i>
        </a>
    </div>
</div>