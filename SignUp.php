<?php
require ('db.php');

$error = "";
$msg = "";

if (isset($_REQUEST['registration_user'])) {
    $firstName = $_REQUEST['FirstName'];
    $lastName = $_REQUEST['LastName'];
    $email = $_REQUEST['Email'];
    $phone = $_REQUEST['Phone'];
    $gender = isset($_POST['Gender']) ? $_POST['Gender'] : '';
    $password = $_REQUEST['Password'];
    $profession = $_REQUEST['Profession'];

    $password = sha1($password);

    $query = "SELECT * FROM tblUser WHERE Email='$email'";
    $res = mysqli_query($conn, $query);
    $num = mysqli_num_rows($res);

    if ($num == 1) {
        $error = "<p class='alert alert-warning'>Email Id already Exist</p> ";
    } else {
        if (!empty($firstName) && !empty($lastName) && !empty($email) && !empty($password) && !empty($phone) && !empty($gender) && !empty($profession)) {
            $sql = "INSERT INTO tblUser (FirstName, LastName, Email, Password, Contact, Gender, Profession) VALUES ('$firstName', '$lastName', '$email', '$password', '$phone', '$gender', '$profession')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $userID = mysqli_insert_id($conn);
                $_SESSION['UserID'] = $userID;
                $msg = "<p class='alert alert-success'>Registration Successful!!</p> ";
                header("location:login.php");
            } else {
                $error = "<p class='alert alert-warning'>Cannot Register, Check your details.</p> ";
            }
        } else {
            $error = "<p class='alert alert-warning'>Please Fill all the fields</p>";
        }
    }
}

if (isset($_REQUEST['registration_expert'])) {
    $firstName = $_REQUEST['FirstName'];
    $lastName = $_REQUEST['LastName'];
    $phone = $_REQUEST['Phone'];
    $email = $_REQUEST['Email'];
    $password = $_REQUEST['Password'];
    $gender = isset($_POST['Gender']) ? $_POST['Gender'] : '';
    $expertise = $_REQUEST['Expertise'];

    $password = sha1($password);

    $query = "SELECT * FROM tblExpert WHERE Email='$email'";
    $res = mysqli_query($conn, $query);
    $num = mysqli_num_rows($res);

    if ($num == 1) {
        $error = "<p class='alert alert-warning'>Email Id already Exist</p> ";
    } else {
        if (!empty($firstName) && !empty($lastName) && !empty($phone) && !empty($email) && !empty($password) && !empty($gender) && !empty($expertise)) {
            $sql = "INSERT INTO tblExpert (FirstName, LastName, Contact, Email, Password, Gender, Expertise) VALUES ('$firstName', '$lastName', '$phone', '$email', '$password', '$gender', '$expertise')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $expertID = mysqli_insert_id($conn);
                $_SESSION['ExpertID'] = $expertID;
                $msg = "<p class='alert alert-success'>Registration Successful!!</p> ";
                header("location:login.php");
            } else {
                $error = "<p class='alert alert-warning'>Cannot Register, Check your details.</p> ";
            }
        } else {
            $error = "<p class='alert alert-warning'>Please Fill all the fields</p>";
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
                </select><br>
                <input type="text" id="Profession" name="Profession" placeholder="Profession"><br>
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
                <input type="text" id="Phone" name="Phone" placeholder="Contact" maxlength="10"><br>
                <input type="email" id="email" name="Email" placeholder="Email"><br>
                <input type="password" id="Password" name="Password" placeholder="Password"><br>
                <select id="Gender" name="Gender">
                    <option value="" disabled selected>Select your gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select><br>
                <input type="text" id="Expertise" name="Expertise" placeholder="Expertise"><br>
                <button type="submit" name="registration_expert">Sign Up</button>
            </form>
        </div>
    </div>
    <?php include 'footer.php'; ?>

    <script>
        function toggleForm(formType) {
            document.getElementById('user-form').classList.remove('active');
            document.getElementById('expert-form').classList.remove('active');
            document.getElementById('user-tab').classList.remove('active');
            document.getElementById('expert-tab').classList.remove('active');

            if (formType === 'user') {
                document.getElementById('user-form').classList.add('active');
                document.getElementById('user-tab').classList.add('active');
            } else {
                document.getElementById('expert-form').classList.add('active');
                document.getElementById('expert-tab').classList.add('active');
            }
        }

        // Show user form by default
        toggleForm('user');
    </script>
</body>

</html>