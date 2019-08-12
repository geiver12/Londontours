<?php 
	session_start();
	include_once 'csrf.php';
	if (isset($_SESSION['globaluser'])) {
		unset($_SESSION['globaluser']);
		unset($_SESSION['roluser']);
	}
	session_destroy();
	header("Location:../index.php");
 ?>