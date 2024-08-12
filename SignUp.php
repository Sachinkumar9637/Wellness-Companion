<?php
require('db.php');
session_start();
$error = "";
$msg = "";

function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

function validateAlpha($data) {
    return preg_match('/^[a-zA-Z]+$/', $data);
}

if (isset($_REQUEST['registration_user'])) {
    $firstName = sanitizeInput($_REQUEST['FirstName']);
    $lastName = sanitizeInput($_REQUEST['LastName']);
    $email = sanitizeInput($_REQUEST['Email']);
    $phone = sanitizeInput($_REQUEST['Phone']);
    $gender = isset($_POST['Gender']) ? sanitizeInput($_POST['Gender']) : '';
    $password = sanitizeInput($_REQUEST['Password']);
    $profession = sanitizeInput($_REQUEST['Profession']);

    // Validation
    if (empty($firstName) || !validateAlpha($firstName)) {
        $error .= "<p class='alert alert-warning'>Valid First Name is required (letters only).</p>";
    }
    if (empty($lastName) || !validateAlpha($lastName)) {
        $error .= "<p class='alert alert-warning'>Valid Last Name is required (letters only).</p>";
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error .= "<p class='alert alert-warning'>Valid Email is required.</p>";
    }
    if (empty($phone) || !preg_match('/^[0-9]{10}$/', $phone)) {
        $error .= "<p class='alert alert-warning'>Valid Phone Number is required.</p>";
    }
    if (empty($gender)) {
        $error .= "<p class='alert alert-warning'>Gender is required.</p>";
    }
    if (empty($password) || strlen($password) < 6) {
        $error .= "<p class='alert alert-warning'>Password must be at least 6 characters long.</p>";
    }
    if (empty($profession) || !validateAlpha($profession)) {
        $error .= "<p class='alert alert-warning'>Valid Profession is required (letters only).</p>";
    }

    if (empty($error)) {
        $password = sha1($password);

        $query = "SELECT * FROM tblUser WHERE Email='$email'";
        $res = mysqli_query($conn, $query);
        $num = mysqli_num_rows($res);

        if ($num == 1) {
            $error = "<p class='alert alert-warning'>Email Id already exists.</p>";
        } else {
            $sql = "INSERT INTO tblUser (FirstName, LastName, Email, Password, Contact, Gender, Profession) VALUES ('$firstName', '$lastName', '$email', '$password', '$phone', '$gender', '$profession')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $userID = mysqli_insert_id($conn);
                $_SESSION['UserID'] = $userID;
                $msg = "<p class='alert alert-success'>Registration Successful!</p>";
                header("location:login.php");
                exit();
            } else {
                $error = "<p class='alert alert-warning'>Cannot Register, Check your details.</p>";
            }
        }
    }
}

