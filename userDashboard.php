<?php
session_start();
include('db.php');
if (!isset($_SESSION['Email'])) {
    echo "<script>window.location.href='login.php'</script>";
    exit();
}

$email = $_SESSION['Email'];
$userDetails = "SELECT * FROM tblUser WHERE Email='$email'";
$resultUser = mysqli_query($conn, $userDetails);
$user = mysqli_fetch_assoc($resultUser);

$UserID = $_SESSION['UserID'];
$sql = "SELECT * FROM tblUserProfile WHERE UserID='$UserID'";
$result = mysqli_query($conn, $sql);
$userData = mysqli_fetch_assoc($result);

$height = $userData["Height"];
$weight = $userData["Weight"];

//  BMI API
$BMI_API = curl_init();
curl_setopt_array($BMI_API, [
    CURLOPT_URL => "https://bmi-calculator9.p.rapidapi.com/BMI_Calculator?cm={$height}&kg={$weight}",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
        "x-rapidapi-host: bmi-calculator9.p.rapidapi.com",
        "x-rapidapi-key: b103933fd5mshb5ad0dd6f00ffffp1a221djsn195bc0a40141"
    ],
]);

$response_BMI = curl_exec($BMI_API);
$err = curl_error($BMI_API);
curl_close($BMI_API);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    // Decode the JSON response
    $BMI = json_decode($response_BMI);

    // Check if the JSON was decoded successfully
    if (json_last_error() === JSON_ERROR_NONE) {
        // Check if the 'BMI' key exists and print it
        if (isset($BMI->BMI)) {
           $bmi_text=htmlspecialchars($BMI->BMI);
        
        } else {
            echo "BMI key not found in the response.";
        }
    } else {
        echo "Error decoding JSON response.";
    }
}
                    
                    

if (isset($_POST['bookAppointment'])) {
    $BookingDate = $_POST['BookingDate'];
    $BookingTime = $_POST['BookingTime'];
    $ExpertID = $_POST['tblExpert_ExpertID'];

    $sql="INSERT INTO tblbookings (BookingDate,BookingTime,tblExpert_ExpertID,tblUser_UserID) VALUES ('$BookingDate','$BookingTime','$ExpertID','$UserID')";
	$result=mysqli_query($conn, $sql);

	 if($result){

        echo "<script>alert('Booking done successfully!');</script>";
     }

}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="userDashboard.css">
    <link href='https://fonts.googleapis.com/css?family=Kaisei+Opti' rel='stylesheet'>

    
</head>

