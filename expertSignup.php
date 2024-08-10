<?php
require('db.php');

$error = "";
$msg = "";

if (isset($_REQUEST['registration'])) {
	$firstName = trim($_REQUEST['FirstName']);
	$lastName = trim($_REQUEST['LastName']);
	$phone = trim($_REQUEST['Phone']);
	$email = trim($_REQUEST['Email']);
	$password = trim($_REQUEST['Password']);
	$gender = isset($_POST['Gender']) ? $_POST['Gender'] : '';
	$expertise = trim($_REQUEST['Expertise']);

	$namePattern = "/^[A-Za-z]{1,10}$/";
	$emailPattern = "/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/";
	$phonePattern = "/^[0-9]{10}$/";

	if (!preg_match($namePattern, $firstName)) {
		$error = "<p class='alert alert-warning'>First Name should contain only alphabets and be a maximum of 10 characters</p>";
	} elseif (!preg_match($namePattern, $lastName)) {
		$error = "<p class='alert alert-warning'>Last Name should contain only alphabets and be a maximum of 10 characters</p>";
	} elseif (!preg_match($emailPattern, $email)) {
		$error = "<p class='alert alert-warning'>Invalid Email format</p>";
	} elseif (!preg_match($phonePattern, $phone)) {
		$error = "<p class='alert alert-warning'>Phone Number should be exactly 10 digits</p>";
	} elseif (strlen($password) < 6) {
		$error = "<p class='alert alert-warning'>Password should be at least 6 characters long</p>";
	} elseif (empty($gender)) {
		$error = "<p class='alert alert-warning'>Please select your gender</p>";
	} elseif (empty($expertise)) {
		$error = "<p class='alert alert-warning'>Please enter your expertise</p>";
	} else {
		$password = sha1($password);

		$query = "SELECT * FROM tblExpert WHERE Email='$email'";
		$res = mysqli_query($conn, $query);
		$num = mysqli_num_rows($res);

		if ($num == 1) {
			$error = "<p class='alert alert-warning'>Email Id already exists</p>";
		} else {
			$sql = "INSERT INTO tblExpert (FirstName,LastName,Contact,Email,Password,Gender,Expertise) VALUES ('$firstName','$lastName','$phone','$email','$password','$gender','$expertise')";
			$result = mysqli_query($conn, $sql);

			if ($result) {
				$expertID = mysqli_insert_id($conn);

				$_SESSION['ExpertID'] = $expertID;
				$msg = "<p class='alert alert-success'>Registration Successful!!</p>";
				header("location:login.php");
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
	<title>Expert Sign Up Page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href='https://fonts.googleapis.com/css?family=Kaisei Opti' rel='stylesheet'>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
	<?php include 'header.php';?>
	<div class="signup">
		<h1>How CureCorner Works</h1>
	</div>

	<div class="expert-signup-container">
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

	<div class="signupForm">
		<form class="signup-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" id="registration_form">
            <h1>Sign-Up Here</h1>

            <?php echo $error; ?><?php echo $msg; ?>

            <input type="text" id="FirstName" name="FirstName" placeholder="First Name" maxlength="10"><br>
            <input type="text" id="LastName" name="LastName" placeholder="Last Name" maxlength="10"><br>
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

            <button type="submit" name="registration">Sign Up</button>
        </form>
	</div>

	<?php include 'footer.php';?>
</body>

</html>
