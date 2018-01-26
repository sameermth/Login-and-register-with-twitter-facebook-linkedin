<?php

session_start();
include 'conn.php';


if(isset($_POST['signin']))
{	
	$user_name = $_POST['username'];
	$password  = $_POST['password'];
	$q="SELECT * FROM user WHERE user_id='$user_name' and password='$password'";
	$result = $conn->query($q);
	
    if(($result->num_rows)>0)
	{
		$row=$result->fetch_assoc();
		$_SESSION['user_name']=$row["user_id"];
		header("location: profile.php");
	}
	else
	{
		$error='<div class="alert alert-danger">
						<button type="button" aria-hidden="true" class="close">×</button>
						<span>Invalid User name or Password.</span>
					</div>
		';
	}
}

if ( isset ($_POST["signup"] ))
{
	$first_name = $_POST["first_name"];
	$last_name  = $_POST["last_name"];
	$name       = $first_name." ".$last_name;
	$email      = $_POST["email"];
	$username   = $_POST["username"];
	$password   = $_POST["password"];
	
	$sql_email = "SELECT * FROM user WHERE email = '$email';";
	$sql_username = "SELECT * FROM user WHERE user_id = '$username';";
	
	
	if( $conn->query($sql_email) === TRUE){
		$error_email='<div class="alert alert-danger">
						<span>Email Registered.</span>
					</div>
		';
	}
	if( $conn->query($sql_username) === TRUE){
		$error_username='<div class="alert alert-danger">
						<span>User Name Registered.</span>
					</div>
		';
	}
	
	if(!isset($error_username) && !isset($error_email))
	{
		$sql = "INSERT INTO `user` (`id`, `name`, `user_id`, `email`, `password`) VALUES (NULL, '$name', '$username', '$email', '$password');";
		
		if( $conn -> query($sql) === TRUE ){
			$success_registration='<div class="alert alert-success">
						<span>Registration Successfull, Login Now.</span>
					</div>';
		}
	}
}
if(isset($_SESSION['user_name']) && !empty($_SESSION['user_name']))
	header("location: profile.php");
