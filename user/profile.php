<?php 
	session_start();
	include_once 'csrf.php';
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

		<nav class="gtco-nav " role="navigation" >
			<div class="gtco-container">
				<div class="row">
					<div class="col-xs-2">
						<div id="gtco-logo"><a href="../index.php">LondonTours</a></div>
					</div>
					<div class="col-xs-10 text-right menu-1">
						<ul>
							<li><a href="index.php">Tours</a></li>
							<li><a href="bookings.php">Bookings</a></li>
							<li class="active"><a href="#gtco-team">Profile</a></li>

							<?php 	if (isset($_SESSION['globaluser'])) {
								?>
								<li><a href="../php/validate-logout.php">Logout</a></li>
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
								<p>
									<a href="#gtco-team" class="btn btn-white btn-outline btn-lg">Your Profile!!</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>


	<div class="gtco-section" id="gtco-team">
        <div class="container">
            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h2>Edit Profile: # <?php echo $user['id']; ?></h2>

                    <form id="#" action="save.php" method="post" accept-charset="utf-8">
					    <div class=" col-md-6 modal-body">
					      	<label for="mcNamelgm">Name</label>
					      	<input type="text" id="name" name="name" value="<?php echo $user['name']; ?>" placeholder="Name" class="form-control" >
					    </div>
					    <div class="col-md-6 modal-body">
					      	<label for="mcNamelgm">E-mail</label>
					      	<input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" placeholder="Email" class="form-control" >
					    </div>
					    <div class="col-md-6 modal-body">
					      	<label for="mcNamelgm">Phone</label>
					      	<input type="phone" id="phone" name="phone" value="<?php echo $user['phone']; ?>" placeholder="Phone" class="form-control" >
					    </div>
					    <div class="col-md-6 modal-body">
					      	<label for="mcNamelgm">Postcode</label>
					      	<input type="text" id="postcode" name="postcode" value="<?php echo $user['postcode']; ?>" placeholder="PostCode" class="form-control" >
					    </div>
					    <div class="col-md-12 modal-body">
					      	<label for="mcNamelgm">Address</label>
					      	<input type="text" id="address" name="address" value="<?php echo $user['address']; ?>" placeholder="Address" class="form-control" >
					    </div>
					      <div class="col-md-12	 modal-body">
					      	<label for="mcNamelgm">Password</label>
					      	<input type="password" id="password" name="password" placeholder="********" class="form-control" >
					      	<input type="hidden" id="passwordC" name="passwordC" value="<?php echo $user['password']; ?>" placeholder="Password" class="form-control" >
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" onclick="userUpdt(<?php echo $user['id']; ?>)">Update!</button>
					      </div>
				    </form>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- Data Table area End-->

    <div id="mypfle" class="modal fade pfleModal" role="dialog">
		  <div class="modal-dialog">

		    <div class="modal-content">
		      
		      <form id="pfleModal" action="save.php" method="post" accept-charset="utf-8">
		      	<div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title">Confirmation: </h4>
			      </div>
			    <div class="modal-body">
			      	<label for="mcNamelgm">Your profile was updated successfully!</label>
			    </div>
			  
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-toggle="modal" data-target=".pfleModal">Ok!</button>
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