<!DOCTYPE html>
<html lang="en">
<?php
include view('components/head.php');
?>

<body>
    <div class="template-container">
        <?php
        include view('components/navbar.php');
        ?>

        <main class="template-main">
            <?php
            if (isset($content)) {
                include $content;
            } else {
                echo "<p>Inget innehåll kunde laddas – kontrollera sökvägen: $content</p>";
            }
            ?>
            <?php
            include view('components/cartCircle.php');
            ?>
        </main>

        <?php
        include view('components/footer.php');
        ?>
    </div>

</body>

</html>