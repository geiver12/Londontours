<?php
	
	session_start();
	include_once 'csrf.php';
	require('../lib/password.php');
	include('connection.php');

	function filtrate($data){
    	$data = trim($data); 
    	$data = stripslashes($data);
    	return $data;
	}
	function validate_email($email){
        return (filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) ? False : True;
    }

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if(isset($_POST['csrf_token']) && $_POST['csrf_token'] == $_SESSION['csrf_token']){
			$username = filtrate($_POST['email']);
			$pass = filtrate($_POST['password']);
			$emailval = validate_email($username);
			$errors = [];
			$error2 = [];
	 
	
			if(empty($username)){
				$errors[] = 'The email is required.';
			}
	
			if(!filter_var($username, FILTER_VALIDATE_EMAIL)){
				$errors[] = "The email is not valid.";
			}
	
			if(empty($pass)){
				$errors[] = "The password is required at leats 8 characters."; 
			}
	
			if(empty($errors)){
				$connection = connect();
				$query = "SELECT id,password,type FROM user where email ='".$username."'";
				$result = mysqli_query( $connection, $query ) or die("Something went wrong in the query to the database");
				if($result->num_rows > 0){
					$hash = $result->fetch_array();
					if(password_verify($pass, $hash['password'])){
						$_SESSION['globaluser'] = $hash['id'];
						$_SESSION['roluser'] = $hash['type'];
						if($hash['type']==1){
							header('Location:../admin/index.php');
						}else{
							header('Location:../user/index.php');
						}
						disconnect($connection);
					}else{
						$error2[] = "Password incorrect<br>";
						header('Location:../user/index.php?m='.implode('<br>',$error2));
					}
				}else{
					$error2[] = "User is not registered<br>";
					header('Location:../user/index.php?m='.implode('<br>',$error2));
				}
				disconnect($connection);
			}
			else{
	
				header('Location:../user/index.php?m='.implode('<br>',$errors));
			}
		}else{
			echo 'invalid token!';
			header('Location: ../index.php');
		}
	}	
 ?>