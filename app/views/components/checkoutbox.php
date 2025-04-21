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
            <i class="fa-solid fa-minus"></i>
            <?php
            if (isset($quantity)) {
                echo $quantity;
            } else {
                echo "<p>Inget innehåll kunde laddas – kontrollera sökvägen: $quantity</p>";
            }
            ?>
            <i class="fa-solid fa-plus"></i>
        </div>
        <i class="fa-solid fa-trash-can"></i>
    </div>
</div>