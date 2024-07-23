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

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link href='https://fonts.googleapis.com/css?family=Kaisei+Opti' rel='stylesheet'>
    
</head>

<body>

    <!-- Header -->
    <?php
    include('header.php');
    ?>

    <!-- Main Content -->
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <aside class="col-md-3 bg-light p-4">
                <div class="welcome-section mb-4">
                    <h5>Welcome, <?= htmlspecialchars($user['FirstName']); ?>!</h5>
                </div>
                <div class="bmi-section mb-4">
                    <?php
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
                                echo "<h5>YOUR BODY MASS INDEX IS</h5>";
                                echo "<h3>" . htmlspecialchars($BMI->BMI) . "</h3>";
                            } else {
                                echo "BMI key not found in the response.";
                            }
                        } else {
                            echo "Error decoding JSON response.";
                        }
                    }
                    ?>
                </div>
                <h4>Dashboard</h4>
                <ul class="nav flex-column mb-4">
                    <li class="nav-item mb-3">
                        <a href="#exerciseRecommendations" class="nav-link">Exercise Recommendations</a>
                    </li>
                    <li class="nav-item mb-3">
                        <a href="#bookAppointment" class="nav-link">Book Appointment</a>
                    </li>
                    <li class="nav-item mb-3">
                        <a href="#setReminder" class="nav-link">Set Reminder</a>
                    </li>
                </ul>
            </aside>

            <!-- Main content area -->
            <main class="col-md-9">
                <!-- Exercise Recommendations Section -->
                <section id="exerciseRecommendations" class="exercise-section mb-4">
                    <h2>Exercise Recommendations</h2>
                    <div class="row mt-4">
                        <?php
                        $painArea = strtolower($userData["PainArea"]);
                       // Exercise API
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
                                foreach ($exercises as $exercise) {
                                    echo "<div class='col-md-4 mb-4'>";
                                    echo "<div class='card h-100'>";
                                    echo "<img src='" . htmlspecialchars($exercise['gifUrl']) . "' class='card-img-top' alt='" . htmlspecialchars($exercise['name']) . " gif'>";
                                    echo "<div class='card-body'>";
                                    echo "<h5 class='card-title'>" . htmlspecialchars($exercise['name']) . "</h5>";
                                    echo "<p class='card-text'><strong>Body Part:</strong> " . htmlspecialchars($exercise['bodyPart']) . "</p>";
                                    echo "<p class='card-text'><strong>Equipment:</strong> " . htmlspecialchars($exercise['equipment']) . "</p>";
                                    echo "<p class='card-text'><strong>Target:</strong> " . htmlspecialchars($exercise['target']) . "</p>";
                                    if (isset($exercise['instructions']) && is_array($exercise['instructions'])) {
                                        echo "<p class='card-text'><strong>Instructions:</strong></p>";
                                        echo "<ul class='list-group list-group-flush'>";
                                        foreach ($exercise['instructions'] as $value) {
                                            echo "<li class='list-group-item'>" . htmlspecialchars($value) . "</li>";
                                        }
                                        echo "</ul>";
                                    } else {
                                        echo "<p class='card-text'>No detailed instructions available.</p>";
                                    }
                                    echo "</div>";
                                    echo "</div>";
                                    echo "</div>";
                                }
                            } else {
                                echo "<div class='alert alert-danger'>Error decoding JSON response.</div>";
                            }
                        }
                        ?>
                    </div>
                </section>

                <!-- Book Appointment Section -->
                <section id="bookAppointment" class="appointment-section mb-4">
                    <h2>Book an Appointment</h2>
                    <form action="book_appointment.php" method="POST">
                        <div class="mb-3">
                            <label for="appointmentDate" class="form-label">Date</label>
                            <input type="date" class="form-control" id="appointmentDate" name="appointmentDate" required>
                        </div>
                        <div class="mb-3">
                            <label for="appointmentTime" class="form-label">Time</label>
                            <input type="time" class="form-control" id="appointmentTime" name="appointmentTime" required>
                        </div>
                        <div class="mb-3">
                            <label for="expert" class="form-label">Select Expert</label>
                            <select class="form-select" id="expert" name="expert" required>
                                <option value="" disabled selected>Select an expert</option>
                                <!-- Options for experts will be inserted here -->
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Book Appointment</button>
                    </form>
                </section>

                <!-- Set Reminder Section -->
                <section id="setReminder" class="reminder-section mb-4">
                    <h2>Set a Reminder</h2>
                    <form action="set_reminder.php" method="POST">
                        <div class="mb-3">
                            <label for="reminderDate" class="form-label">Date</label>
                            <input type="date" class="form-control" id="reminderDate" name="reminderDate" required>
                        </div>
                        <div class="mb-3">
                            <label for="reminderTime" class="form-label">Time</label>
                            <input type="time" class="form-control" id="reminderTime" name="reminderTime" required>
                        </div>
                        <div class="mb-3">
                            <label for="reminderMessage" class="form-label">Message</label>
                            <textarea class="form-control" id="reminderMessage" name="reminderMessage" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Set Reminder</button>
                    </form>
                </section>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
