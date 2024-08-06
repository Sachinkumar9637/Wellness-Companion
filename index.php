<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home Page</title>
    <link rel="stylesheet" href="indexcontactuspagestyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arsenal:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
</head>

<body>
    <?php require 'header.php'; ?>

    <main>
        <section class="banner">
            <div class="banner-content">
                <h1>Your Health, Our Priority</h1>
                <p>We provide you exercise tips based on your conditions</p>
                <a href="services.php" class="btn-services">Our Services</a>
            </div>
        </section>

        <section class="our-services-section">
            <div class="service">
                <div class="icon-container">
                    <i class="fa-solid fa-stethoscope"></i>
                    <span class="icon-number">01</span>
                </div>
                <h3>Expert Consultation</h3>
                <p>Professional Consultation with the experts optimize your fitness journey, ensuring personalized
                    strategies for achieving your health and wellness goals effectively.</p>
            </div>
            <div class="service">
                <div class="icon-container">
                    <i class="fa-solid fa-user-md"></i>
                    <span class="icon-number">02</span>
                </div>
                <h3>Expert Service</h3>
                <p>Round-the-clock availability for comprehensive care, ensuring support whenever you need it to
                    maintain peak performance and recover from injuries efficiently.</p>
            </div>
            <div class="service">
                <div class="icon-container">
                    <i class="fa-solid fa-file-alt"></i>
                    <span class="icon-number">03</span>
                </div>
                <h3>Personalized Reports</h3>
                <p>Customized reports tailored to your progress, offering detailed insights and recommendations to
                    enhance your fitness regimen or recovery journey effectively.</p>
            </div>
        </section>

        <section class="about-us">
            <div class="about-content">
                <div class="about-image">
                    <img src="Images/about-us.webp" alt="About Us Image">
                </div>
                <div class="about-text">
                    <p class="about-text-p">-- About Us</p>
                    <h2>What Cure Corner Offers</h2>
                    <p>Start your journey towards a healthier, more balanced life today. Whether you're looking to
                        alleviate pain, prevent health issues, or simply improve your overall wellness, Cure Corner is
                        here to support you every step of the way.</p>
                    <ul>
                        <li>Personalized Exercise Plans</li>
                        <li>Online Consultations</li>
                        <li>Progress Tracking</li>
                    </ul>
                    <a href="contactus.php" class="btn-contact">Contact Us</a>
                    <div class="thumbnail-container">
                        <img src="images/about-thumb-nail.webp" alt="Thumbnail Image">
                    </div>
                </div>
            </div>
        </section>

        <section class="why-choose-us hidden" id="why-choose-us">
            <p class="text-p">-- Why Choose Us</p>
            <h2>Why Choose Cure Corner</h2>
            <div class="features">
                <div class="feature">
                    <i class="fa-solid fa-hand-holding-heart"></i>
                    <h3>Health Assessments</h3>
                    <p>Comprehensive health assessments provide detailed insights into your current health status,
                        guiding personalized plans for improving wellness, fitness, and overall quality of life.</p>
                </div>
                <div class="feature">
                    <i class="fa-solid fa-person-running"></i>
                    <h3>Therapy Goals</h3>
                    <p>Establish clear therapy goals to address specific health concerns, optimize recovery, improve
                        mobility, and enhance overall well-being through personalized treatment plans and expert
                        guidance.</p>
                </div>
                <div class="feature">
                    <i class="fa-solid fa-user-nurse"></i>
                    <h3>Experienced Staff</h3>
                    <p>Experienced staff dedicated to providing compassionate care and expertise in physiotherapy,
                        ensuring tailored treatment plans that promote optimal health, recovery, and well-being for
                        every client.</p>
                </div>
            </div>
        </section>

        <section class="scrolling-animation">
            <div class="animation-container">
                <ul>
                    <li>Expertise</li>
                    <li>Customisation</li>
                    <li>Convenience</li>
                    <li>Holistic Approach</li>
                </ul>
            </div>
        </section>
        <section class="testimonials">
            <div class="testimonial-bg">
                <p class="text-p">-- Solutions to your pain</p>
                <h2>Best Quality Services With Minimal Pain Rate</h2>
                <p>We deliver top-tier services with a focus on minimizing discomfort, ensuring high-quality care that
                    prioritizes your comfort and effective treatment outcomes in physiotherapy and health improvement
                    programs.</p>
            </div>
            <div class="testimonial-content">
                <div class="testimonial-container">
                    <div class="testimonial-slide">
                        <div class="testimonial-card">
                            <img src="Images/superman.jpg" alt="User Image" class="testimonial-img">
                            <h3>Edward Collin</h3>
                            <p class="role">Actor</p>
                            <p class="testimonial-text">"Hi there! As everyone knows, I am an actor, even I also have
                                some health problems. After disclosing my medical background to
                                curecorner, they provided me with a daily workout regimen, which has helped me stay well
                                and save the planet."</p>
                            <div class="stars">★★★★★</div>
                        </div>
                    </div>
                    <div class="testimonial-slide">
                        <div class="testimonial-card">
                            <img src="Images/lewis.webp" alt="User Image" class="testimonial-img">
                            <h3>Lewis Hamilton</h3>
                            <p class="role">F1 Driver</p>
                            <p class="testimonial-text">"Hello, I used to suffer severe back discomfort when driving an
                                F1 car. I shared this information with curecorner, and their advice and wellness
                                activities helped me get better. I'm winning races and driving pain-free right now. I
                                advise everyone to use curecorner's workout advice."</p>
                            <div class="stars">★★★★</div>
                        </div>
                    </div>
                    <div class="testimonial-slide">
                        <div class="testimonial-card">
                            <img src="Images/toto.jpeg" alt="User Image" class="testimonial-img">
                            <h3>Toto Wolf</h3>
                            <p class="role">Mercedes F1 Team Manager</p>
                            <p class="testimonial-text">"The most amazing experience receiving therapy! I highly
                                recommend that you follow curecorner."</p>
                            <div class="stars">★★★★★</div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-nav">
                    <span class="dot active" onclick="showSlide(0)"></span>
                    <span class="dot" onclick="showSlide(1)"></span>
                    <span class="dot" onclick="showSlide(2)"></span>
                </div>
            </div>
        </section>
        <section class="team">
            <p class="team-p">-- Our Team</p>
            <h2>Physiotherapy Services From Professionals Therapists</h2>
            <div class="team-member">
                <img src="Images/rock-team1.webp" alt="Technical Error! team member 1 image">
                <h3>Dr. Rajesh</h3>
                <p>Senior Physiotherapist</p>
            </div>
            <div class="team-member">
                <img src="Images/ironman-team2.webp" alt="Technical Error! team member 2 image">
                <h3>Dr. Suresh</h3>
                <p>Orthopedic Specialist</p>
            </div>
            <div class="team-member">
                <img src="Images/wonderwoman-team3.webp" alt="Technical Error! team member 3 image">
                <h3>Dr. Anjali</h3>
                <p>Rehabilitation Expert</p>
            </div>
        </section>
    </main>
    <?php include 'footer.php'; ?>
    <script src="script.js"></script>
</body>

</html>