<!DOCTYPE html>
<html lang="en">
<?php
include view('components/head.php');
?>

<body>
    <div class="flex h-screen flex-col items-center w-full">
        <?php
        include view('components/navbar.php');
        ?>

        <main class="w-full">
            <?php
            if (isset($content)) {
                include $content;
            } else {
                echo "<p>Inget innehåll kunde laddas – kontrollera sökvägen: $content</p>";
            }
            ?>
        </main>

    </div>

    <script>
        const toggleBtn = document.getElementById('menu-toggle');
        const menu = document.getElementById('mobile-menu');
        const line1 = document.getElementById('line1');
        const line2 = document.getElementById('line2');

        let menuOpen = false;

        toggleBtn.addEventListener('click', () => {
            menuOpen = !menuOpen;
            menu.classList.toggle('hidden');

            if (menuOpen) {
                // Gör till ett X
                line1.classList.add('rotate-45', 'translate-y-1.5');
                line2.classList.add('-rotate-45', '-translate-y-1.5', 'w-full');
            } else {
                // Tillbaka till hamburger
                line1.classList.remove('rotate-45', 'translate-y-1.5');
                line2.classList.remove('-rotate-45', '-translate-y-1.5', 'w-full');
            }
        });
    </script>
</body>

</html>