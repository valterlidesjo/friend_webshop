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

        <?php
        include view('components/footer.php');
        ?>
    </div>

</body>

</html>