if (isset($_REQUEST['registration_expert'])) {
    $firstName = sanitizeInput($_REQUEST['FirstName']);
    $lastName = sanitizeInput($_REQUEST['LastName']);
    $phone = sanitizeInput($_REQUEST['Phone']);
    $email = sanitizeInput($_REQUEST['Email']);
    $password = sanitizeInput($_REQUEST['Password']);
    $gender = isset($_POST['Gender']) ? sanitizeInput($_POST['Gender']) : '';
    $expertise = sanitizeInput($_REQUEST['Expertise']);

    // Validation
    if (empty($firstName) || !validateAlpha($firstName)) {
        $error .= "<p class='alert alert-warning'>Valid First Name is required (letters only).</p>";
    }
    if (empty($lastName) || !validateAlpha($lastName)) {
        $error .= "<p class='alert alert-warning'>Valid Last Name is required (letters only).</p>";
    }
    if (empty($phone) || !preg_match('/^[0-9]{10}$/', $phone)) {
        $error .= "<p class='alert alert-warning'>Valid Phone Number is required.</p>";
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error .= "<p class='alert alert-warning'>Valid Email is required.</p>";
    }
    if (empty($password) || strlen($password) < 6) {
        $error .= "<p class='alert alert-warning'>Password must be at least 6 characters long.</p>";
    }
    if (empty($gender)) {
        $error .= "<p class='alert alert-warning'>Gender is required.</p>";
    }
    if (empty($expertise) || !validateAlpha($expertise)) {
        $error .= "<p class='alert alert-warning'>Valid Expertise is required (letters only).</p>";
    }

    if (empty($error)) {
        $password = sha1($password);

        $query = "SELECT * FROM tblExpert WHERE Email='$email'";
        $res = mysqli_query($conn, $query);
        $num = mysqli_num_rows($res);

        if ($num == 1) {
            $error = "<p class='alert alert-warning'>Email Id already exists.</p>";
        } else {
            $sql = "INSERT INTO tblExpert (FirstName, LastName, Contact, Email, Password, Gender, Expertise) VALUES ('$firstName', '$lastName', '$phone', '$email', '$password', '$gender', '$expertise')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $expertID = mysqli_insert_id($conn);
                $_SESSION['ExpertID'] = $expertID;
                $msg = "<p class='alert alert-success'>Registration Successful!</p>";
                header("location:login.php");
                exit();
            } else {
                $error = "<p class='alert alert-warning'>Cannot Register, Check your details.</p>";
            }
        }
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User and Expert Sign Up Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href='https://fonts.googleapis.com/css?family=Kaisei Opti' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-container {
            display: none;
        }

        .form-container.active {
            display: block;
        }

        .nav-tabs {
            margin-bottom: 20px;
        }

        .nav-tabs .nav-link {
            cursor: pointer;
        }

        .nav-tabs .nav-link.active {
            font-weight: bold;
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="signup">
        <h1>How CureCorner Works</h1>
    </div>

    <div class="signup-container">
        <div>
            <img src="Images/Signup1.png">
            <div class="signup-text">
                <h3>Spinal Decompression</h3>
                <p>It is a long established fact that each will be distracted by the readable</p>
            </div>
        </div>
        <div>
            <img src="Images/Signup4.png">
            <div class="signup-text">
                <h3>Accupuncture Treatment</h3>
                <p>It is a long established fact that each will be distracted by the readable</p>
            </div>
        </div>
        <div>
            <img src="Images/Signup3.png">
            <div class="signup-text">
                <h3>Fitness Treatment</h3>
                <p>It is a long established fact that each will be distracted by the readable</p>
            </div>
        </div>
    </div>


    <div class="signupForm p-3 ">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" id="user-tab" data-bs-toggle="tab" onclick="toggleForm('user')">User Sign
                    Up</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="expert-tab" data-bs-toggle="tab" onclick="toggleForm('expert')">Expert Sign
                    Up</a>
            </li>
        </ul>
        <div class="form-container active" id="user-form">
            <form class="signup-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST"
                id="registration_form_user">
                <h3 class="text-center">Sign-Up Here as User</h3>
                <?php echo $error; ?><?php echo $msg; ?>
                <input type="text" id="FirstName" name="FirstName" placeholder="First Name"><br>
                <input type="text" id="LastName" name="LastName" placeholder="Last Name"><br>
                <input type="email" id="email" name="Email" placeholder="Email"><br>
                <input type="password" id="Password" name="Password" placeholder="Password"><br>
                <input type="text" id="Phone" name="Phone" placeholder="Phone Number" maxlength="10"><br>
                <select id="Gender" name="Gender">
                    <option value="" disabled selected>Select your gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select><br>
                <input type="text" id="Profession" name="Profession" placeholder="Your Profession"><br>
                <button type="submit" name="registration_user">Sign Up</button>
            </form>
        </div>
        <div class="form-container" id="expert-form">
            <form class="signup-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST"
                id="registration_form_expert">
                <h3 class="text-center">Sign-Up Here as Expert</h3>
                <?php echo $error; ?><?php echo $msg; ?>
                <input type="text" id="FirstName" name="FirstName" placeholder="First Name"><br>
                <input type="text" id="LastName" name="LastName" placeholder="Last Name"><br>
                <input type="text" id="Phone" name="Phone" placeholder="Phone Number" maxlength="10"><br>
                <input type="email" id="Email" name="Email" placeholder="Email"><br>
                <input type="password" id="Password" name="Password" placeholder="Password"><br>
                <select id="Gender" name="Gender">
                    <option value="" disabled selected>Select your gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select><br>
                <input type="text" id="Expertise" name="Expertise" placeholder="Your Expertise"><br>
                <button type="submit" name="registration_expert">Sign Up</button>
            </form>
        </div>
    </div>
    <script>
        function toggleForm(form) {
            document.getElementById('user-form').classList.remove('active');
            document.getElementById('expert-form').classList.remove('active');

            if (form === 'user') {
                document.getElementById('user-form').classList.add('active');
                document.getElementById('user-tab').classList.add('active');
                document.getElementById('expert-tab').classList.remove('active');
            } else {
                document.getElementById('expert-form').classList.add('active');
                document.getElementById('expert-tab').classList.add('active');
                document.getElementById('user-tab').classList.remove('active');
            }
        }
    </script>

    <?php include 'footer.php'; ?>
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz4fnFO9gybBogGzq4FYjFjTXg+re6iH+rk6EnBboWp6n2YFy1zc1h0kTA" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
        integrity="sha384-mQ93qYORxQYUXH1B6N0yQAKeIjrD+U5+ayTq2b1u/peLnsjIBwBfDIvHOfTQYCIH" crossorigin="anonymous">
    </script> -->
</body>

</html>
