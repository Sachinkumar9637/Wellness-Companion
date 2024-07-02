<?php
    require('dbinit.php');

    $error="";
	$msg="";

	if(isset($_REQUEST['reg']))
	{
		$firstName=$_REQUEST['firstName'];
		$lastName=$_REQUEST['lastName'];
		$email=$_REQUEST['email'];
		$password=$_REQUEST['password'];
		$phoneNumber=$_REQUEST['phoneNumber'];
		$expertise=$_REQUEST['expertise'];

		$password= sha1($password);
		
		$query = "SELECT * FROM register where email='$email'";
		$res=mysqli_query($dbc, $query);
		$num=mysqli_num_rows($res);
		
		if($num == 1)
		{
			$error = "<p class='alert alert-warning'>Email Id already Exist</p> ";
		}
		else
		{
			
			if(!empty($firstName) && !empty($lastName) && !empty($email) && !empty($password) && !empty($phoneNumber) && !empty($expertise))
			{
				
				$sql="INSERT INTO register (firstName,lastName,email,password,phoneNumber,expertise) VALUES ('$firstName','$lastName','$email','$password','$phoneNumber','$expertise')";
				$result=mysqli_query($dbc, $sql);

				   if($result){
					   $msg = "<p class='alert alert-success'>Register Successfully</p> ";
				   }
				   else{
					   $error = "<p class='alert alert-warning'>Register Not Successfully</p> ";
				   }
			}else{
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
	<title>Sign Up Page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href='https://fonts.googleapis.com/css?family=Kaisei Opti' rel='stylesheet'>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<?php include 'header.php';?>
	<div class="signup">
		<h1>How CureCorner Works</h1>
	</div>

	<div class="signup-container">
		<div>
			<img src="Images/Signup1.png">
			<div>
				<h3>Spanial Decompression</h3>
				<p>It is a long established fact that each will be distracted by the readable</p>
			</div>
		</div>
		<div>
			<img src="Images/Signup1.png">
			<div>
				<h3>Accupuncture Treatment</h3>
				<p>It is a long established fact that each will be distracted by the readable</p>
			</div>
		</div>
		<div>
			<img src="Images/Signup3.png">
			<div>
				<h3>Fitness Treatment</h3>
				<p>It is a long established fact that each will be distracted by the readable</p>
			</div>
		</div>
	</div>

	<div class="signupForm">
		<form class="signup-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" id="registration_form">
            <h1>Sign-Up Here</h1>

            <?php echo $error; ?><?php echo $msg; ?>

            <input type="text" id="firstName" name="firstName" placeholder="First Name"><br>
            <input type="text" id="lastName" name="lastName" placeholder="Last Name"><br>
            <input type="email" id="email" name="email" placeholder="Email"><br>
            <input type="password" id="password" name="password" placeholder="Password"><br>
            <input type="text" id="phoneNumber" name="phoneNumber" placeholder="Phone Number" maxlength="10"><br>
            <input type="text" id="expertise" name="expertise" placeholder="Expertise"><br>

            <button type="submit" name="reg">Sign Up</button>
        </form>
	</div>

	<?php include 'footer.php';?>
</body>
</html>