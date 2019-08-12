<?php 

	session_start();
	include('connection.php');
	include_once 'csrf.php';

	function filtrate($datos){
    	$datos = trim($datos); 
    	$datos = stripslashes($datos);
    	return $datos;
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if(isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']){
			$tik = filtrate($_POST['tickets']);
			$errorsbooking = [];
	
			if (empty($tik)) {
				$errorsbooking = "The number tickets is required";
			}
	
			if(!is_numeric($tik)){
				$errorsbooking = "The number tickets must be a number";
			}
	
			if(empty($errorsbooking)){
				$connection = connect();
				$date= date("Y-m-d");
				//$query = "SELECT COUNT(*) FROM t_user_tour";
				$query = "SELECT * FROM tour_user ORDER BY id DESC LIMIT 1";
				$result = mysqli_query( $connection, $query ) or die("Something went wrong in the query to the database");
			
				$lastId = mysqli_fetch_array($result);
				$idtour = $lastId['id'];
				if($idtour == ''){
					$idtour = 0;
				}
				$idtour++;
				
				$query = "INSERT INTO tour_user (id, date, tickets, fk_user, fk_tour, state) VALUES ('".$idtour."','".$date."','".$tik."','".$_SESSION['globaluser']."','".$_SESSION['idtour']."',1)";	
				$result = mysqli_query( $connection, $query );
				if($result){
					header('Location:../user/bookings.php');
				}else{
					echo "error al insertar".mysqli_error($connection);
					var_dump($result);
				}
				disconnect($connection);
			}
		}else{
			header('index.php');
		}
		
	}
 ?>