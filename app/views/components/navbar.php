<nav class="w-full flex flex-col justify-between items-center h-16 bg-white shadow-md z-100" style="position: fixed; top: 0; left: 0; z-index: 100;">
<!-- <nav class="w-full flex justify-   between items-center h-16 bg-white shadow-md z-100 fixed top-0 left-0"> -->
        <div class="flex items-center h-16 w-full justify-between">
        <p class="text-[80px] text-orange-500 font-['Jomhuria'] pl-4 pt-3">FRIEND.</p>

        <div class="flex h-16 justify-center items-center gap-4">
            <i class="fa-solid fa-bag-shopping text-2xl"></i>
            <button id="menu-toggle" class="flex flex-col items-end h-6 justify-between pr-3 z-50">
                <span class="w-12 h-0.5 bg-black transition-all"></span>
                <span class="w-8 h-0.5 bg-black transition-all"></span>
            </button>
        </div>
        </div>
        <form method="GET">
        <input type="text" name="q" value="<?php echo $q; ?>" class="bg-gray-200 rounded-full h-10 w-1/4 px-4 focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Search...">
        <button type="submit"><i class="fa-solid fa-magnifying-glass text-2xl"></i></button>
        </form>
</nav>