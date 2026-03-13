<?php include './layout/head.php'; ?>

<div class="container">
    <h1>Login</h1>
    <form action="#" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        
        <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="./register.php">Register here</a></p>
    <p><a href="./forgot_password.php">Forgot Password?</a></p>
</div>

<?php include './layout/foot.php'; ?>