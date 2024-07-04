<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home Page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<?php include 'header.php'; ?>
	<main>
		<section class="banner">
			<div class="banner-content">
				<h1>Your Health, Our Priority</h1>
				<p>We provide you exercise tips based on your conditions</p>
				<a href="#" class="btn-services">Our Services</a>
				<div class="banner-nav">
                    <a href="#" class="nav-left">&lt;</a>
                    <a href="#" class="nav-right">&gt;</a>
                </div>
			</div>
		</section>
		
        <section class="our-services-section">
            <div class="service">
                <img src="Images/service1.jpeg" alt="Technical Error! Service 1 image">
                <h3>Expert Consultation</h3>
                <p>Need expert guidance on your health? Book an <br>
				appointment with a specialist to discuss your condition.</p>
            </div>
            <div class="service">
                <img src="Images/service2.jpeg" alt="Technical Error! Service 2 image">
                <h3>Expert Care</h3>
                <p>You will receive care from experienced professionals.</p>
            </div>
            <div class="service">
                <img src="Images/service3.jpeg" alt="Technical Error! Service 3 image">
                <h3>Quality Treatment</h3>
                <p>Top-notch treatment and facilities.</p>
            </div>
        </section>
		<section class="about-us">
            <div class="about-content">
                <img src="Images/about-us.webp" alt="About Us Image">
                <div class="about-text">
					<p class="about-text-p">-- About Us</p>
                    <h2>What Cure Corner Offers</h2>
                    <p>Start your journey towards a healthier, more balanced life today. Whether you're looking to alleviate pain, prevent health issues, or simply improve your overall wellness, Cure Corner is here to support you every step of the way.</p>
                    <ul>
                        <li>Personalized Exercise Plans</li>
                        <li>Online Consultations</li>
                        <li>Progress Tracking</li>
                    </ul>
                    <a href="#" class="btn-contact">Contact Us</a>
                </div>
            </div>
        </section>
		<section class="why-choose-us" id="why-choose-us">
		<p class="text-p">-- Why Choose Us</p>
            <h2>Why Choose Cure Corner</h2>
            <div class="features">
                <div class="feature hidden">
                    <img src="Images/feature1.jpeg" alt="Technical Error! Feature 1 image">
                    <h3>Health Assessments</h3>
                    <p>We analyze your lifestyle and health data to predict and warn you about potential future health risks, helping you stay proactive about your wellbeing.</p>
                </div>
                <div class="feature hidden">
                    <img src="Images/feature2.jpeg" alt="Technical Error! Feature 2 image">
                    <h3>Therapy Goals</h3>
                    <p>Our goal is to provide to good therapy to keep to you fit an healthy.</p>
                </div>
                <div class="feature hidden">
                    <img src="Images/feature3.jpeg" alt="Technical Error! Feature 3 image">
                    <h3>Experienced Staff</h3>
                    <p>We have experienced staff you has 15+ years of experience in therapy and exercise traning.</p>
                </div>
            </div>
        </section>
        <section class="testimonials">
            <div class="testimonial-bg">
                <img src="Images/testimonialimage.webp" alt="Background Image" class="background-img">
            </div>
            <div class="testimonial-content">
            <p class="text-p">-- Solutions to your pain</p>
                <h2>Best Quality Services With Minimal Pain Rate</h2>
                <div class="testimonial-container">
                    <div class="testimonial-slide">
                        <div class="testimonial-card">
                            <img src="Images/superman.jpg" alt="User Image" class="testimonial-img">
                            <h3>Super Man</h3>
                            <p class="role">Actor</p>
                            <p class="testimonial-text">"Hi there! As everyone knows, I am Superman with incredible powers, but I also have some health problems. After disclosing my medical background to curecorner, they provided me with a daily workout regimen, which has helped me stay well and save the planet."</p>
                            <div class="stars">★★★★★</div>
                        </div>
                    </div>
                    <div class="testimonial-slide">
                        <div class="testimonial-card">
                            <img src="Images/lewis.webp" alt="User Image" class="testimonial-img">
                            <h3>Lewis Hamilton</h3>
                            <p class="role">F1 Driver</p>
                            <p class="testimonial-text">"Hello, I used to suffer severe back discomfort when driving an F1 car. I shared this information with curecorner, and their advice and wellness activities helped me get better. I'm winning races and driving pain-free right now. I advise everyone to use curecorner's workout advice."</p>
                            <div class="stars">★★★★</div>
                        </div>
                    </div>
                    <div class="testimonial-slide">
                        <div class="testimonial-card">
                            <img src="Images/toto.jpeg" alt="User Image" class="testimonial-img">
                            <h3>Toto Wolf</h3>
                            <p class="role">Mercedes F1 Team Manager</p>
                            <p class="testimonial-text">"The most amazing experience receiving therapy! I highly recommend that you follow curecorner."</p>
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
                <h3>Dr. Rock</h3>
                <p>Senior Physiotherapist</p>
            </div>
            <div class="team-member">
                <img src="Images/ironman-team2.webp" alt="Technical Error! team member 2 image">
                <h3>Dr. Iron man</h3>
                <p>Orthopedic Specialist</p>
            </div>
            <div class="team-member">
                <img src="Images/wonderwoman-team3.webp" alt="Technical Error! team member 3 image">
                <h3>Dr. Wonder Woman</h3>
                <p>Rehabilitation Expert</p>
            </div>
        </section>
	</main>
	<?php include 'footer.php'; ?>
    <script src="script.js"></script>
</body>
</html>