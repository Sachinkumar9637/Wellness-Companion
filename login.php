<?php
session_start();
include ("db.php");
$error = "";
$msg = "";

if (isset($_REQUEST['login'])) {
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];

    $password = sha1($password);

    if (!empty($email) && !empty($password)) {
        $userQuery = "SELECT * FROM tblUser WHERE Email='$email' AND Password='$password'";
        $userResult = mysqli_query($conn, $userQuery);

        $expertQuery = "SELECT * FROM tblExpert WHERE Email='$email' AND Password='$password'";
        $expertResult = mysqli_query($conn, $expertQuery);

        if ($userRow = mysqli_fetch_array($userResult)) {
            $_SESSION['UserID']=$userRow['UserID'];
            $_SESSION['Email'] = $email;
            $_SESSION['Password'] = $password;
            $_SESSION['userType']="user";


            header("Location: userProfile.php");
        }
        elseif ($expertRow = mysqli_fetch_array($expertResult)) {
            $_SESSION['Email'] = $email;
            $_SESSION['Password'] = $password;
            $_SESSION['userType']="expert";

            header("Location: expertDashboard.php");
        }
        else {
            $error = "<p class='alert alert-warning'>Email or Password does not match!</p>";
        }
    } else {
        $error = "<p class='alert alert-warning'>Please fill all the fields</p>";
    }
}
?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arsenal:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="login-container">
        <div class="login-image">
            <img src="Images/home.jpeg">
        </div>
        <div class="login-text">
            <h1>Welcome to Cure Corner</h1><br>
            <div>
                <form class="login-form" method="post">
                    <h3>Log In Into Your Account</h3>

                    <?php echo $error; ?><?php echo $msg; ?>
                    <input type="email" name="email" placeholder="Email"><br>
                    <input type="password" name="password" placeholder="Password"><br>
                    <a href="forgotPassword.php">Forgot Password?</a><br>

                    <button type="submit" name="login">LogIn</button>
                </form>
            </div><br>

            <h5>Don't have an account? <a href="SignUp.php">Register</a></h5>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>

</html>