<?php 
	function connect(){
		$user = "root";
		$pass = "";
		$server = "localhost";
		$database = "dblondontours";

		$connection = mysqli_connect( $server, $user, $pass,$database ) or die ("Unable to connect to the Database server");
		mysqli_set_charset($connection,"utf8");
		return $connection;
	}

	function disconnect($connection){
		$close = mysqli_close($connection);
	}
 ?>