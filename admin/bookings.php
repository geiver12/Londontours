<?php 
	session_start();
	include('../php/connection.php');
	if(isset($_SESSION['globaluser'])){
 ?>
<!DOCTYPE HTML>
<html>
<?php 
include('../partials/head.php');

$connection = connect();
$query = "SELECT * FROM tour_user";
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
						<li><a href="customers.php">Customers</a></li>
							<li><a href="index.php">Tours</a></li>
							<li class="active"><a href="#gtco-team">Bookings</a></li>
							<li><a href="comments.php">comments</a></li>

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

		<header id="gtco-header" class="gtco-cover" role="banner" style="background-image:url(../images/AbadiaWestsminster4.jpg);">
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
                        <!-- <div class="basic-tb-hd">
                            <p>It's just that simple. Turn your simple table into a sophisticated data table and offer your users a nice experience and great features without any effort.</p>
                        </div> -->
                        <div class="table-responsive">
                            <h2>Bookings</h2>
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>date</th>
                                        <th>Tickets Qty</th>
                                        <th>User</th>
                                        <th>Tour</th>
                                        <th>State</th>
                                        <th>Edit Booking</th>    
                                        <th>Delete Booking</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php 
					        			if($result){
					        				$connection = connect();

					        				while ( $column = mysqli_fetch_array($result)) {
					        					$id = $column['fk_user'];
					        					$query = "SELECT name FROM user WHERE id = '$id'";
					        					$result2 = mysqli_query($connection,$query) or die("error on database");
					        					$user = $result2->fetch_array();

					        					$id = $column['fk_tour'];
					        					$query = "SELECT name FROM tour WHERE id = '$id'";
					        					$result2 = mysqli_query($connection,$query) or die("error on database");
					        					$tour = $result2->fetch_array();

					        					$retVal = ($column['state']==1) ? "active" : "cancelled";
					        					echo "<tr>";
					        					echo "<td>".$column['id']."</td>";
					        					echo "<td>".$column['date']."</td>";
					        					echo "<td>".$column['tickets']."</td>";
					        					echo "<td>".$user['name']."</td>";
					        					echo "<td>".$tour['name']."</td>";
					        					echo "<td>".$retVal."</td>";
					        					if ($retVal == "active") {
					        						$on = 'return confirm("Are you sure?") && bookDel('.$column['id'].')';
					        						echo '<td><a class="btn" title="Edit" data-toggle="modal" data-target=".bookEditModal" onclick="bookEdit('.$column['id'].')"><i class="glyphicon glyphicon-edit"></i></a></td>';
								                	echo "<td><a class='btn' title='Delete' onclick= '".$on."'><i class='glyphicon glyphicon-trash'></i></a></td>";
					        					}else{
					        						echo "<td><a href='#' class='btn disabled'><i class='glyphicon glyphicon-edit'></i></a></td>";
					        						echo "<td><a href='#' class='btn disabled'><i class='glyphicon glyphicon-trash'></i></a></td>";
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
                                        <th>id</th>
                                        <th>date</th>
                                        <th>Tickets Qty</th>
                                        <th>User</th>
                                        <th>Tour</th>
                                        <th>State</th>
                                        <th>Edit Booking</th>    
                                        <th>Delete Booking</th>
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
		      <!-- <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Edit User: # <?php echo $objBookEdit['id']; ?></h4>
		      </div> -->
		      <form id="bookEditModal" action="save.php" method="post" accept-charset="utf-8"
					style="background:#fff;padding:15px;border-radius:5px;">
		      	<div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title">Edit Booking: # <?php echo $objBookEdit['id']; ?></h4>
			      </div>
			    <div class="col-md-6 modal-body">
			      	<label for="mcNamelgm">Date</label>
			      	<input type="date" id="datet" name="datet" value="<?php echo $objBookEdit['date']; ?>" placeholder="Date" class="form-control" >
			    </div>
			    <div class="col-md-6 modal-body">
			      	<label for="mcNamelgm">State</label>
			      	<!-- <input type="text" id="state" name="state" value="<?php $retVal = ($objBookEdit['state']==1) ? 'active' : 'cancelled'; echo $retVal; ?>" placeholder="State" class="form-control" > -->
			      	<select id="state" class="form-control">
		              <?php  
		              	if($objBookEdit['state'] == 1){
                      		echo '<option value="1" selected>Active</option>';
                      		echo '<option value="0" >Cancelled</option>';	
                    	}else{
                    		echo '<option value="1">Active</option>';
                      		echo '<option value="0"  selected>Cancelled</option>';
                    	}
		                    
		              ?>
		            </select>
			    </div>
			    <div class="col-md-12 modal-body">
			      	<label for="mcNamelgm">User</label>
			      	<select id="user" class="form-control">
		              <?php  
		              	$connection = connect();            
		                $sqlcatp = "SELECT * FROM user";
		                $rccatp = mysqli_query($connection, $sqlcatp);
		                if($rccatp){
		                  //if(pg_num_rows($rccatp) > 0){
		                    while($objcatp = mysqli_fetch_array($rccatp)){
		                    	if($objcatp['id'] == $objBookEdit['user']){
		                      		echo '<option value="'.$objcatp['id'].'" selected>'.$objcatp['name'].'</option>';	
		                    	}else{
		                    		echo '<option value="'.$objcatp['id'].'">'.$objcatp['name'].'</option>';
		                    	}
		                    }
		                  //}
		                }else{
		                	echo '<option value="">Error connection</option>';
		                }
		                disconnect($connection);
		              ?>
		            </select>
			    </div>
			    <div class="col-md-12 modal-body">
			      	<label for="mcNamelgm">Tour</label>
			      	
			      	<select id="tour" class="form-control">
		              <?php  
		              	$connection = connect();            
		                $sqltour = "SELECT * FROM tour";
		                $rcctour = mysqli_query($connection, $sqltour);
		                if($rcctour){
		                  //if(pg_num_rows($rcctour) > 0){
		                    while($objtour = mysqli_fetch_array($rcctour)){
		                    	if($objtour['id'] == $objBookEdit['tour']){
		                      		echo '<option value="'.$objtour['id'].'" selected>'.$objtour['name'].'</option>';	
		                    	}else{
		                    		echo '<option value="'.$objtour['id'].'">'.$objtour['name'].'</option>';
		                    	}
		                    }
		                  //}
		                }else{
		                	echo '<option value="">Error connection</option>';
		                }
		                disconnect($connection);
		              ?>
		            </select>
			    </div>
			    <div class="col-md-12 modal-body">
			      	<label for="mcNamelgm">Tickets</label>
			      	<input type="number" id="tickets" name="tickets" value="<?php echo $objBookEdit['nTickets']; ?>" placeholder="Tickets" class="form-control" min="1" max="20">
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