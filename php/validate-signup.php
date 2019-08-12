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
		if(isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']){

			 $errors = [];
			 $name =  filtrate($_POST['name']);
			 $email =  filtrate($_POST['email']);
			 $phone=  filtrate($_POST['phone']);
			 $password1=  filtrate($_POST['password']);
			 $password2=  filtrate($_POST['confirm_password']);
			 $postcode = filtrate($_POST['postcode']);
			 $address= filtrate($_POST['address']);
	
			 if ( empty($name) || strlen($name)<5) {
				$errors[] = 'the name is required and at least 5 characters';
			}
	
			if(empty($email)){
				$errors[] = 'The email is required';
			}
	
			if (!validate_email($email)) {
				$errors[] = 'The email is not validate.';
			}
	
			 if(empty($postcode)){
				$errors[] = 'The Postcode is required';
			}
	
			if(empty($address)){
				$errors[] = 'The Address is required';
			}
	
			if(empty($phone)){
				$errors[] = 'The Phone Number is required';
			}
	
			 if(empty($password1) || strlen($password1)<6){
				 $errors[] = "The password is required at leats 6 characters";
			 }
	
			 if($password1 != $password2){
				 $errors[] = "Passwords do not match. try again";
			 }
	
			 if(isset($errors)){
				 foreach ($errors as $value) {
					 echo $value;
					 # code...
				 }
			 }
			 if(empty($errors)){
				 $connection = connect();
				$query = "SELECT * FROM user where email = '".$email."'";
				$query2 = "SELECT id total FROM user order by id desc";
				$result = mysqli_query( $connection, $query ) or die("Something went wrong in the query to the database1");
				$result2 = mysqli_query( $connection, $query2 ) or die("Something went wrong in the query to the database2");
				
				$lastId = (array)$result2->fetch_row();
				$id = $lastId[0];
				$id++;
				$type = 2;
				$passwordHash = password_hash($password1, PASSWORD_DEFAULT);
				if($result->num_rows == 0){
					$queryInsert = "INSERT INTO user (id,name, email,password, address,postcode, phone,type) VALUES ('".$id."','".$name."','".$email."','".$passwordHash."','".$address."','".$postcode."','".$phone."','".$type."');";
					$insert_result =  mysqli_query( $connection, $queryInsert );
					if ($insert_result) {
						
						$_SESSION['globaluser'] = $id;
						$_SESSION['roluser'] = $type;
						 header('Location:../user/index.php');
						
					}else{
						//header('Location:../user/index.php');
						echo "error inserting".mysqli_error($connection);
						var_dump($insert_result);
						die();
					}
				}else{
					header('Location:../user/index.php');
					echo "Email is register already";
				}
				disconnect($connection);
			 }
		 
		}else{
			die('csrf?');
			header('../user/index.php');
		}
	}

 ?>