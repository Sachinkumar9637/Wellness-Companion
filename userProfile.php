<?php
require('db.php');
session_start();

$error = "";
$msg = "";

function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

function isAlphaSpace($data) {
    return preg_match('/^[a-zA-Z\s]+$/', $data);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['UserProfile'])) {
    // Sanitize and validate input
    $age = isset($_POST['age']) ? sanitizeInput($_POST['age']) : '';
    $profession = isset($_POST['profession']) ? sanitizeInput($_POST['profession']) : '';
    $height = isset($_POST['height']) ? sanitizeInput($_POST['height']) : '';
    $weight = isset($_POST['weight']) ? sanitizeInput($_POST['weight']) : '';
    $workEnvironment = isset($_POST['workEnvironment']) ? sanitizeInput($_POST['workEnvironment']) : '';
    $workType = isset($_POST['workType']) ? sanitizeInput($_POST['workType']) : '';
    $sittingDuration = isset($_POST['sittingDuration']) ? sanitizeInput($_POST['sittingDuration']) : '';
    $standingDuration = isset($_POST['standingDuration']) ? sanitizeInput($_POST['standingDuration']) : '';
    $painArea = isset($_POST['painArea']) ? sanitizeInput($_POST['painArea']) : '';
    $painDescription = isset($_POST['painDescription']) ? sanitizeInput($_POST['painDescription']) : '';
    $painIntensity = isset($_POST['painIntensity']) ? sanitizeInput($_POST['painIntensity']) : '';
    $caloriesIntake = isset($_POST['caloriesIntake']) ? sanitizeInput($_POST['caloriesIntake']) : '';
    $currentHealthConditions = isset($_POST['currentHealthConditions']) ? sanitizeInput($_POST['currentHealthConditions']) : '';
    $userID = $_SESSION['UserID'];

    // Validate input
    if (empty($age) || !is_numeric($age)) {
        $error .= "<p class='alert alert-warning'>Age must be a number and should not be empty.</p>";
    }
    if (empty($profession)) {
        $error .= "<p class='alert alert-warning'>Profession is required.</p>";
    }
    if (empty($height) || !is_numeric($height)) {
        $error .= "<p class='alert alert-warning'>Height must be a number and should not be empty.</p>";
    }
    if (empty($weight) || !is_numeric($weight)) {
        $error .= "<p class='alert alert-warning'>Weight must be a number and should not be empty.</p>";
    }
    if (empty($workEnvironment)) {
        $error .= "<p class='alert alert-warning'>Work Environment is required.</p>";
    }
    if (empty($workType)) {
        $error .= "<p class='alert alert-warning'>Work Type is required.</p>";
    }
    if (empty($sittingDuration) || !is_numeric($sittingDuration)) {
        $error .= "<p class='alert alert-warning'>Sitting Duration must be a number and should not be empty.</p>";
    }
    if (empty($standingDuration) || !is_numeric($standingDuration)) {
        $error .= "<p class='alert alert-warning'>Standing Duration must be a number and should not be empty.</p>";
    }
    if (empty($painArea)) {
        $error .= "<p class='alert alert-warning'>Pain Area is required.</p>";
    }
    if (empty($painDescription)) {
        $error .= "<p class='alert alert-warning'>Pain Description is required.</p>";
    }
    if (empty($painIntensity) || !isAlphaSpace($painIntensity)) {
        $error .= "<p class='alert alert-warning'>Pain Intensity must include only letters and should not be empty.</p>";
    }
    if (empty($caloriesIntake)) {
        $error .= "<p class='alert alert-warning'>Calories Intake is required.</p>";
    }
    if (empty($currentHealthConditions) || !isAlphaSpace($currentHealthConditions)) {
        $error .= "<p class='alert alert-warning'>Current Health Conditions must include only letters and should not be empty.</p>";
    }

    if (empty($error)) {
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
                    PainDescription='$painDescription',
                    PainIntensity='$painIntensity',
                    CaloriesIntake='$caloriesIntake',
                    CurrentHealthConditions='$currentHealthConditions'
                    WHERE UserID='$userID'";

            if (mysqli_query($conn, $updateQuery)) {
                $_SESSION['PainArea'] = $painArea;
                echo "<script>window.location.href='userDashboard.php'</script>";
                exit();
            } else {
                $error = "<p class='alert alert-danger'>Error updating profile: " . mysqli_error($conn) . "</p>";
            }
        } else {
            $insertQuery = "INSERT INTO tblUserProfile (
                Age, Profession, Height, Weight, WorkEnvironment, WorkType, SittingDuration, StandingDuration, PainArea, PainDescription, PainIntensity, CaloriesIntake, CurrentHealthConditions, UserID
            ) VALUES (
                '$age', '$profession', '$height', '$weight', '$workEnvironment', '$workType', '$sittingDuration', '$standingDuration', '$painArea', '$painDescription', '$painIntensity', '$caloriesIntake', '$currentHealthConditions', '$userID'
            )";

            if (mysqli_query($conn, $insertQuery)) {
                $_SESSION['PainArea'] = $painArea;
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
                    <input type="text" id="height" name="height" placeholder="Height in CM (Number Only)">
                    <input type="text" id="weight" name="weight" placeholder="Weight in KG (Number Only)">
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

                    <input type="text" id="sittingDuration" name="sittingDuration" placeholder="Sitting Duration Must be in Hour(Number only)">
                    <input type="text" id="standingDuration" name="standingDuration" placeholder="Standing Duration Must be in Hour(Number only)">
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