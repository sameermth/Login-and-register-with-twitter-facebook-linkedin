<?php
	session_start();
	include "conn.php";
	if(!isset($_SESSION['user_name']) || empty($_SESSION['user_name']))
		header("location: index.php");
	
	if(isset($_SESSION['user_name']) && !empty($_SESSION['user_name']))
	{
		$user = $_SESSION['user_name'];
		$sql = "SELECT * FROM user WHERE user_id = '$user';";
		
		$result = $conn->query($sql);
		
		$row = $result->fetch_assoc();
		
		$tr = '<tr>
				<td>Name</td>
				<td>'.$row['name'].'</td>
				</tr>
				<tr>
				<td>User ID</td>
				<td>'.$row['user_id'].'</td>
				</tr>
				<tr>
				<td>Email</td>
				<td>'.$row['email'].'</td>
				</tr>';
	}
	
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Profile</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
		<script type="text/javascript" src="//platform.linkedin.com/in.js">
				api_key:  81axtg5q8583a2
		</script>

    </head>

    <body>

        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                	
                   
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
							<div class="form-box">
									<div class="form-top">
										<div class="form-top-left">
											<h3>Profile Details.</h3>
										</div>
										<div class="form-top-right">
	                        			<a href="logout.php" class = "btn btn-danger">Log Out</a>
	                        		</div>
									</div>
									<div class="form-bottom">
										<table class="table">
										<?php if(isset($tr) && !empty($tr)) echo $tr;?>
										</table>
									</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
									<!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>
        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>
										