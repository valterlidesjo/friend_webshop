<?php
session_start();

function old($field)
{
    return $_SESSION['old_input'][$field] ?? '';
}

function error($field)
{
    return $_SESSION['validation_errors'][$field] ?? '';
}
?>

<section class="register-container">
    <div class="register-header">
        <h1>Welcome <span>FRIEND!</span></h1>
        <h2>Please register to begin shopping</h2>
    </div>
    <div class="register-form">
        <form method="POST" action="/dashboard/webbshop-uppgift/app/includes/RegisterInc.php">
            <input type="text" id="name" name="name" placeholder="Enter name">
            <span class="error"><?= error('name') ?></span>

            <input type="email" id="email" name="email" placeholder="Enter email" required>
            <span class="error"><?= error('email') ?></span>

            <div class="password-container">
                <input type="password" id="password" name="password" placeholder="Password" required>
                <i class="fa-regular fa-eye-slash" id="showPassword"></i>
            </div>
            <span class="error"><?= error('password') ?></span>

            <div class="password-repeat-container">
                <input type="password" id="passwordRepeat" name="passwordRepeat" placeholder="Repeat password" required>
                <i class="fa-regular fa-eye-slash" id="showRepeatPassword"></i>
            </div>
            <span class="error"><?= error('passwordRepeat') ?></span>

            <input type="text" id="adress" name="adress" placeholder="Adress" required>
            <span class="error"><?= error('input') ?></span>

            <input type="text" id="city" name="city" placeholder="City" required>
            <span class="error"><?= error('city') ?></span>

            <input type="number" id="postCode" name="postCode" placeholder="Post Code" required>
            <span class="error"><?= error('postCode') ?></span>

            <button type="submit" name="submit">Register</button>
        </form>
    </div>
    <div class="register-footer">
        <p>Already a member?<a href="/dashboard/webbshop-uppgift/login">Login</a></p>
    </div>
</section>