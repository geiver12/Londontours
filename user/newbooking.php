<?php 
	session_start();
	include_once 'csrf.php';
	$tour_id = $_GET['tour'];
	$tour_id = trim($tour_id); 
	$tour_id = stripslashes($tour_id);
	include('../php/connection.php');
	if(isset($_SESSION['globaluser'])){
 ?>
<!DOCTYPE HTML>
<html>
<?php 
include('../partials/head.php');
$con = connect();
$query = "SELECT * FROM tour where id ='".$tour_id."'";
$result = mysqli_query( $con, $query ) or die("Something went wrong in the query to the database");
$tour = $result->fetch_array();
disconnect($con);
$_SESSION['idtour'] = $tour_id;
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
							<li><a href="index.php">Tours</a></li>
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
								<h1>Welcome !!</h1>
								<h2>This is are options available!</h2>
								<p>
									<a href="#gtco-team" class="btn btn-white btn-outline btn-lg">Go Suscribe!!</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>


        
        <div class="container gtco-section" id="gtco-team">
        	<div class="row">
        		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
						<div class="box-white">
        			<?php echo "<h1 class='title-tour'>".$tour['name']."</h1>"; ?>	
							</div>
        		</div>
						</div>
        		
        	<div class="row section-div">

					<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        			<div class="imgtour box-white">
        				<?php echo "<img src='../img/".$tour['image']."' alt='".$tour['image']."'>"; ?>
        			</div>
        		</div>

        		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        			<div class="box-white">
        				<?php echo "<h3 class = 'subtitle'>Price</h3>" ?>
        				<?php echo "<p>".$tour['price']."</p>" ?>
        			</div>
        		</div>
						</div>
						<div class="row section-div">

        		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        			<div class="box-white">
        				<?php echo "<h3 class = 'subtitle'>Date</h3>" ?>
        				<?php echo "<p>".$tour['date']."</p>" ?>
        			</div>
        		</div>
        		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        			<div class="box-white">
        				<?php echo "<h3 class = 'subtitle'>Duration</h3>" ?>
        				<?php echo "<p>".$tour['duration']."</p>" ?>
        			</div>
        		</div>
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        			<div class="text-tour box-white">
        				<?php echo "<label>Itinerary</label><p>".$tour['itinerary']."</p>" ?>
        				<a href='#' style="" data-toggle='modal' data-target='#myModal' class="btn btn-success">Suscribe!</a>
        			</div>
        		</div>
        	</div>	
        </div>
       

		<!-- Modal -->
		<div id="myModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Count Residents!</h4>
		      </div>
		      <form action="../php/validate-booking.php" method="post" accept-charset="utf-8"
					style="background:#fff;padding:15px;border-radius:5px;">
			      <div class="modal-body">
			      	<label for="mcNamelgm">Please choose the number of residents to request:</label>
			      	<input type="number" name="tickets" value="1" placeholder="Tickets" class="inputNumber" min="1" max="20" >
			      </div>
			      <div class="modal-footer">
							<input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
			        <input type="submit" class="btn btn-default" value="Suscribe!" required="At least One"></input>
			      </div>
		      </form>
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