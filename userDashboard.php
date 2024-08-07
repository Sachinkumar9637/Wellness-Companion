<?php
include ('db.php');

if (!isset($_SESSION['Email'])) {
    echo "<script>window.location.href='login.php'</script>";
    exit();
}

$email = $_SESSION['Email'];
$userDetails = "SELECT * FROM tbluser WHERE Email='$email'";
$resultUser = mysqli_query($conn, $userDetails);
$user = mysqli_fetch_assoc($resultUser);

$UserID = $_SESSION['UserID'];
$sql = "SELECT * FROM tbluserProfile WHERE UserID='$UserID'";
$result = mysqli_query($conn, $sql);
$userData = mysqli_fetch_assoc($result);

$height = $userData["Height"];
$weight = $userData["Weight"];

//BMI API
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
        "x-rapidapi-key: 9ded8c28afmsh87e74b92c2e01abp1fcf4cjsn1a3869286822"
    ],
]);

$response_BMI = curl_exec($BMI_API);
$err = curl_error($BMI_API);
curl_close($BMI_API);

$bmi_text = "Not available"; // Default value

// if ($err) {
//     echo "cURL Error #:" . $err;
// } else {
//     $BMI = json_decode($response_BMI);
//     if (json_last_error() === JSON_ERROR_NONE && isset($BMI->BMI)) {
//         $bmi_value = $BMI->BMI;

//         // Generate dynamic description based on BMI value
//         if ($bmi_value < 18.5) {
//             $bmi_text = "<p class='fw-bold fs-3 text-danger text-center'>Underweight</p>
//                         <p class='text-center' style='font-weight: bold; font-size: 1.3rem; color: #2d3a5c;'>Your BMI indicates that you are underweight. To reach a healthier weight, consider increasing your calorie intake with nutritious foods, and incorporate strength training exercises to build muscle mass. Consulting with a healthcare provider for personalized advice is also recommended.</p>";
//         } elseif ($bmi_value >= 18.5 && $bmi_value < 24.9) {
//             $bmi_text = "<p class='fw-bold fs-3 text-success text-center'>Normal Weight</p>
//                         <p class='text-center' style='font-weight: bold; font-size: 1.3rem; color: #2d3a5c;'>Congratulations! Your BMI falls within the normal weight range. To maintain your current weight, continue with a balanced diet and regular exercise. Keep monitoring your health regularly to stay on track.</p>";
//         } elseif ($bmi_value >= 25 && $bmi_value < 29.9) {
//             $bmi_text = "<p class='fw-bold fs-3 text-warning text-center'>Overweight</p>
//                         <p class='text-center' style='font-weight: bold; font-size: 1.3rem; color: #2d3a5c;'>Your BMI indicates that you are overweight. To improve your BMI, consider adopting a healthier diet and increasing physical activity. Regular exercise and mindful eating can help you achieve a healthier weight. Consulting with a healthcare provider for a tailored plan might be beneficial.</p>";
//         } else {
//             $bmi_text = "<p class='fw-bold fs-3 text-danger text-center'>Obesity</p>
//                         <p class='text-center' style='font-weight: bold; font-size: 1.3rem; color: #2d3a5c;'>Your BMI indicates that you are in the obesity range. It is important to focus on a comprehensive lifestyle change, including a balanced diet and regular physical activity. Seeking guidance from a healthcare provider for a personalized weight management plan is highly recommended.</p>";
//         }
        
//     } else {
//         $bmi_text = "<p class='text-center text-danger'>Unable to fetch BMI data. Please try again later.</p>";
//     }
// }

// Handle booking appointment
if (isset($_POST['bookAppointment'])) {
    $BookingDate = $_POST['BookingDate'];
    $BookingTime = $_POST['BookingTime'];
    $ExpertID = $_POST['tblExpert_ExpertID'];

    $sql = "INSERT INTO tblbookings (BookingDate,BookingTime,tblExpert_ExpertID,tblUser_UserID) VALUES ('$BookingDate','$BookingTime','$ExpertID','$UserID')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>alert('Booking done successfully!');</script>";
    }
}

