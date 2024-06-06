<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href='https://fonts.googleapis.com/css?family=Kaisei Opti' rel='stylesheet'>
</head>
<body>
    <?php include 'header.php';?>
    <div class="login-container">
        <div class="login-image">
            <img src="Images/home.png">
        </div>
        <div class="login-text">
            <h1>Welcome to Cure Corner</h1>
            <div>
                <form class="login-form">
                    <h3>Log In Into Your Account</h3>

                    <input type="email" name="email" placeholder="Email"><br>
                    <input type="password" name="password" placeholder="Password"><br>
                    <a href="forgotPassword.php">Forgot Password?</a><br>
                    <input type="submit" name="submit" value="LogIn">
                </form>
            </div>

            <h2>Don't have an account? <a href="signup.html">Register Here</a></h2>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>