<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arsenal:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">


</head>

<body class="textStyling">
    <header class="headerClass">
        <div class="headerContainer">
            <div class="logo">
                <a href="index.php">
                    <img src="Images/Headerlogo.jpg" alt="Technical Error! Logo image">
                </a>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a>
                    </li>
                    <li><a href="#">About Us</a>
                    </li>
                    <li><a href="#">Services</a>
                    </li>
                    <li><a href="#">Healing Stories</a></li>
                    <li><a href="#">How it works</a></li>
                    <?php
                    if (!isset($_SESSION['Email']) && !isset($_SESSION['Password'])) {
                        ?>
                        <li><a href="signup.php">Sign Up</a></li>
                    <?php } else {
                        if ($_SESSION["userType"] == "user") {


                            ?>
                            <li><a href="userProfile.php">Profile</a></li>
                            <li><a href="userDashboard.php">Dashboard</a></li>

                        <?php } else {
                            ?>
                            <li><a href="expertDashboard.php">ExpertDashboard</a></li>
                            <?php
                        }
                    }
                    ?>

                </ul>
            </nav>
            <div class="login">
                <?php
                if (!isset($_SESSION['Email']) && !isset($_SESSION['Password'])) {
                    ?>
                    <a href="login.php" class="login-btn">Login</a>
                <?php } else {

                    ?><a href="logout.php" class="login-btn">Logout</a>
                <?php } ?>


            </div>

        </div>
    </header>
</body>

</html>