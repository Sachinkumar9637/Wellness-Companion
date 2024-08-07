<?php
session_start();
include ("db.php");

if (!isset($_SESSION['userType']) || $_SESSION['userType'] !== 'expert') {
    header("Location: login.php");
    exit();
}

$expertEmail = $_SESSION['Email'];

$expertQuery = "SELECT * FROM tblExpert WHERE Email='$expertEmail'";
$expertResult = mysqli_query($conn, $expertQuery);

if ($expertRow = mysqli_fetch_array($expertResult)) {
    $expertName = $expertRow['FirstName'] . ' ' . $expertRow['LastName'];
    $expertID = $expertRow['ExpertID']; 
    $expertise = $expertRow['Expertise'];
} else {
    echo "<p class='alert alert-warning'>Expert not found!</p>";
    exit();
}

$bookingQuery = "
    SELECT b.BookingDate, b.BookingTime, b.BookingType, b.BookingStatus, u.FirstName AS UserFirstName, u.LastName AS UserLastName
    FROM tblBookings b
    JOIN tblUser u ON b.tblUser_UserID = u.UserID
    WHERE b.tblExpert_ExpertID = '$expertID'
";
$bookingResult = mysqli_query($conn, $bookingQuery);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Expert Dashboard</title>
    <link rel="stylesheet" type="text/css" href="indexcontactuspagestyle.css?v=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arsenal:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="textStyling">
    <header class="headerClass">
        <div class="headerContainer">
            <div class="logo">
                <a href="index.php">
                    <img src="Images/Headerlogo.jpg" alt="Technical Error! Logo image">
                </a>
            </div>
            <a href="logout.php" class="login-btn">Logout</a>
        </div>
    </header>
    <main>
        <section class="banner">
            <div class="banner-content">
                <h1 style="margin-top: 100px;">Expert Dashboard</h1>
            </div>
        </section>
        <div class="dashboard-container">
            <h1><?php echo htmlspecialchars($expertName); ?></h1>
            <p class="ex_color"><?php echo htmlspecialchars($expertise); ?></p>

            <div class="appointment_tag">
                <i class="fas fa-user"></i>
                <h2 class="my_appointment">My Appointments</h2>
                <p class="line"></p>
            </div>
            <?php if (mysqli_num_rows($bookingResult) > 0): ?>
                <div class="appointments">
                    <?php while ($bookingRow = mysqli_fetch_array($bookingResult)): ?>
                        <div class="appointment">
                            <p class="userName"><?php echo htmlspecialchars($bookingRow['UserFirstName']); ?></p>
                            <p class="timeDate"> <i class="fas fa-clock"></i> Time:
                                <?php echo htmlspecialchars($bookingRow['BookingTime']); ?> | Date:
                                <?php echo htmlspecialchars($bookingRow['BookingDate']); ?>
                            </p>
                            <div class="appointment-details">
                                <div>
                                    <p class="c_grey">Appointment Type:</p>
                                    <p class="appointmentType"><?php echo htmlspecialchars($bookingRow['BookingType']); ?></p>
                                </div>
                                <div>
                                    <p class="c_grey">Status:</p>
                                    <p class="status <?php echo htmlspecialchars($bookingRow['BookingStatus']); ?>">
                                        <?php echo htmlspecialchars($bookingRow['BookingStatus']); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <p>No bookings found.</p>
            <?php endif; ?>
        </div>

    </main>
    <?php include 'footer.php'; ?>
</body>

</html>