<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healing Stories</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Arsenal:wght@400;700&display=swap">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="healingStories.css">
</head>

<body>
    <?php require ('header.php'); ?>

    <div class="banner">
        <img src="Images/banner.jpg" class="full-width-image" alt="Healthy and Happy client stories">
        <h1 class="banner-text">"From Challenges to Triumphs: Read Our Success Stories"</h1>
    </div>

    <?php
    // Fetch data from the database
    $query = "SELECT UserID, FirstName, LastName, Comments, Rating FROM tblUser WHERE Comments IS NOT NULL AND Comments != ''";
    $result = mysqli_query($conn, $query);
    ?>

    <!-- Healing Stories Section -->
    <div class="container my-5">
        <h2 class="text-center" style="color: #2d3a5c; font-weight:bolder">Healing Stories</h2>
        <div class="stories-container">
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="story-card">
                    <div class="card-body">
                        <h2 class="card-title">
                            <?php echo htmlspecialchars($row['FirstName']) . ' ' . htmlspecialchars($row['LastName']); ?>
                        </h2>
                        <div class="rating">
                            <?php
                            $rating = intval($row['Rating']);
                            for ($i = 0; $i < 5; $i++) {
                                if ($i < $rating) {
                                    echo "&#9733;"; // filled star
                                } else {
                                    echo "&#9734;"; // empty star
                                }
                            }
                            ?>
                        </div>
                        <blockquote class="blockquote mt-3">
                            <p class="card-text"><?php echo htmlspecialchars(substr($row['Comments'], 0, 200)); ?>...</p>
                        </blockquote>
                        <button class="btn btn-link read-more" data-toggle="modal" data-target="#storyModal<?php echo $row['UserID']; ?>">Read more</button>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="storyModal<?php echo $row['UserID']; ?>" tabindex="-1" role="dialog" aria-labelledby="storyModalLabel<?php echo $row['UserID']; ?>" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="storyModalLabel<?php echo $row['UserID']; ?>">
                                    <?php echo htmlspecialchars($row['FirstName']) . ' ' . htmlspecialchars($row['LastName']); ?>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <blockquote class="blockquote mb-0">
                                    <p><?php echo htmlspecialchars($row['Comments']); ?></p>
                                </blockquote>
                                <div class="rating mt-3">
                                    <?php
                                    for ($i = 0; $i < 5; $i++) {
                                        if ($i < $rating) {
                                            echo "&#9733;"; // filled star
                                        } else {
                                            echo "&#9734;"; // empty star
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="container faq-section">
        <h2 class="text-center" style="color: #2d3a5c; font-weight:bolder">Frequently Asked Questions</h2>
        <div class="accordion" id="faqAccordion">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            How does the program work?
                        </button>
                    </h5>
                </div>
                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#faqAccordion">
                    <div class="card-body">
                        Our program works by connecting you with expert physiotherapists who will guide you through personalized exercises and treatments tailored to your specific needs.
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingTwo">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            What do I need for my first assessment/demo session?
                        </button>
                    </h5>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#faqAccordion">
                    <div class="card-body">
                        For your first assessment/demo session, you will need a stable internet connection, a device with a camera, and comfortable clothing to perform exercises.
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingThree">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            How experienced are the Doctors?
                        </button>
                    </h5>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#faqAccordion">
                    <div class="card-body">
                        Our doctors and physiotherapists are highly experienced with extensive backgrounds in treating various physical ailments and conditions.
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingFour">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            Can treatment be provided at my home?
                        </button>
                    </h5>
                </div>
                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#faqAccordion">
                    <div class="card-body">
                        Yes, we offer online physiotherapy sessions that can be conducted in the comfort of your home.
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingFive">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            Is online Physiotherapy effective?
                        </button>
                    </h5>
                </div>
                <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#faqAccordion">
                    <div class="card-body">
                        Yes, online physiotherapy has been proven to be effective in managing and treating a variety of physical conditions.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
