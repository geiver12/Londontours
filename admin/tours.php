<?php
session_start();
include '../php/connection.php';
if (isset($_SESSION['globaluser'])) {
    ?>
<!DOCTYPE HTML>
<html>
<?php
include '../partials/head.php';
    $con = connect();
		$objTourEdit = null;
		$query = "SELECT * FROM tour";
		$result = mysqli_query($con, $query);

	if(isset($_COOKIE['idTour'])){
			$idTour = $_COOKIE['idTour'];
			$idTour = trim($idTour); 
    	$idTour = stripslashes($idTour);
	    $sqledit = "SELECT * FROM tour WHERE id = '$idTour'";
	    $rcedit = mysqli_query($con, $sqledit);
	    $objTourEdit = $rcedit->fetch_array();
	}
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
							<li class="active"><a href="#gtco-team">Tours</a></li>
							<li><a href="bookings.php">Bookings</a></li>
							<li><a href="comments.php">Comments</a></li>

							<?php if (isset($_SESSION['globaluser'])) {
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
								<h1>Welcome Administrator!</h1>
								<h2>Your options available!</h2>
								<p>
									<a href="#gtco-team" class="btn btn-white btn-outline btn-lg">Go Tours Available!</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>

		<div class="data-table-area gtco-section" id="gtco-team">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <!-- <div class="basic-tb-hd">
                            <p>It's just that simple. Turn your simple table into a sophisticated data table and offer your users a nice experience and great features without any effort.</p>
                        </div> -->
                        <div class="table-responsive">
                            <h2>Tours  </h2>
                            <a href='#' style="" data-toggle='modal' data-target='#newTour' class="btn btn-success">New Tour!</a>
                            <br/>
                            <br/>
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Date</th>
                                        <th>Price</th>
                                        <th>Duration</th>
                                        <th>Edit Booking</th>
                                        <th>Delete Booking</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php
if ($result) {
        $connection = connect();

        while ($column = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $column['id'] . "</td>";
            echo "<td>" . $column['name'] . "</td>";
            echo "<td>" . $column['date'] . "</td>";
            echo "<td>" . $column['price'] . "</td>";
            echo "<td>" . $column['duration'] . "</td>";
            $on = 'return confirm("Are you sure?") && tourDel(' . $column['id'] . ')';
            echo '<td><a class="btn" title="Edit" data-toggle="modal" data-target=".tourEditModal" onclick="tourEdit(' . $column['id'] . ')"><i class="glyphicon glyphicon-edit"></i></a></td>';
            echo "<td><a class='btn' title='Delete' onclick= '" . $on . "'><i class='glyphicon glyphicon-trash'></i></a></td>";

            echo "</tr>";

        }
        disconnect($connection);
    } else {
        echo "<p>Ups! there isn't Booking</p>";
    }
    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Date</th>
                                        <th>Price</th>
                                        <th>Duration</th>
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
		<div id="myModal" class="modal fade tourEditModal" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <form id="tourEditModal" action="save.php" method="post" accept-charset="utf-8"
					style="background:#fff;padding:15px;border-radius:5px;">
		      	<div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title">Edit Tour: # <?php echo $objTourEdit['id']; ?></h4>
			      </div>
			    <div class="modal-body">
			      	<label for="mcNamelgm">Date</label>
			      	<input type="date" id="dateE" name="dateE" value="<?php echo $objTourEdit['date']; ?>" placeholder="Date" class="form-control" >
			    </div>
			    <div class="modal-body">
			      	<label for="mcNamelgm">name</label>
			      	<input type="text" id="nameE" name="nameE" value="<?php echo $objTourEdit['name']; ?>" placeholder="name" class="form-control" >
			    </div>
			    <div class="modal-body">
			      	<label for="mcNamelgm">Image</label>
			      	<input type="file" id="imageE" name="imageE" value="<?php echo $objTourEdit['image']; ?>" placeholder="image" class="form-control" accept="image/jpeg,image/jpg,image/png">
			    </div>
			    <div class="modal-body">
			      	<label for="mcNamelgm">Price</label>
			      	<input type="text" id="priceE" name="priceE" value="<?php echo $objTourEdit['price']; ?>" placeholder="price" class="form-control" >
			    </div>
			    <div class="modal-body">
			      	<label for="mcNamelgm">Itinerary</label>
			      	<textarea id="itineraryE" name="itineraryE" style="resize: none;" placeholder="itinerary" class="form-control" ><?php echo $objTourEdit['itinerary']; ?></textarea>
			    </div>
			    <div class="modal-body">
			      	<label for="mcNamelgm">Duration (Hrs)</label>
							<input type="text" id="durationE" name="durationE" value="<?php echo $objTourEdit['duration']; ?>" placeholder="duration" class="form-control" min="1" max="24">
			    </div>
			    <div class="modal-body">
			      	<label for="mcNamelgm">Description</label>
			      	<textarea id="descriptionE" name="descriptionE" style="resize: none;" placeholder="description" class="form-control" ><?php echo $objTourEdit['description']; ?></textarea>
			    </div>

			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" onclick="tourUpdt(<?php echo $objTourEdit['id']; ?>)">Update!</button>
			      </div>
		      </form>
		    </div>

		  </div>
		</div>

	<div id="newTour" class="modal fade newTour" role="dialog">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <form  action="save.php" enctype="multipart/form-data"  method="post" accept-charset="utf-8"
					style="background:#fff;padding:15px;border-radius:5px;">
		      	<div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title">New Tour:</h4>
			      </div>
			    <div class="modal-body">
			      	<label for="mcNamelgm">Date</label>
			      	<input type="date" id="date" name="date" value="" placeholder="Date" class="form-control" >
			    </div>
			    <div class="modal-body">
			      	<label for="mcNamelgm">name</label>
			      	<input type="text" id="name" name="name" value="" placeholder="name" class="form-control" >
			    </div>
			    <div class="modal-body">
			      	<label for="mcNamelgm">Image</label>
			      	<input type="file" id="image" name="image" value="" placeholder="image" class="form-control" >
			    </div>
			    <div class="modal-body">
			      	<label for="mcNamelgm">Price</label>
			      	<input type="text" id="price" name="price" value="" placeholder="price" class="form-control" >
			    </div>
			    <div class="modal-body">
			      	<label for="mcNamelgm">Itinerary</label>
			      	<textarea id="itinerary" name="itinerary" style="resize: none;" placeholder="Itinerary" class="form-control" ></textarea>
			    </div>
			    <div class="modal-body">
			      	<label for="mcNamelgm">Duration</label>
			      	<input type="text" id="duration" name="duration" value="" placeholder="duration" class="form-control" >
			    </div>
			    <div class="modal-body">
			      	<label for="mcNamelgm">Description</label>
			      	<textarea  id="description" name="description" style="resize: none;" placeholder="description" class="form-control" ></textarea>
			    </div>

			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" onclick="tourCreate()">Create!</button>
			      </div>
		      </form>
		    </div>
		  </div>
	</div>

<?php
include '../partials/footer.php';
    ?>
	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>

<?php
include '../partials/libraryjs.php';
    ?>
</body>
</html>
<?php
} else {
    header('Location:../index.php');
}
?>