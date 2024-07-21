<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arsenal:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">


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
                    <li><a href="#">User +</a>
                    <div class="nav-dropdown">
                            <a href="userProfile.php">User Profile</a>
                            <a href="#">Reminders</a>
                            <a href="#">Personalized Exercise Plans</a>
                    </div>  
                    </li>
                    <li><a href="#">Expert +</a>
                    <div class="nav-dropdown">
                            <a href="#">Expert Profile</a>
                    </div>
                    </li>
                    <li><a href="#">Consult an Expert</a></li>
                </ul>
            </nav>
            <div class="login">
                <a href="login.php" class="login-btn">User Login</a>
            </div>
            </div>
        </header>
    </body>
</html>