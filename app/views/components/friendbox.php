<div class="w-[calc(50%-1rem)] flex flex-col justify-between items-center h-[265px] bg-white rounded-2xl">
    <div class="p-2 flex flex-col items-start justify-center w-full h-auto">
<p class="text-[1rem] font-bold font-['Geist_Mono']">
        <?php
        if (isset($header)) {
            echo $header;
        } else {
            echo "<p>Inget innehåll kunde laddas – kontrollera sökvägen: $header</p>";
        }
        ?>
    </p>
    <p class="text-[1rem] font-['Geist_Mono']">
        <?php
        if (isset($secHeader)) {
            echo $secHeader;
        } else {
            echo "<p>Inget innehåll kunde laddas – kontrollera sökvägen: $secHeader</p>";
        }
        ?>
    </p>
    </div>
    <div class="w-full flex justify-center items-center">
    <img src="<?php echo $image ?? '/dashboard/webbshop-uppgift/app/src/assets/default-friend.jpg'; ?>" alt="A friend" class="max-w-[110px] max-h-[110px] object-contain"
    >
    </div>
    <div class="flex justify-between items-center p-2 w-full">
    <p class="text-[1rem] font-bold font-['Geist_Mono']">
        <?php
        if (isset($price)) {
            echo $price;
        } else {
            echo "<p>Inget innehåll kunde laddas – kontrollera sökvägen: $price</p>";
        }
        ?>
    </p>
    <i class="fa-solid fa-bag-shopping text-[1.2rem]"></i>
    </div>


</div>