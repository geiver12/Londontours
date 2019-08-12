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
	$connection = connect();
	$query = "SELECT * FROM tour_user where fk_user =".$_SESSION['globaluser'];
	$result = mysqli_query($connection, $query);

	$objBookEdit = null;
	if(isset($_COOKIE['idBook'])){
	    $idBook = $_COOKIE['idBook'];
	    $sqledit = "SELECT tut.*, tu.id as userid, tu.name as user, tt.id as tourid, tt.name as tour FROM tour_user as tut JOIN user as tu ON tut.fk_user = tu.id JOIN tour as tt ON tut.fk_tour = tt.id WHERE tut.id = '$idBook'";
	    $rcedit = mysqli_query($connection, $sqledit);
	    $objBookEdit = $rcedit->fetch_array();
	}

	disconnect($connection);
	
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
							<li class="active"><a href="#gtco-team">Bookings</a></li>
							<li><a href="profile.php">Profile</a></li>

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
								<h1>Welcome!</h1>
								<h2>This is are Bookings available!</h2>
								<p>
									<a href="#gtco-team" class="btn btn-white btn-outline btn-lg">Go Bookings Available!</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>

		<div id="gtco-team" class="gtco-section">
		<div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <div class="table-responsive">
                            <h2>Bookings!</h2>
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Tour Name</th>
                                        <th>Reservation Date</th>
                                        <th>Price Tour</th>
                                        <th>Tour State</th>
                                        <th>Edit Booking</th>
                                        <th>Cancel Booking</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php 
					        			if($result){
					        				$connection = connect();

					        				while ( $column = mysqli_fetch_array($result)) {
					        					$query = "SELECT * FROM tour where id=".$column['fk_tour'];
					        					$result2 = mysqli_query($connection,$query) or die("error on database");
					        					$tour = $result2->fetch_array();
					        					$retVal = ($column['state']==1) ? "active" : "cancelled";
					        					echo "<tr>";
					        					echo "<td>".$tour['name']."</td>";
					        					echo "<td>".$column['date']."</td>";
					        					echo "<td>".$tour['price']."</td>";
					        					echo "<td>".$retVal."</td>";
					        					if ($retVal == "active") {
					        						$on = 'return confirm("Are you sure?") && bookCancel('.$column['id'].')';
					        						echo '<td><a class="btn" title="Edit" data-toggle="modal" data-target=".bookEditModal" onclick="bookEdit('.$column['id'].')"><i class="glyphicon glyphicon-edit"></i></a></td>';
								                	echo "<td><a class='btn' title='Cancel' onclick= '".$on."'><i class='glyphicon glyphicon-remove'></i></a></td>";
					        					}else{
					        						echo "<td><a href='#' class='btn disabled'><i class='glyphicon glyphicon-edit'></i></a></td>";
					        						echo "<td><a href='#' class='btn disabled'><i class='glyphicon glyphicon-remove'></i></a></td>";
					        					}
					        					echo "</tr>";
					        				}
					        				disconnect($connection);
					        			}else{
					        				echo "<p>Ups! there isn't Booking</p>";
					        			}
					        		 ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Tour Name</th>
                                        <th>Reservation Date</th>
                                        <th>Price Tour</th>
                                        <th>Tour State</th>
                                        <th>Edit Booking</th>
                                        <th>Cancel Booking</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
		</div>

  <!--modal edit booking-->
  <div id="myModal" class="modal fade bookEditModal" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      
		      <form id="bookEditModal" action="save.php" method="post" accept-charset="utf-8"
					style="background:#fff;padding:15px;border-radius:5px;">
		      	<div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title">Edit Booking: # <?php echo $objBookEdit['id']; ?></h4>
			      </div>
			    <div class="col-md-6 modal-body">
			      	<label for="mcNamelgm">Date</label>
			      	<input type="date" id="datet" name="datet" value="<?php echo $objBookEdit['date']; ?>" placeholder="Date" class="form-control" disabled>
			    </div>
			    <div class="col-md-6 modal-body">
			      	<label for="mcNamelgm">State</label>
			      	<input type="text" id="statet" name="statet" value="<?php $retVal = ($objBookEdit['state']==1) ? 'active' : 'cancelled'; echo $retVal; ?>" placeholder="State" class="form-control" disabled>
			      	<input type="hidden" id="state" name="state" value="1" placeholder="State" class="form-control" disabled>
			    </div>
			    <div class="modal-body">
			      	<label for="mcNamelgm">User</label>
			      	<input type="text" id="userm" name="userm" value="<?php echo $objBookEdit['user']; ?>" placeholder="User" class="form-control" disabled>
			      	<input type="hidden" id="user" name="user" value="<?php echo $objBookEdit['userid']; ?>" placeholder="User" class="form-control" disabled>
			    </div>
			    <div class="modal-body">
			      	<label for="mcNamelgm">Tour</label>
			      	<input type="text" id="tourm" name="tourm" value="<?php echo $objBookEdit['tour']; ?>" placeholder="Tour" class="form-control" disabled>
			      	<input type="hidden" id="tour" name="tour" value="<?php echo $objBookEdit['tourid']; ?>" placeholder="Tour" class="form-control" disabled>
			    </div>
			    <div class="modal-body">
			      	<label for="mcNamelgm">Tickets</label>
			      	<input type="number" id="tickets" name="tickets" value="<?php echo $objBookEdit['tickets']; ?>" placeholder="Tickets" class="form-control" min="1" max="20">
			    </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" onclick="bookUpdt(<?php echo $objBookEdit['id']; ?>)">Update!</button>
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