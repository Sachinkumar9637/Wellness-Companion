<?php session_start(); ?>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
</head>

<body class="textStyling">
    <?php require 'db.php';?>
    <header class="headerClass">
        <div class="headerContainer">
            <div class="logo">
                <a href="index.php">
                    <img src="Images/Headerlogo.jpg" alt="Technical Error! Logo image">
                </a>
            </div>

            <div class="menu-toggle" onclick="toggleMenu()">
                <i class="fa fa-bars"></i>
            </div>
            <!--Navigation menu bar for mobile view-->
            <div class="nav-menu">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="aboutus.php">About Us</a></li>
                    <li><a href="services.php">Services</a></li>
                    <li><a href="healingStories.php">Healing Stories</a></li>
                    <li><a href="#">How it works</a></li>
                    <?php
                    if (!isset($_SESSION['Email']) && !isset($_SESSION['Password'])) {
                        ?>
                       <li><a href="userSignup.php">Sign Up</a></li>
                        <li><a href="login.php" class="login-btn">Login</a></li>
                        <?php
                    } else {
                        if ($_SESSION["userType"] == "user") {
                            ?>
                            <li><a href="userProfile.php">Profile</a></li>
                            <li><a href="userDashboard.php">Dashboard</a></li>
                            <?php
                        } else {
                            ?>
                            <li><a href="expertDashboard.php">Expert Dashboard</a></li>
                            <?php
                        }
                        ?>
                        <li><a href="logout.php" class="login-btn">Logout</a></li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
            <!-- Navigation bar for Desktop view -->
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="aboutus.php">About Us</a></li>
                    <li><a href="services.php">Services</a></li>
                    <li><a href="healingStories.php">Healing Stories</a></li>
                    <li><a href="#">How it works</a></li>
                    <?php
                    if (!isset($_SESSION['Email']) && !isset($_SESSION['Password'])) {
                        ?>
                        <li><a href="userSignup.php">Sign Up</a></li>
                        <?php
                    } else {
                        if ($_SESSION["userType"] == "user") {
                            ?>
                            <li><a href="userProfile.php">Profile</a></li>
                            <li><a href="userDashboard.php">Dashboard</a></li>
                            <?php
                        } else {
                            ?>
                            <li><a href="expertDashboard.php">Expert Dashboard</a></li>
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
                    <?php
                } else {
                    ?>
                    <a href="logout.php" class="login-btn">Logout</a>
                    <?php
                }
                ?>
            </div>
        </div>
    </header>

    <script>
        function toggleMenu() {
            var menu = document.querySelector('.nav-menu');
            menu.classList.toggle('active');
        }
    </script>
</body>

</html>