// Handle feedback submission
if (isset($_POST['submitFeedback'])) {
    if (!isset($_SESSION['UserID']) || !is_numeric($_SESSION['UserID'])) {
        echo "<script>alert('Invalid user session.');</script>";
        exit;
    }
    $UserID = $_SESSION['UserID'];

    $rating = trim($_POST['rating']);
    $comments = trim($_POST['comments']);

    if (empty($rating) || empty($comments)) {
        echo "<script>alert('Rating and comments cannot be empty.');</script>";
        exit;
    }

    $query = "UPDATE tbluser SET Rating = ?, Comments = ? WHERE UserID = ?";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("ssi", $rating, $comments, $UserID);

        if ($stmt->execute()) {
            echo "<script>alert('Feedback submitted successfully!');</script>";
        } else {
            echo "<script>alert('Error executing query: " . $stmt->error . "');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Error preparing statement: " . $conn->error . "');</script>";
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
    <?php include ('header.php'); ?>

    <!-- Main Content -->
    
        <div class="row">
            <div class="col-md-3 p-3">
                <h5 class="fw-bold">Welcome, <?= htmlspecialchars($user['FirstName']); ?>!</h5> <br>
                <h5 class="fw-bold">Upcoming Booking </h5>
                <?php
                $bookings = mysqli_query($conn, "SELECT * FROM tblbookings WHERE tblUser_UserID='$UserID'");

                while ($singleBooking = mysqli_fetch_array($bookings, MYSQLI_ASSOC)) {
                    $bookingDateTime = $singleBooking["BookingDate"] . " " . $singleBooking["BookingTime"];
                    $bookingDate = new DateTime($bookingDateTime);
                    $currentDate = new DateTime();

                    $interval = $currentDate->diff($bookingDate);
                    $daysRemaining = $interval->format('%a');
                    $hoursRemaining = $interval->format('%h');

                    if ($currentDate < $bookingDate) {
                        ?>
                        <p class="fw-bold fs-5"> Booking Date : <?php echo $singleBooking["BookingDate"]; ?> </p>
                        Booking Time : <?php echo $singleBooking["BookingTime"]; ?> <br>
                        <?php
                        echo " Days remaining: " . $daysRemaining . " Days and " . $hoursRemaining . " Hours<br>";
                    } else {
                        echo $singleBooking["BookingDate"] . " Booking Time: " . $singleBooking["BookingTime"];
                        echo " -This appointment has already passed.<br>";
                    }
                }
                ?>
            </div>
            <div class="col-md-9 p-3">
                <div class="container">
                    <h3 class="text-center fw-bold">Your BMI Index</h3>
                    <!-- Display BMI index and dynamic description -->
                    <p class="fw-bold fs-3 text-success text-center"><?php echo $bmi_value ?? "Not available"; ?></p>
                    <?php echo $bmi_text; ?>
                </div>
                <div class="container">
                    <h3 class="text-center fw-bold">Exercise Recommendations</h3>
                    <?php
                   // Exercise recommendations section
                    $painArea = strtolower($userData["PainArea"]); // Get the pain area from user data
                    $curl = curl_init(); // Initialize cURL session
                    
                    // Set cURL options
                    // curl_setopt_array($curl, [
                    //     CURLOPT_URL => "https://exercisedb.p.rapidapi.com/exercises/bodyPart/{$painArea}?", // API URL
                    //     CURLOPT_RETURNTRANSFER => true, // Return the response as a string
                    //     CURLOPT_ENCODING => "", // Handle any encoding
                    //     CURLOPT_MAXREDIRS => 10, // Maximum number of redirects
                    //     CURLOPT_TIMEOUT => 30, // Maximum time to wait for a response
                    //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, // Use HTTP/1.1
                    //     CURLOPT_CUSTOMREQUEST => "GET", // Use GET request
                    //     CURLOPT_HTTPHEADER => [
                    //         "x-rapidapi-host: exercisedb.p.rapidapi.com", // API host
                    //         "x-rapidapi-key: 9ded8c28afmsh87e74b92c2e01abp1fcf4cjsn1a3869286822" // API key
                    //     ],
                    // ]);

                    // $response = curl_exec($curl); // Execute the cURL request
                    // $err = curl_error($curl); // Get any error if occurred
                    // curl_close($curl); // Close cURL session
                    
                    // if ($err) {
                    //     // Display an error message if there's a cURL error
                    //     echo "<div class='alert alert-danger'>cURL Error #:" . $err . "</div>";
                    // } else {
                    //     // Decode the JSON response
                    //     $exercises = json_decode($response, true);
                    //     if (json_last_error() === JSON_ERROR_NONE) {
                    //         // Check if the JSON was decoded successfully
                    //         echo "<div class='exe-container'>";
                    //         foreach ($exercises as $exercise) {
                    //             echo "<div class='card'>";
                    //             echo "<img src='" . htmlspecialchars($exercise['gifUrl']) . "' class='card-img-top' alt='" . htmlspecialchars($exercise['name']) . " gif'>";
                    //             echo "<div class='card-body'>";
                    //             echo "<h5 class='card-title'>" . htmlspecialchars($exercise['name']) . "</h5>";
                    //             echo "<p class='card-text'><strong>Body Part:</strong> " . htmlspecialchars($exercise['bodyPart']) . "</p>";
                    //             echo "<p class='card-text'><strong>Equipment:</strong> " . htmlspecialchars($exercise['equipment']) . "</p>";
                    //             echo "<p class='card-text'><strong>Target:</strong> " . htmlspecialchars($exercise['target']) . "</p>";
                    //             if (isset($exercise['instructions']) && is_array($exercise['instructions'])) {
                    //                 echo "<p class='card-text'><strong>Instructions:</strong> ";
                    //                 foreach ($exercise['instructions'] as $value) {
                    //                     echo htmlspecialchars($value) . " ";
                    //                 }
                    //                 echo "</p>";
                    //             } else {
                    //                 echo "<p class='card-text'>No detailed instructions available.</p>";
                    //             }
                    //             echo "</div>";
                    //             echo "</div>";
                    //         }
                    //         echo "</div>";
                    //     } else {
                    //         // Display an error message if there's a JSON decoding error
                    //         echo "<div class='alert alert-danger'>Error decoding JSON response.</div>";
                    //     }
                    // }
                    // ?>

                </div>
                <div class="container">
                    <h3 class="text-center fw-bold">Book an Appointment</h3>
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
                        <button type="submit" id="bookAppointment" name="bookAppointment" class="btn btn-primary">Book
                            Appointment</button>
                    </form>
                </div>
                <div class="container mt-5">
                    <h3 class="text-center fw-bold">Submit Feedback</h3>
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating</label>
                            <select class="form-select" id="rating" name="rating" required>
                                <option value="" disabled selected>Choose a rating</option>
                                <option value="1">1 - Very Poor</option>
                                <option value="2">2 - Poor</option>
                                <option value="3">3 - Average</option>
                                <option value="4">4 - Good</option>
                                <option value="5">5 - Excellent</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="comments" class="form-label">Comments</label>
                            <textarea class="form-control" id="comments" name="comments" rows="4" required></textarea>
                        </div>
                        <button type="submit" id="submitFeedback" name="submitFeedback" class="btn btn-success">Submit
                            Feedback</button>
                    </form>
                </div>
            </div>
        </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>