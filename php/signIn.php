<?php
	session_start();
	
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
	
	$user_name=$_POST["userName"];
						
	$sql_u = "SELECT ID_Number
					,First_Name
					,Last_Name
					,Username
					,Password
					,Email
					,Age
					,State
					,Address
				FROM users
				WHERE Username like '%".$user_name."'";
	$result_u=mysqli_query($conn,$sql_u);
				
	$row=mysqli_fetch_array($result_u,MYSQLI_ASSOC);
	
	$_SESSION["ID"]=$row["ID_Number"];
	$_SESSION["firstName"]=$row["First_Name"];
	$_SESSION["lasttName"]=$row["Last_Name"];
	$_SESSION["userName"]=$row["Username"];
	$_SESSION["Password"]=$row["Password"];
	$_SESSION["Email"]=$row["Email"];
	$_SESSION["Age"]=$row["Age"];
	$_SESSION["State"]=$row["State"];
	$_SESSION["Address"]=$row["Address"];
?>



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
						
						$user_name=$_POST["userName"];
						$password_name=$_POST["Password"];
						
						$sql_u_d = "SELECT Username 
								  FROM doctors 
								  WHERE Username like '%".$user_name."'";
						$result_u_d=mysqli_query($conn,$sql_u_d);
						$sql_p_d = "SELECT Password 
								  FROM doctors 
								  WHERE Password like '%".$password_name."'";
						$result_p_d=mysqli_query($conn,$sql_p_d);
						
					
						$sql_u_n = "SELECT Username 
								  FROM nutritionists 
								  WHERE Username like '%".$user_name."'";
						$result_u_n=mysqli_query($conn,$sql_u_n);
						$sql_p_n = "SELECT Password 
								  FROM nutritionists 
								  WHERE Password like '%".$password_name."'";
						$result_p_n=mysqli_query($conn,$sql_p_n);
					
						$sql_u_p = "SELECT Username 
								  FROM patients 
								  WHERE Username like '%".$user_name."'";
						$result_u_p=mysqli_query($conn,$sql_u_p);
						$sql_p_p = "SELECT Password 
								  FROM patients 
								  WHERE Password like '%".$password_name."'";
						$result_p_p=mysqli_query($conn,$sql_p_p);
				
						$sql_u_t = "SELECT Username 
								  FROM trainers 
								  WHERE Username like '%".$user_name."'";
						$result_u_t=mysqli_query($conn,$sql_u_t);
						$sql_p_t = "SELECT Password 
								  FROM trainers 
								  WHERE Password like '%".$password_name."'";
						$result_p_t=mysqli_query($conn,$sql_p_t);
				

						if (mysqli_num_rows($result_u_t) && mysqli_num_rows($result_p_t)){
		
						header("Location: trainer.php");
						exit;
					}
					
					else if (mysqli_num_rows($result_u_d) && mysqli_num_rows($result_p_d)){
		
						header("Location: doctor.php");
						exit;
					}
					
					else if (mysqli_num_rows($result_u_p) && mysqli_num_rows($result_p_p)){
		
						header("Location: patient.php");
						exit;
					}
					
					else if (mysqli_num_rows($result_u_n) && mysqli_num_rows($result_p_n)){
		
						header("Location: nutritionist.php");
						exit;
					}
					else{
						echo "The User Name or the Password not correct";
					}
					

?>