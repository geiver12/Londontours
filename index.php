<?php 
	session_start();
	include_once('php/csrf.php');
	include('php/connection.php');
	if(!$_GET){
		header('Location:index.php?page=1');
	}
 ?>
<!DOCTYPE HTML>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>London Tours</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href='https://fonts.googleapis.com/css?family=Raleway:400,300,600,400italic,700' rel='stylesheet' type='text/css'>

	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">

	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="css/style.css">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>

</head>

<body>

	<div class="gtco-loader"></div>

	<div id="page">
		<nav class="gtco-nav" role="navigation" >
			<div class="gtco-container">
				<div class="row">
					<div class="col-xs-2">
						<div id="gtco-logo"><a href="index.php">LondonTours</a></div>
					</div>
					<div class="col-xs-10 text-right menu-1">
						<ul>
						<?php 	if (isset($_SESSION['globaluser']) and isset($_SESSION['roluser'])) {
								if($_SESSION['roluser']==1){
								echo '<li><a href="admin/index.php">Options</a></li>';
								}else{
								echo '<li><a href="user/index.php">Options</a></li>';}
								}
							?>
							<li><a href="#gtco-team">Tours</a></li>
							<li><a href="#labout">About</a></li>
							<li><a href="#lcontact">Contact</a></li>

							<?php 	if (isset($_SESSION['globaluser'])) {
								?>
								<li><a href="php/validate-logout.php">Logout</a></li>
								<?php 
								}else{
									?>
									<li class="has-dropdown active">
									<a href="login.php">Sign Up</a>
									<ul class="dropdown">
										<li><a href="signup.php">Sign Up</a></li>
										<li><a href="login.php">login</a></li>
									</ul>
								</li>
								<?php }
							?>
						</ul>
					</div>
				</div>

			</div>
		</nav>

		<header id="gtco-header" class="gtco-cover" role="banner" style="background-image:url(images/AbadiaWestsminster4.jpg);">
			<div class="overlay"></div>
			<div class="gtco-container">
				<div class="row">
					<div class="col-md-12 col-md-offset-0 text-center">
						<div class="display-t">
							<div class="display-tc animate-box" data-animate-effect="fadeIn">
								<h1>Welcome to London Tours!</h1>
								<h2>Book your appointment to sail in London</h2>
								<p>
									<a href="signup.php" class="btn btn-white btn-outline btn-lg">Sign Up</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>

		<<div id="gtco-team" class="gtco-section">

<div class="container">
<div class="row">
<div class="card-title"><h3>The Best Tours!</h3></div>
<?php
   $connection = connect();
   $query = "SELECT * FROM tour";
   $result = mysqli_query($connection, $query) or die("Something went wrong in the query to the database");
   while ($column = mysqli_fetch_array($result)) {
	   echo "<div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>";
	   echo "<div class='card'>";
	   echo "<div class='card-title'> <h3>" . $column['name'] . "</h3></div>";
	   echo "<img class='card-img-top' src='images/person_1.jpg' alt='" . $column['image'] . "'>";
	   echo "<div class='card-body'>";
	   echo "<p class='card-text'>" . $column['description'] . "</p>";
	   echo "</div>";
	   echo "</div>";
	   echo "</div>";
   }
   disconnect($connection)
	   ?>
</div>
</div>
</div>

		<div class="gtco-cover gtco-cover-sm " style="background-image:url(images/BigBen.jpg);" id="labout">
			<div class="overlay"></div>
			<div class="gtco-container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center">
						<div class="display-t">
							<div class="display-tc animate-box" data-animate-effect="fadeIn">
								<h1>About us!</h1>
								<h2>We are the leading company in online distribution of activities, excursions and guided tours in the main
									tourist destinations of London.</h2>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="gtco-section" id="lcontact">
			<div class="gtco-container">
				<div class="row">
					<div class="col-md-12 animate-box">
						<?php
						if(isset($_SESSION["confirmation"])){
							echo '<h3>'.$_SESSION["confirmation"].'</h3>';
							unset ($_SESSION["confirmation"]);

						}
						?>
						<h3>Contact for our Services!</h3>
						<form method="post" action="php/comments.php"
					style="background:#fff;padding:15px;border-radius:5px;">
							<div class="row form-group">
								<div class="col-md-12">
									<label for="name">Name</label>
									<input type="text" name="name" class="form-control2" placeholder="Your Name">
								</div>
							</div>

							<div class="row form-group">
								<div class="col-md-12">
									<label for="email">Email</label>
									<input type="text" name="email" class="form-control2" placeholder="Your email address">
								</div>
							</div>
							<div class="row form-group">
								<div class="col-md-12">
									<textarea name="message" name="message" cols="30" rows="10" class="form-control2" placeholder="Write us something"></textarea>
								</div>
							</div>
							<div class="form-group">
							<input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
								<input type="submit" value="Send Message" class="btn btn-primary">
							</div>

						</form>
					</div>
				</div>
			</div>
		</div>

		<footer id="gtco-footer" role="contentinfo">
			<div class="gtco-container">
				<div class="row copyright">
					<div class="col-md-12">
						<p class="pull-left">
							<small class="block">Copyright © London Tours 2019. All Rights Reserved.</small>
							<small class="block"><a href="#" target="_blank">Privacy Policy</a><a
								 href="http://unsplash.co/" target="_blank"> Terms of Use</a></small>
						</p>
						<p class="pull-right">
							<ul class="gtco-social-icons pull-right">
								<li><a href="#"><i class="icon-twitter"></i></a></li>
								<li><a href="#"><i class="icon-facebook"></i></a></li>
								<li><a href="#"><i class="icon-linkedin"></i></a></li>
							</ul>
						</p>
					</div>
				</div>

			</div>
		</footer>
	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>

	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Carousel -->
	<script src="js/owl.carousel.min.js"></script>
	<!-- countTo -->
	<script src="js/jquery.countTo.js"></script>
	<!-- Magnific Popup -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	<!-- Main -->
	<script src="js/main.js"></script>

</body>

</html>