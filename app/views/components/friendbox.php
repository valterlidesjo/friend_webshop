<a href="/dashboard/webbshop-uppgift/friend?id=<?php echo isset($id) ? $id : 'default'; ?>"
    class="friend-box">
    <div class="friend-header-container">
        <p class="friend-header">
            <?php
            if (isset($header)) {
                echo $header;
            } else {
                echo "<p>Inget innehåll kunde laddas – kontrollera sökvägen: $header</p>";
            }
            ?>
        </p>
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
    <div class="friend-image">
        <img src="<?php echo $image ?? '/dashboard/webbshop-uppgift/app/src/assets/default-friend.jpg'; ?>" alt="A friend">
    </div>
    <div class="friend-price">
        <p>
            <?php
            if (isset($price)) {
                echo $price;
            } else {
                echo "<p>Inget innehåll kunde laddas – kontrollera sökvägen: $price</p>";
            }
            ?>
        </p>
        <i class="fa-solid fa-bag-shopping"></i>    
    </div>
</a>