<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .error-message {
            color: red;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="background"></div>
    <div class="container">
        <div class="header">
            <h2>Welcome Back!</h2>
            <p>Login to your account</p>
        </div>
        <form class="login-form" action="loginwithdb.php" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" required minlength="8" maxlength="25">
            </div>
            <button class="button" type="submit"><p>Login</p></button>
            <?php if (isset($_SESSION['error'])): ?>
            <div class="error-message">
                <p><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
            </div>
            <?php endif; ?>
            <div class="alternative">
                <span>Or login with</span>
                <div class="social-icons">
                    <img class="fab fa-facebook-f" src="images/facebook.png" alt="Facebook Icon"/>
                    <img class="fab fa-twitter" src="images/twitter.png" alt="Twitter Icon"/>
                    <img class="fab fa-google" src="images/google.png" alt="Google Icon"/>
                </div>
            </div>
            <div class="footer">
                <span>Don't have an account? <a href="signup.php">Sign up</a></span>
            </div>
        </form>
    </div>
</body>
</html>
