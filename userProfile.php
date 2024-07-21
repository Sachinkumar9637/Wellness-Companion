<?php
    session_start();
    require('db.php');

    $error = "";
    $msg = "";

    if (isset($_POST['UserProfile'])) {
        $Age = isset($_POST['age']) ? $_POST['age'] : '';
        $Profession = isset($_POST['profession']) ? $_POST['profession'] : '';
        $Height = isset($_POST['height']) ? $_POST['height'] : '';
        $Weight = isset($_POST['weight']) ? $_POST['weight'] : '';
        
        $WorkEnvironment = isset($_POST['workEnvironment']) ? $_POST['workEnvironment'] : '';
        $WorkType = isset($_POST['workType']) ? $_POST['workType'] : '';
        $SittingDuration = isset($_POST['sitting-duration']) ? $_POST['sitting-duration'] : '';
        $StandingDuration = isset($_POST['standing-duration']) ? $_POST['standing-duration'] : '';

        $PainArea = isset($_POST['pain-areas']) ? $_POST['pain-areas'] : '';
        $PainDescription = isset($_POST['pain-description']) ? $_POST['pain-description'] : '';
        $PainIntensity = isset($_POST['pain-intensity']) ? $_POST['pain-intensity'] : '';
        $CaloriesIntake = isset($_POST['calories-intake']) ? $_POST['calories-intake'] : '';
        $CurrentHealthConditions = isset($_POST['current-health-conditions']) ? $_POST['current-health-conditions'] : '';

        // Retrieve the user ID from the session
        $userID=$_SESSION['UserID'];

        // Debugging output
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
        echo "<pre>";
        print_r($_SESSION);
        echo "</pre>";

        if (!empty($Age) && !empty($Profession) && !empty($Height) && !empty($Weight) && !empty($WorkEnvironment) && 
            !empty($WorkType) && !empty($SittingDuration) && !empty($StandingDuration) && !empty($PainArea) && 
            !empty($PainDescription) && !empty($PainIntensity) && !empty($CaloriesIntake) && !empty($CurrentHealthConditions) &&
            !empty($userID))
        {
            $sql = "INSERT INTO tblUserProfile (Age, Profession, Height, Weight, WorkEnvironment, WorkType, SittingDuration,
            StandingDuration, PainArea, PainDescription, PainIntensity, CaloriesIntake, CurrentHealthConditions, tblUser_UserID) 
            VALUES ('$Age','$Profession','$Height','$Weight','$WorkEnvironment','$WorkType','$SittingDuration',
            '$StandingDuration','$PainArea','$PainDescription','$PainIntensity','$CaloriesIntake','$CurrentHealthConditions', '$userID')";

            $result = mysqli_query($conn, $sql);

            if ($result) {
                $msg = "<p class='alert alert-success'>User Profile SetUp Successful.</p> ";
            } else {
                $error = "<p class='alert alert-warning'>Cannot Setup Profile, Check your details.</p> ";
            }
        } else {
            $error = "<p class='alert alert-warning'>Please Fill all the fields</p>";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Profile SetUp</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href='https://fonts.googleapis.com/css?family=Kaisei Opti' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'header.php';?>
    <div class="usrprofile">
        <h1>How CureCorner Works</h1>
    </div>

    <div class="usrprofile-container">
        <div>
            <img src="Images/Signup1.png">
            <div class="usrprofile-text">
                <h3>Spinal Decompression</h3>
                <p>It is a long established fact that each will be distracted by the readable</p>
            </div>
        </div>
        <div>
            <img src="Images/Signup4.png">
            <div class="usrprofile-text">
                <h3>Accupuncture Treatment</h3>
                <p>It is a long established fact that each will be distracted by the readable</p>
            </div>
        </div>
        <div>
            <img src="Images/Signup3.png">
            <div class="usrprofile-text">
                <h3>Fitness Treatment</h3>
                <p>It is a long established fact that each will be distracted by the readable</p>
            </div>
        </div>
    </div>

    <div class="userProfile">
        <form class="userProfileForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" id="userProfile_form">
            <h1>Enter your details</h1>

            <div class="row">
                <?php echo $error; ?><?php echo $msg; ?>

                <div class="form-section">
                    <h3>Basic Info</h3>
                    <input type="text" id="age" name="age" placeholder="Age">
                    <select id="profession" name="profession">
                        <option value="" disabled selected>Enter Your Profession</option>
                        <option value="Software Developer">Software Developer</option>
                        <option value="Doctor">Doctor</option>
                        <option value="Teacher">Teacher</option>
                        <option value="Engineer">Engineer</option>
                        <option value="Nurse">Nurse</option>
                        <option value="Architect">Architect</option>
                        <option value="Accountant">Accountant</option>
                        <option value="Designer">Designer</option>
                        <option value="Sales Manager">Sales Manager</option>
                        <option value="Marketing Specialist">Marketing Specialist</option>
                    </select>
                    <input type="text" id="height" name="height" placeholder="Height">
                    <input type="text" id="weight" name="weight" placeholder="Weight">
                </div>

                <div class="form-section">
                    <h3>Work Info</h3>

                    <select id="workEnvironment" name="workEnvironment">
                        <option value="" disabled selected>Work Environment</option>
                        <option value="Office">Office</option>
                        <option value="Remote">Remote</option>
                        <option value="Hybrid">Hybrid</option>
                        <option value="On-site">On-site</option>
                        <option value="Fieldwork">Fieldwork</option>
                        <option value="Laboratory">Laboratory</option>
                        <option value="Warehouse">Warehouse</option>
                        <option value="Retail">Retail</option>
                    </select>

                    <select id="workType" name="workType">
                        <option value="" disabled selected>Work Type</option>
                        <option value="Full-time">Full-time</option>
                        <option value="Part-time">Part-time</option>
                        <option value="Contract">Contract</option>
                        <option value="Internship">Internship</option>
                        <option value="Freelance">Freelance</option>
                        <option value="Temporary">Temporary</option>
                        <option value="Volunteer">Volunteer</option>
                    </select>

                    <input type="text" id="sitting-duration" name="sitting-duration" placeholder="Sitting Duration">
                    <input type="text" id="standing-duration" name="standing-duration" placeholder="Standing Duration">
                </div>

                <div class="form-section">
                    <h3>Health Info</h3>
                    <select id="pain-areas" name="pain-areas">
                        <option value="" disabled selected>Pain Areas</option>
                        <option value="Back">Back</option>
                        <option value="Cardio">Cardio</option>
                        <option value="Chest">Chest</option>
                        <option value="Lower Arms">Lower Arms</option>
                        <option value="Lower Legs">Lower Legs</option>
                        <option value="Neck">Neck</option>
                        <option value="Shoulders">Shoulders</option>
                        <option value="Upper Arms">Upper Arms</option>
                        <option value="Upper Legs">Upper Legs</option>
                        <option value="Waist">Waist</option>
                    </select>
                    <textarea id="pain-description" name="pain-description" placeholder="Pain Description"></textarea>
                    <input type="text" id="pain-intensity" name="pain-intensity" placeholder="Pain Intensity">   
                    <input type="text" id="calories-intake" name="calories-intake" placeholder="Calories Intake">
                    <input type="text" id="current-health-conditions" name="current-health-conditions" placeholder="Current Health Condition">
                </div>
                
                <button type="submit" name="UserProfile">Submit</button>
            </div>
        </form>
    </div>

    <?php include 'footer.php';?>
</body>
</html>
