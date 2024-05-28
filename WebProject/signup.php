<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .signup-form {
            padding: 15px;
        }
        .button {
            all: unset;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 20px auto;
            position: relative;
            padding: 0.0098em 2em;
            border: #334b72 solid 0.15em;
            border-radius: 3.25em;
            color: #334b72;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            overflow: hidden;
            transition: border 300ms, color 300ms;
            user-select: none;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="background"></div>
    <div class="container">
        <div class="header">
            <h2>Welcome!</h2>
            <p>Join us by signing up</p>
        </div>
        <form class="signup-form" action="signupwithdb.php" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Username" required minlength="5" maxlength="50">
                <span class="error"><?php echo isset($_GET['usernameErr']) ? $_GET['usernameErr'] : ''; ?></span>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Email" required maxlength="100">
                <span class="error"><?php echo isset($_GET['emailErr']) ? $_GET['emailErr'] : ''; ?></span>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" required minlength="8" maxlength="255">
                <span class="error"><?php echo isset($_GET['passwordErr']) ? $_GET['passwordErr'] : ''; ?></span>
            </div>
            <button class="button" type="submit"><p>Sign up</p></button>
            <div class="footer">
                <span>Already have an account? <a href="Login.php">Log in</a></span>
            </div>
        </form>
    </div>
</body>
</html>
