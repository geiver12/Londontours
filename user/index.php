<?php 
	session_start();
	include('../php/connection.php');
	if(isset($_SESSION['globaluser'])){
 ?>
<!DOCTYPE HTML>
<html>
<?php 
include('../partials/head.php');
$con = connect();
    $query = "SELECT * FROM user where id ='".$_SESSION['globaluser']."'";
    $result = mysqli_query( $con, $query ) or die("Something went wrong in the query to the database");
    $user = $result->fetch_array();
    disconnect($con)
?>
<body>

	<div class="gtco-loader"></div>

	<div id="page">
		<nav class="gtco-nav" role="navigation" >
			<div class="gtco-container">
				<div class="row">
					<div class="col-xs-2">
						<div id="gtco-logo"><a href="../index.php">LondonTours</a></div>
					</div>
					<div class="col-xs-10 text-right menu-1">
						<ul>
							<li class="active"><a href="#gtco-team">Tours</a></li>
							<li><a href="bookings.php">Bookings</a></li>
							<li><a href="profile.php">Profile</a></li>

							<?php 	if (isset($_SESSION['globaluser'])) {
								?>
								<li><a href="../php/validate-logout.php">Logout</a></li>
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

		<header id="gtco-header" class="gtco-cover" role="banner" style="background-image:url(../images/LondonEye2.JPG);">
			<div class="overlay"></div>
			<div class="gtco-container">
				<div class="row">
					<div class="col-md-12 col-md-offset-0 text-center">
						<div class="display-t">
							<div class="display-tc animate-box" data-animate-effect="fadeIn">
								<h1>Welcome <?php echo $user['name'];?>!</h1>
								<h2>This is are options available!</h2>
								<p>
									<a href="#gtco-team" class="btn btn-white btn-outline btn-lg">Go Tours Available!</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>

		<div id="gtco-team" class="gtco-section">

		 	<div class="container">
        	<div class="row">
			<div class="card-title"><h3>The Bests Tours!</h3></div>
             <?php
                $connection = connect();
                $query = "SELECT * FROM tour";
                $result = mysqli_query($connection, $query) or die("Something went wrong in the query to the database");
                while ($column = mysqli_fetch_array($result)) {
					echo "<div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>";
					echo "<div class='card'>";
					echo "<div class='card-title'> <h3>" . $column['name'] . "</h3></div>";
					echo "<img class='card-img-top' src='../image/" . $column['image'] . "' alt='" . $column['image'] . "'>";
					echo "<div class='card-body'>";
                    echo "<p class='card-text'>" . $column['description'] . "</p>";
                    echo "<div class='wrap-login100-form-btn'>";
                    echo "<a href='newbooking.php?tour=" . $column['id'] . "' class='btn-primary btn'>Buy Tour</a>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
                disconnect($connection)
                    ?>
        	</div>
    	</div>
		</div>


<?php
include ('../partials/footer.php');
?>
	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>

<?php
include ('../partials/libraryjs.php');
?>
</body>
</html>
<?php
    }else{
        header('Location:../index.php');
    }
?>