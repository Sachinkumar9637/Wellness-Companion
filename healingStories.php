<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healing Stories</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Arsenal:wght@400;700&display=swap">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Arsenal', sans-serif;
            font-size: 1.1rem;
            /* Increase font size */
        }

        header *,
        footer * {
            font-family: inherit !important;
            font-size: initial !important;
            /* Keep default font size */
        }

        .banner {
            position: relative;
            text-align: center;
            color: white;
            overflow: hidden;
            /* Ensure content does not overflow */
        }

        .banner img {
            width: 100%;
            height: auto;
            /* Maintain aspect ratio */
            max-height: 800px;
            object-fit: cover;
            opacity: 0.8;
            /* Scale the image to fit within the container */
        }

        .banner-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #2d3a5c;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .full-width-image {
            width: 100%;
            height: auto;
            /* Adjusts height to maintain aspect ratio */
            display: block;
            /* Removes extra space below the image */
        }

        .stories-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1rem;
            /* Space between cards */
            padding: 1rem;
        }

        .story-card {
            background-color: #fff;
            border: 2px solid #2d3a5c;
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }

        .story-card h2 {
            font-size: 1.5rem;
            color: navy;
            font-weight: bolder;

        }

        .story-card p {
            height: 100px;
            overflow: hidden;
        }

        .story-card footer {
            color: #777;
            font-size: 14px;
            margin-top: 10px;
        }

        .rating {
            color: #ffc107;
            font-size: 18px;
        }

        .faq-section {
            margin-top: 50px;
            margin-bottom: 50px;
        }

        .faq-section h2 {
            color: #2d3a5c;
            margin-bottom: 20px;
        }

        .faq-section .card-header {
            background-color: #f8f9fa;
            cursor: pointer;
        }

        .faq-section .card-header:hover {
            background-color: #e2e6ea;
        }

        .card-columns {
            column-count: 1;
        }

        @media (min-width: 576px) {
            .card-columns {
                column-count: 2;
            }
        }

        @media (min-width: 768px) {
            .card-columns {
                column-count: 3;
            }
        }

        .card {
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="banner">
        <img src="Images/banner.jpg" class="full-width-image" alt="Healthy and Happy client stories">
        <h1>
            <div class="banner-text">"From Challenges to Triumphs: Read Our Success Stories"</div>
        </h1>
    </div>
    <?php
    include ('db.php');
    $query = "SELECT UserID, FirstName, LastName, Comments, Rating FROM tblUser WHERE Comments IS NOT NULL AND Comments != ''";
    $result = mysqli_query($conn, $query);
    ?>
    <!-- Healing Stories Section -->
    <div class="container my-5">
        <h2 class="text-center" style="color: #2d3a5c; font-weight:bolder">Healing Stories</h2>
        <div class="stories-container">
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="card story-card">
                    <div class="card-body">
                        <h2><?php echo htmlspecialchars($row['FirstName']) . ' ' . htmlspecialchars($row['LastName']); ?>
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
                            <p><?php echo htmlspecialchars(substr($row['Comments'], 0, 200)); ?>...</p>
                        </blockquote>
                        <button class="btn btn-link read-more" data-toggle="modal"
                            data-target="#storyModal<?php echo $row['UserID']; ?>">Read more</button>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="storyModal<?php echo $row['UserID']; ?>" tabindex="-1" role="dialog"
                    aria-labelledby="storyModalLabel<?php echo $row['UserID']; ?>" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 class="modal-title" id="storyModalLabel<?php echo $row['UserID']; ?>">
                                    <?php echo htmlspecialchars($row['FirstName']) . ' ' . htmlspecialchars($row['LastName']); ?>
                                </h2>
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
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne"
                            aria-expanded="true" aria-controls="collapseOne">
                            How does the program work?
                        </button>
                    </h5>
                </div>
                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#faqAccordion">
                    <div class="card-body">
                        Our program works by connecting you with expert physiotherapists who will guide you through
                        personalized exercises and treatments tailored to your specific needs.
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingTwo">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            What do I need for my first assessment/demo session?
                        </button>
                    </h5>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#faqAccordion">
                    <div class="card-body">
                        For your first assessment/demo session, you will need a stable internet connection, a device
                        with a camera, and comfortable clothing to perform exercises.
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingThree">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            How experienced are the Doctors?
                        </button>
                    </h5>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#faqAccordion">
                    <div class="card-body">
                        Our doctors and physiotherapists are highly experienced with extensive backgrounds in treating
                        various physical ailments and conditions.
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingFour">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
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
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            Is online Physiotherapy effective?
                        </button>
                    </h5>
                </div>
                <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#faqAccordion">
                    <div class="card-body">
                        Yes, online physiotherapy has been proven to be effective in managing and treating a variety of
                        physical conditions.
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