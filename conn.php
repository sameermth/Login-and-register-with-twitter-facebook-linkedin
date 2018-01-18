<?php

	$host = "localhost";
	$uid  = "root";
	$pass = "";
	$db   = "internship";
	
	$conn = new mysqli($host, $uid, $pass, $db);
	
	if(!$conn)
	{
		echo "database error".die(mysql_error);
	}
?>