<?php
session_start();
?>
<section class="login-container">
    <div class="login-header">
        <?php if (isset($_SESSION['userid']) && isset($_SESSION['username'])): ?>
            <h1>Hello <span><?php echo htmlspecialchars($_SESSION['username']); ?>!</span></h1>
            <h2>Welcome back, happy shopping!</h2>
        <?php else: ?>
            <h1>Hello <span>FRIEND!</span></h1>
            <h2>Welcome back, please login to begin shopping</h2>
        <?php endif; ?>
    </div>
    <div class="login-form">
        <form method="POST" action="/dashboard/webbshop-uppgift/app/includes/LoginInc.php">
            <input type="email" id="email" name="email" placeholder="Enter email" required>
            <div class="password-container">
                <input type="password" id="password" name="password" placeholder="Password" required>
                <i class="fa-regular fa-eye-slash" id="showPassword"></i>
            </div>
            <button type="submit" name="submit">Login</button>
        </form>
    </div>
    <div class="login-footer">
        <p>Not a member?<a href="/dashboard/webbshop-uppgift/register">Register now</a></p>
        <?php if (isset($_SESSION['userid']) && isset($_SESSION['username'])): ?>
            <p>Want to logout?<a href="/dashboard/webbshop-uppgift/app/includes/LogoutInc.php">Logout now</a></p>
        <?php endif; ?>
    </div>
</section>