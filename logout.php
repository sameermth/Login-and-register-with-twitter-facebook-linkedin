<?php

	session_start();
	require_once 'fbConfig.php';

	if(isset($_SESSION['facebook_access_token']))
		unset($_SESSION['facebook_access_token']);

	if(isset($_SESSION['userData']))
		unset($_SESSION['userData']);
	if(isset($_SESSION['user_name']))
		unset($_SESSION['user_name']);
	
	session_destroy();
	if(!isset($_SESSION['user_name']) || empty($_SESSION['user_name']))
		header('location: index.php');
	
	echo $_SESSION['user_name'];
?>