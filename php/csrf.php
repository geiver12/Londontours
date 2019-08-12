<?php

//try here csrf protection
if(!isset($_SESSION['csrf_token'])){
	$_SESSION['csrf_token'] = base64_encode(openssl_random_pseudo_bytes(32));
}

?>