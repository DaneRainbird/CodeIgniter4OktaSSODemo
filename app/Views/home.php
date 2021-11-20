<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Example CI4 Okta Auth</title>
		
		<!-- Meta Values -->
		<meta name="description" content="An example of Okta SSO Authentcation with CI4">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="Dane Rainbird (hello@danerainbird.me)">

		<!-- Stylesheets -->
		<link rel="stylesheet" href="/res/css/main.css">
		
	</head>
	<body>
		<!-- Header -->
		<header>
			<div class="author">
				<p>Created by <a href="https://www.danerainbird.me" target="_blank">Dane Rainbird</a></p>
			</div>
			<div class="introduction">
				<h1>Example CI4 Okta Auth</h1>
				<p>An example of Okta SSO Authentcation with CodeIgniter 4</p>
			</div>
		</header>
		<!-- End Header -->
		<!-- Main Content -->
		<div class="container">
			<div class="row">
				<div class="col">
					<?php if (!isset($username)) { ?>
						<h2>Sign In</h2>
						<p>Click the button below to sign in with Okta:</p>
						<a href="/users/login" class="btn">Sign in!</a>
					<?php } else { ?>
						<h2>Sign Out</h2>
						<p>Click the button below to sign out with Okta:</p>
						<a href="/users/logout" class="btn">Sign out!</a>
					<?php } ?>
				</div>
				<div class="col">
					<h2>User Info</h2>
					<?php if (isset($success)) { ?>
						<div class="success-alert">
							<p>Successfully signed in with Okta!</p>
						</div>
					<?php } ?>

					<?php if (!isset($username)) { ?>
						<p>You are not signed in...</p>
					<?php } else { ?>
						<p>You are signed in as <?php echo "<span class='user'>" . $username . "</span>"; ?>.</p>
					<?php } ?>
				</div>
			</div>
		</div>
		<!-- End Main Content -->
		<!-- Footer -->
		<footer>
			<p>Inspired by the <a href="https://developer.okta.com/blog/2019/10/28/simple-secure-authentication-with-codeigniter" target="_blank"><em>"Simple, Secure Authentication with CodeIgniter"</em></a>  Tutorial by Krasimir Hristozov / Okta</p>
		</footer>
		<!-- End Footer -->
	</body>
</html>