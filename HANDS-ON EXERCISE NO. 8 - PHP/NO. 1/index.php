<?php include './layout/head.php'; ?>

<div class="container">
    <h1>Forgot Password</h1>
    <p>Enter your email address and we'll send you a link to reset your password.</p>
    <form action="#" method="post">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        
        <button type="submit">Send Reset Link</button>
    </form>
    <p>Remember your password? <a href="./login.php">Login here</a></p>
</div>

<?php include './layout/foot.php'; ?>