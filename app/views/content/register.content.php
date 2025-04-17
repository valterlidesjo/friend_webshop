<section class="register-container">
    <div class="register-header">
        <h1>Welcome <span>FRIEND!</span></h1>
        <h2>Please register to begin shopping</h2>
    </div>
    <div class="register-form">
        <form method="POST">
            <input type="text" id="name" name="name" placeholder="Enter name" required>
            <input type="email" id="email" name="email" placeholder="Enter email" required>
            <div class="password-container">
                <input type="password" id="password" name="password" placeholder="Password" required>
                <i class="fa-regular fa-eye-slash" id="showPassword"></i>
            </div>
            <div class="password-repeat-container">
                <input type="password" id="passwordRepeat" name="passwordRepeat" placeholder="Repeat password" required>
                <i class="fa-regular fa-eye-slash" id="showRepeatPassword"></i>
            </div>
            <input type="text" id="adress" name="adress" placeholder="Adress" required>
            <input type="text" id="city" name="city" placeholder="City" required>
            <input type="number" id="postCode" name="postCode" placeholder="Post Code" required>
            <button type="submit">Register</button>
        </form>
    </div>
    <div class="register-footer">
        <p>Already a member?<a href="">Login</a></p>
    </div>
</section>