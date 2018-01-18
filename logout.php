<?php

	session_start();
	session_destroy();
	if(!isset($_SESSION['user_name']) || empty($_SESSION['user_name']))
		header('location: index.php');
?>