if(isset($_SESSION['facebook_access_token']))
	header("location: fbLogin.php");
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login or Register</title>

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
				authorize: true
				onLoad: onLinkedInLoad
				scope: r_basicprofile r_emailaddress
		</script>


    </head>

    <body>

        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                	
                   
                    <div class="row" id="login-register-form" >
                        <div class="col-sm-5">
                        	
                        	<div class="form-box">
	                        	<div class="form-top">
	                        		<div class="form-top-left">
	                        			<h3>Login to our site</h3>
	                            		<p>Enter username and password to log on:</p>
	                        		</div>
	                        		<div class="form-top-right">
	                        			<i class="fa fa-key"></i>
	                        		</div>
									
									
									
	                            </div>
	                            <div class="form-bottom">
									<?php  if(isset($error)) echo $error;  ?>
				                    <form role="form" action="" method="post" class="login-form">
				                    	<div class="form-group">
				                    		<label class="sr-only" for="form-username">Username</label>
				                        	<input type="text" name="username" placeholder="Username..." class="form-username form-control" id="form-username">
				                        </div>
				                        <div class="form-group">
				                        	<label class="sr-only" for="form-password">Password</label>
				                        	<input type="password" name="password" placeholder="Password..." class="form-password form-control" id="form-password">
				                        </div>
				                        <button type="submit" class="btn" name = "signin">Sign in!</button>
				                    </form>
			                    </div>
		                    </div>
		                
		                	<div class="social-login">
	                        	<h3>...or login with:</h3>
	                        	<div class="social-login-buttons">
		                        	<div>
									<script type="in/Login"></script>
									</div>
		                        	<a class="btn btn-link-1 btn-link-1-twitter" href="#">
		                        		<i class="fa fa-twitter"></i> Twitter
		                        	</a>
									<a href="/fbLogin.php" class="btn btn-link-1 btn-link-1-facebook">
										<i class="fa fa-facebook"></i>Facebook
									 </a>
		                        	
	                        	</div>
	                        </div>
	                        
                        </div>
                        
                        <div class="col-sm-1 middle-border"></div>
                        <div class="col-sm-1"></div>
                        	
                        <div class="col-sm-5">
                        	
                        	<div class="form-box">
							
                        		<div class="form-top">
	                        		<div class="form-top-left">
	                        			<h3>Sign up now</h3>
	                            		<p>Fill in the form below to get instant access:</p>
	                        		</div>
	                        		<div class="form-top-right">
	                        			<i class="fa fa-pencil"></i>
	                        		</div>
	                            </div>
	                            <div class="form-bottom">
									<?php if(isset($success_registration)) echo $success_registration; ?>
				                    <form role="form" action="" method="post" class="registration-form">
				                    	<div class="form-group">
				                    		<label class="sr-only" for="form-first-name">First name</label>
				                        	<input type="text" name="first_name" placeholder="First name..." class="form-first-name form-control" id="form-first-name">
				                        </div>
				                        <div class="form-group">
				                        	<label class="sr-only" for="form-last-name">Last name</label>
				                        	<input type="text" name="last_name" placeholder="Last name..." class="form-last-name form-control" id="form-last-name">
				                        </div>
										<div class="form-group">
				                        	<label class="sr-only" for="form-user-name">User Name</label>
				                        	<input type="text" name="username" placeholder="User Name..." class="form-user-name form-control" id="form-user-name">
											<?php if( isset($error_username) && !empty($error_username)) echo $error_username; ?>
				                        </div>
				                        <div class="form-group">
				                        	<label class="sr-only" for="form-email">Email</label>
				                        	<input type="text" name="email" placeholder="Email..." class="form-email form-control" id="form-email" required>
											<?php if( isset($error_email) && !empty($error_email)) echo $error_email; ?>
				                        </div>
				                       <div class="form-group">
				                        	<label class="sr-only" for="form-password">Password</label>
				                        	<input type="password" name="password" placeholder="Password....." class="form-password form-control" id="form-password">
				                        </div>
				                       
				                        <button type="submit" class="btn" name = "signup">Sign me up!</button>
				                    </form>
			                    </div>
                        	</div>
                        	
                        </div>
                    </div>
					<div class="row" id="profileData" style="display: none;" >
                        <div class="col-sm-6 col-sm-offset-3">
                        	
                        	<div class="form-box">
	                        	<div class="form-top">
								<div>
								<div class="text text-right">
									<input type="button" class="btn btn-right btn-danger" onclick="logout()" value="Log Out" />
								</div>
								</div>
	                        		<div class="form-top-left">
	                        			<h3 id="profile-name"></h3>
	                        		</div>
	                        		<div class="form-top-right" id="profile-image">
	                        			
	                        		</div>
									
									
									
	                            </div>
	                            <div class="form-bottom">
				                    	<div class="form-group">
				                    		<label class="sr-only" for="form-intro">Intro</label>
				                        	<p id="intro"></p>
				                        </div>
										<div class="form-group">
				                    		<label class="sr-only" for="form-email">Email</label>
				                        	<p id="email"></p>
				                        </div>
										<div class="form-group">
				                    		<label class="sr-only" for="form-location">Location</label>
				                        	<p id="location"></p>
				                        </div>
										<div class="form-group">
				                    		<label class="sr-only" for="form-link">Profile Url</label>
				                        	<p id="link"></p>
				                        </div>
								</div>
							</div>
						</div>
					</div>          
                </div>
            </div>
            
        </div>

       
        <!-- Javascript -->
		<script type="text/javascript">
		
function checkLoginState() {
  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });
}
		
    function onLinkedInLoad() {
        IN.Event.on(IN, "auth", getProfileData);
    }
    
    
    function getProfileData() {
        IN.API.Profile("me").fields("id", "first-name", "last-name", "headline", "location", "picture-url", "public-profile-url", "email-address").result(displayProfileData).error(onError);
    }

    
    function displayProfileData(data){
		
		document.getElementById("login-register-form").style.display = 'none';
        var user = data.values[0];
        document.getElementById("profile-image").innerHTML = '<img src="'+user.pictureUrl+'" />';
        document.getElementById("profile-name").innerHTML = user.firstName+' '+user.lastName;
        document.getElementById("intro").innerHTML = user.headline;
        document.getElementById("email").innerHTML = user.emailAddress;
        document.getElementById("location").innerHTML = user.location.name;
        document.getElementById("link").innerHTML = '<a href="'+user.publicProfileUrl+'" target="_blank">Visit profile</a>';
        document.getElementById('profileData').style.display = 'block';
		saveUserData(user);
		
		
    }

    
    function onError(error) {
        console.log(error);
    }
    
    
    function logout(){
        IN.User.logout(removeProfileData);
    }
    
    
    function removeProfileData(){
        document.getElementById('profileData').remove();
		document.getElementById("login-register-form").style.display = 'block';
    }
	
	function saveUserData(userData){
		
			$.post("http://localhost/saveUserData.php", {oauth_provider:'linkedin',userData: JSON.stringify(userData)}, function(data){ 
			alert ("Data Loaded: " + data )});
		
	}
</script>
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>
		
        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>