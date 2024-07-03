<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot Password</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href='https://fonts.googleapis.com/css?family=Kaisei Opti' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'header.php'; ?>
    <div class="fpassword-container">
        <div class="fpassword-image">
            <img src="Images/home.jpeg">
        </div>
        <div class="fpassword-text">
            <h1>Welcome to Cure Corner</h1>
            <div>
                <form class="fpassword-form">
                    <h3>Enter your email and we'll send you link to reset your password</h3>

                    <input type="email" name="email" placeholder="Email"><br>
                    <button type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>