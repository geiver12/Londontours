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
    $query = "SELECT * FROM comment";
    $result = mysqli_query($con, $query) or die("Something went wrong in the query to the database");
    $user = $result->fetch_array();
    disconnect($con);

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
							<li><a href="tours.php">Tours</a></li>
							<li><a href="bookings.php">Bookings</a></li>
							<li class="active"><a href="#gtco-team">Comments</a></li>

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
									<a href="#gtco-team" class="btn btn-white btn-outline btn-lg">Go Options Available!</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>

		<div class="data-table-area gtco-section" id='gtco-team'>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <div class="table-responsive">
                            <h2>Comments</h2>
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Date</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Message</th>
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
            echo "<td>" . $column['date'] . "</td>";
            echo "<td>" . $column['name'] . "</td>";
            echo "<td>" . $column['email'] . "</td>";
            echo "<td>" . $column['message'] . "</td>";
            $on = 'return confirm("Are you sure?") && ctryDel(' . $column['id'] . ')';

            echo "<td><a class='btn' title='Delete' onclick= '" . $on . "'><i class='glyphicon glyphicon-trash'></i></a></td>";

            echo "</tr>";

        }
        disconnect($connection);
    }
    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Date</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Message</th>
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

		<?php
include '../partials/footer.php';
    ?>

    <!--modal edit user-->
	<div id="myModal" class="modal fade userEditModal" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <form id="userEditModal" action="save.php" method="post" accept-charset="utf-8"
					style="background:#fff;padding:15px;border-radius:5px;">
		      	<div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title">Edit User: # <?php echo $user['id']; ?></h4>
			      </div>
			    <div class="modal-body">
			      	<label for="mcNamelgm">Name</label>
			      	<input type="text" id="name" name="name" value="<?php echo $user['name']; ?>" placeholder="Tickets" class="form-control" >
			    </div>
			    <div class="modal-body">
			      	<label for="mcNamelgm">E-mail</label>
			      	<input type="text" id="email" name="email" value="<?php echo $user['email']; ?>" placeholder="Tickets" class="form-control" >
			    </div>
			    <div class="modal-body">
			      	<label for="mcNamelgm">Phone</label>
			      	<input type="phone" id="phone" name="phone" value="<?php echo $user['phone']; ?>" placeholder="Tickets" class="form-control" >
			    </div>
			    <div class="modal-body">
			      	<label for="mcNamelgm">Postcode</label>
			      	<input type="text" id="postcode" name="postcode" value="<?php echo $user['postcode']; ?>" placeholder="Tickets" class="form-control" >
			    </div>
			    <div class="modal-body">
			      	<label for="mcNamelgm">Address</label>
			      	<input type="text" id="address" name="address" value="<?php echo $user['address']; ?>" placeholder="Tickets" class="form-control" >
			    </div>
			      <div class="modal-body">
			      	<label for="mcNamelgm">Password</label>
			      	<input type="password" id="password" name="password" placeholder="********" class="form-control" >
			      	<input type="hidden" id="passwordC" name="passwordC" value="<?php echo $user['password']; ?>" placeholder="Tickets" class="form-control" >
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" onclick="userUpdt(<?php echo $user['id']; ?>)">Update!</button>
			      </div>
		      </form>
		    </div>

		  </div>
		</div>

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