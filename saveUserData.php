<?php
session_start();
include 'conn.php';

if(isset($_POST['userData'])){
$userData = json_decode($_POST['userData']);
if(!empty($userData)){
    $oauth_provider = $_POST['oauth_provider'];
	$num = rand(1000, 9999);
	$password = $userData->firstName.(string)$num;
    
    $prevQuery = "SELECT * FROM users WHERE oauth_provider = '".$oauth_provider."' AND oauth_uid = '".$userData->id."'";

    $prevResult = $conn->query($prevQuery);
	
    if($prevResult->num_rows > 0){
        $query = "UPDATE users SET first_name = '".$userData->firstName."', last_name = '".$userData->lastName."', email = '".$userData->emailAddress."', location = '".$userData->location->name."', picture = '".$userData->pictureUrl."', profile_url = '".$userData->publicProfileUrl."', modified = '".date("Y-m-d H:i:s")."' WHERE oauth_provider = '".$oauth_provider."' AND oauth_uid = '".$userData->id."'";
        $update = $conn->query($query);
    }
	else{
        //Insert user data
        $query = "INSERT INTO users SET oauth_provider = '".$oauth_provider."', oauth_uid = '".$userData->id."', first_name = '".$userData->firstName."', last_name = '".$userData->lastName."',password = '".$password."', email = '".$userData->emailAddress."', location = '".$userData->location->name."', picture = '".$userData->pictureUrl."', profile_url = '".$userData->publicProfileUrl."', created = '".date("Y-m-d H:i:s")."', modified = '".date("Y-m-d H:i:s")."'";
        $insert = $conn->query($query);
    }
    
}
die('success');
}
?>