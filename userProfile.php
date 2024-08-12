<?php
require ('db.php');
session_start();

$error = "";
$msg = "";

if (isset($_POST['UserProfile'])) {
    $age = $_POST['age'];
    $profession = $_POST['profession'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $workEnvironment = $_POST['workEnvironment'];
    $workType = $_POST['workType'];
    $sittingDuration = $_POST['sittingDuration'];
    $standingDuration = $_POST['standingDuration'];
    $painArea = $_POST['painArea'];
    $painIntensity = $_POST['painIntensity'];
    $caloriesIntake = $_POST['caloriesIntake'];
    $currentHealthConditions = $_POST['currentHealthConditions'];
    $userID = $_SESSION['UserID'];
    // Validate input
    if (empty($age) || empty($profession) || empty($height) || empty($weight) || empty($workEnvironment) || empty($workType) || empty($sittingDuration) || empty($standingDuration) || empty($painArea) || empty($painIntensity) || empty($caloriesIntake) || empty($currentHealthConditions)) {
        $error = "<p class='alert alert-warning'>Please fill all fields</p>";
    } else {
        // Check if profile already exists
        $profileQuery = "SELECT * FROM tblUserProfile WHERE UserID = '$userID'";
        $profileResult = mysqli_query($conn, $profileQuery);
        if (mysqli_num_rows($profileResult) > 0) {
            // Update existing profile
            $updateQuery = "UPDATE tblUserProfile SET
                    Age='$age',
                    Profession='$profession',
                    Height='$height',
                    Weight='$weight',
                    WorkEnvironment='$workEnvironment',
                    WorkType='$workType',
                    SittingDuration='$sittingDuration',
                    StandingDuration='$standingDuration',
                    PainArea='$painArea',
                    PainIntensity='$painIntensity',
                    CaloriesIntake='$caloriesIntake',
                    CurrentHealthConditions='$currentHealthConditions'
                    WHERE UserID='$userID'";

            if (mysqli_query($conn, $updateQuery)) {
                $_SESSION['PainArea'] = $painArea; // Save painArea to session
                echo "<script>window.location.href='userDashboard.php'</script>";
                exit();
            } else {
                $error = "<p class='alert alert-danger'>Error updating profile: " . mysqli_error($conn) . "</p>";
            }
        } else {
            // Insert new profile
            $insertQuery = "INSERT INTO tblUserProfile (
        Age, Profession, Height, Weight, WorkEnvironment, WorkType, SittingDuration, StandingDuration, PainArea, PainIntensity, CaloriesIntake, CurrentHealthConditions, UserID
    ) VALUES (
        '$age', '$profession', '$height', '$weight', '$workEnvironment', '$workType', '$sittingDuration', '$standingDuration', '$painArea', '$painIntensity', '$caloriesIntake', '$currentHealthConditions', '$userID'
    )";

            if (mysqli_query($conn, $insertQuery)) {
                $_SESSION['PainArea'] = $painArea; // Save painArea to session
                echo "<script>window.location.href='userDashboard.php'</script>";
                exit();
            } else {
                $error = "<p class='alert alert-danger'>Error creating profile: " . mysqli_error($conn) . "</p>";
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
    <title>User Profile SetUp</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href='https://fonts.googleapis.com/css?family=Kaisei Opti' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include 'header.php'; ?>
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
        <form class="userProfileForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST"
            id="userProfile_form">
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
                    <input type="text" id="height" name="height" placeholder="Height in CM">
                    <input type="text" id="weight" name="weight" placeholder="Weight in KG">
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

                    <input type="text" id="sittingDuration" name="sittingDuration" placeholder="Sitting Duration">
                    <input type="text" id="standingDuration" name="standingDuration" placeholder="Standing Duration">
                </div>

                <div class="form-section">
                    <h3>Health Info</h3>
                    <select id="painArea" name="painArea">
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
                    <textarea id="painDescription" name="painDescription" placeholder="Pain Description"></textarea>
                    <input type="text" id="painIntensity" name="painIntensity" placeholder="Pain Intensity">
                    <input type="text" id="caloriesIntake" name="caloriesIntake" placeholder="Calories Intake">
                    <input type="text" id="currentHealthConditions" name="currentHealthConditions"
                        placeholder="Current Health Condition">
                </div>

                <button type="submit" name="UserProfile">Submit</button>
            </div>
        </form>
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>