<body>

    <!-- Header -->
    <?php
    include('header.php');
    ?>

    <!-- Main Content -->
    <div class="">
        <div class="row">
        <div class="col-md-3 p-3 ">
        <h5 class="fw-bold">Welcome, <?= htmlspecialchars($user['FirstName']); ?>!</h5> <br>
        <h5 class="fw-bold">Upcoming Booking </h5>
        <?php
                $bookings = mysqli_query($conn, "SELECT * FROM tblbookings WHERE tblUser_UserID='$UserID'");

                while ($singleBooking = mysqli_fetch_array($bookings, MYSQLI_ASSOC)) {
                    $bookingDateTime = $singleBooking["BookingDate"] . " " . $singleBooking["BookingTime"];
                    $bookingDate = new DateTime($bookingDateTime);
                    $currentDate = new DateTime();

                    // Calculate the interval
                    $interval = $currentDate->diff($bookingDate);

                    // Get the remaining time as days and hours
                    $daysRemaining = $interval->format('%a'); // Total days remaining
                    $hoursRemaining = $interval->format('%h'); // Hours remaining
                
                    // Check if the booking date is in the future
                    if ($currentDate < $bookingDate) {
                        ?>
                        <p class="fw-bold fs-5"> Booking Date  :  <?php echo $singleBooking["BookingDate"]; ?>  </p>
                        Booking Time :  <?php echo $singleBooking["BookingTime"]; ?> <br>
                        <?php
                        echo " Days remaining: " . $daysRemaining . " Days and " . $hoursRemaining . " Hours<br>";
                    } else {
                        echo $singleBooking["BookingDate"] . " Booking Time: " . $singleBooking["BookingTime"];
                        echo " -This appointment has already passed.<br>";
                    }
                }
                ?>
            </div>
            <div class="col-md-9 p-3 ">
                <div class="container">
                    <h3 class="text-center fw-bold">Your BMI Index</h3>
                    <p class="fw-bold fs-3 text-success text-center"><?php echo $bmi_text; ?></p> 
                    <p>Description</p>
                </div>
                <div class="container">
                    <h3 class="text-center fw-bold">Exercise Recommendations</h3>

                    <?php 
                         $painArea = strtolower($userData["PainArea"]);
                        $curl = curl_init();
                        curl_setopt_array($curl, [
                          CURLOPT_URL => "https://exercisedb.p.rapidapi.com/exercises/bodyPart/{$painArea}?",
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => "",
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 30,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => "GET",
                            CURLOPT_HTTPHEADER => [
                                "x-rapidapi-host: exercisedb.p.rapidapi.com",
                                "x-rapidapi-key: b103933fd5mshb5ad0dd6f00ffffp1a221djsn195bc0a40141"
                            ],
                        ]);

                        $response = curl_exec($curl);
                        $err = curl_error($curl);
                        curl_close($curl);

                        if ($err) {
                            echo "<div class='alert alert-danger'>cURL Error #:" . $err . "</div>";
                        } else {
                            $exercises = json_decode($response, true);
                            if (json_last_error() === JSON_ERROR_NONE) {
                                
                                echo "<div class='exe-container'>";
                                foreach ($exercises as $exercise) {
                                echo "<div class='m-2'>";
                                echo "<div class='card  m-2'>";
                                echo "<img src='" . htmlspecialchars($exercise['gifUrl']) . "' class='card-img-top' alt='" . htmlspecialchars($exercise['name']) . " gif'>";
                                echo "<div class='card-body'>";
                                echo "<h5 class='card-title'>" . htmlspecialchars($exercise['name']) . "</h5>";
                                echo "<p class='card-text'><strong>Body Part:</strong> " . htmlspecialchars($exercise['bodyPart']) . "</p>";
                                echo "<p class='card-text'><strong>Equipment:</strong> " . htmlspecialchars($exercise['equipment']) . "</p>";
                                echo "<p class='card-text'><strong>Target:</strong> " . htmlspecialchars($exercise['target']) . "</p>";
                                if (isset($exercise['instructions']) && is_array($exercise['instructions'])) {
                                    echo "<p class='card-text'><strong>Instructions:</strong> ";
                                    foreach ($exercise['instructions'] as $value) {
                                        echo htmlspecialchars($value) . " ";
                                    }
                                    echo "</p>";
                                } else {
                                    echo "<p class='card-text'>No detailed instructions available.</p>";
                                }
                                
                                echo "</div>";
                                echo "</div>";
                                echo "</div>";
                                }
                                echo "</div>";
                                
                            } else {
                                echo "<div class='alert alert-danger'>Error decoding JSON response.</div>";
                            }
                            
                        } 
                        ?>
                    
                </div>
                <div class="container">
                    <h3 class="text-center fw-bold">Your BMI Index</h3>
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                        <div class="mb-3">
                            <label for="BookingDate" class="form-label">Date</label>
                            <input type="date" class="form-control" id="BookingDate" name="BookingDate" required>
                        </div>
                        <div class="mb-3">
                            <label for="BookingTime" class="form-label">Time</label>
                            <input type="time" class="form-control" id="BookingTime" name="BookingTime" required>
                        </div>
                        <div class="mb-3">
                            <label for="tblExpert_ExpertID" class="form-label">Select Expert</label>
                            <select class="form-select" id="tblExpert_ExpertID" name="tblExpert_ExpertID" required>
                                <option value="" disabled selected>Select an expert</option>
                                <?php

                                $expert = mysqli_query($conn, "SELECT * FROM tblexpert");

                                while ($singleExpert = mysqli_fetch_array($expert, MYSQLI_ASSOC)) {
                                    ?>
                                    <option value="<?php echo $singleExpert["ExpertID"]; ?>">
                                        <?php echo $singleExpert["FirstName"] . " " . $singleExpert["LastName"]; ?>
                                    </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <button type="submit" id="bookAppointment" name="bookAppointment" class="btn btn-primary">Book Appointment</button>
                    </form>
                </div>
            </div>
        </div>
    
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
