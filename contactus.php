<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home Page</title>
	<link rel="stylesheet" type="text/css" href="indexcontactuspagestyle.css?v=1.0">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Arsenal:ital,wght@0,400;0,700;1,400;1,700&display=swap"
		rel="stylesheet">
</head>

<body>
	<?php include 'header.php'; ?>
	<main>
		<section class="banner">
			<div class="banner-content">
				<div class="ban-nav">
					<h1>Have questions or need support? Contact us – we’re always here to help.</h1>
				</div>
			</div>
		</section>
		<section class="contact-us">
			<div class="contact-info">
				<div class="contact-info-item">
					<h3>Phone:</h3>
					<p>+1 548-584-5467<br>+1 548-755-5892</p>
				</div>
				<div class="contact-info-item">
					<h3>Email:</h3>
					<p>contact@curecorner.com<br>24hrssupport@curecorner.com</p>
				</div>
				<div class="contact-info-item">
					<h3>Address:</h3>
					<p>158 Oat Lane <br> Kitchener, Ontario<br>A8Y 2E8</p>
				</div>
			</div>
			<div class="contact-form">
				<h2>Contact With Us:</h2>
				<h3>Any Questions?</h3>
				<form action="submit_contact.php" method="POST">
					<input type="text" name="name" placeholder="Name" required>
					<input type="email" name="email" placeholder="Email" class="email-form" required>
					<input type="text" name="phone" placeholder="Phone" required>
					<input type="text" name="subject" placeholder="Subject" required>
					<textarea name="message" placeholder="Message" required></textarea>
					<div class="form-footer">
						<p><input type="checkbox" name="terms" required> I agree to the <a href="#">Terms &
								Conditions</a> and <a href="#">Privacy Policy</a>.</p>
						<button type="submit">Submit</button>
					</div>
				</form>
			</div>
		</section>
		<div class="map-container">
			<h2>Our Location:</h2>
			<iframe
				src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2948.6231375997925!2d-80.51310718453716!3d43.45163867912715!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x882bf6b9e7b57a6d%3A0x8d3d6e7e0d2f7a9b!2s158%20Oat%20Ln%2C%20Kitchener%2C%20ON%20N2R%200C1%2C%20Canada!5e0!3m2!1sen!2sus!4v1626123456789!5m2!1sen!2sus"
				width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
		</div>
	</main>
	<?php include 'footer.php'; ?>
	<script src="script.js"></script>
</body>

</html>