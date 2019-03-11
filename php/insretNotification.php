<?php
 	$servername = "127.0.0.1";
	$username = "root";
	$password="newpass";
	$dbname = "test_mms_gap";
						
	// Create connection
	$conn = new mysqli($servername, $username,$password,$dbname);
	// Check connection
	if ($conn->connect_error) {
		 die("Connection failed: " . $conn->connect_error);
	} 
	
if(isset($_POST["subject"])){
 
$subject =  $_POST["subject"];

$comment =  $_POST["comment"]);
 
$query = "INSERT INTO comments(comment_subject, comment_text)VALUES ('".$subject."', '".$comment."');";
 
mysqli_query($con, $query);
 
}
?>
 