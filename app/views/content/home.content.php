<section class="flex flex-col justify-evenly h-[calc(100vh-65px)] w-full px-8">
    <div>
        <p class="font-['Jomhuria'] text-[100px] leading-[0.7] pt-16">A <span class="text-orange-500">FRIEND.</span> <br>
            MADE <br>
            FOR YOU</p>
    </div>
    <div class="flex justify-center items-center w-full">
        <img src="/dashboard/webbshop-uppgift/app/src/assets/alien1.jpg" alt="Alien holding hand" class="w-3/4">
    </div>
    <div class="w-full flex justify-center items-center">
        <button class="flex flex-col items-center justify-center w-full bg-orange-500 rounded-4xl">
            <p class="font-['Jomhuria'] text-[42px] text-white">Discover more</p>
        </button>

    </div>
</section>
<section class="flex flex-col items-center h-screen w-full bg-[#FFFDCF] px-8">
    <div class="w-full flex justify-center items-center">
        <p class="text-[50px] text-orange-500 font-['Jomhuria']">POPULAR FRIENDS</p>
    </div>
    <div class="flex w-full justify-between items-center pb-8">
        <?php
        $header = 'Milbert';
        $secHeader = 'Skyfish';
        $price = '$319';
        $image = '/dashboard/webbshop-uppgift/app/src/assets/alien2.jpg';
        include view('components/friendbox.php');
        ?>
        <?php
        $header = 'Kevin';
        $secHeader = 'Brownbear';
        $price = '$69';
        $image = '/dashboard/webbshop-uppgift/app/src/assets/bear1.jpg';
        include view('components/friendbox.php');
        ?>
    </div>
    <div class="flex w-full justify-between items-center pb-8">
        <?php
        $header = 'Milbert';
        $secHeader = 'Skyfish';
        $price = '$319';
        $image = '/dashboard/webbshop-uppgift/app/src/assets/alien2.jpg';
        include view('components/friendbox.php');
        ?>
        <?php
        $header = 'Kevin';
        $secHeader = 'Brownbear';
        $price = '$69';
        $image = '/dashboard/webbshop-uppgift/app/src/assets/bear1.jpg';
        include view('components/friendbox.php');
        ?>
    </div>
    <div class="flex w-full justify-between items-center pb-8">
        <p>6 more, need 10 total</p>
    </div>
</section>
<section class="flex flex-col justify-evenly h-auto w-full px-8">
    <div>
        <p class="text-[60px] text-orange-500 font-['Jomhuria']">OUR CATEGORIES</p>
    </div>
    <div class="flex w-full justify-between items-center gap-4 pb-4">
        <button class="flex flex-col items-center justify-center w-full bg-orange-500 rounded-4xl">
            <p class="font-['Jomhuria'] text-[42px] text-white">Bears</p>
        </button>
        <button class="flex flex-col items-center justify-center w-full bg-orange-500 rounded-4xl">
            <p class="font-['Jomhuria'] text-[42px] text-white">Birds</p>
        </button>
    </div>
    <div class="flex w-full justify-center items-center">
        <button class="flex flex-col items-center justify-center w-[calc(50%-8px)] bg-orange-500 rounded-4xl">
            <p class="font-['Jomhuria'] text-[42px] text-white">Aliens</p>
        </button>
    </div>
</section>