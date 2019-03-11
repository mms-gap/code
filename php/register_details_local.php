<?php
	session_start();
	
	$_SESSION["ID"]=$_POST["ID"];
	$_SESSION["firstName"]=$_POST["firstName"];
	$_SESSION["lasttName"]=$_POST["lasttName"];
	$_SESSION["userName"]=$_POST["userName"];
	$_SESSION["Password"]=$_POST["Password"];
	$_SESSION["Email"]=$_POST["Email"];
	$_SESSION["Age"]=$_POST["Age"];
	$_SESSION["State"]=$_POST["State"];
	$_SESSION["Address"]=$_POST["Address"];
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
						
						$id=$_POST["ID"];
						$first_name=$_POST["firstName"];
						$last_name=$_POST["lasttName"];
						$user_name=$_POST["userName"];
						$password_name=$_POST["Password"];
						$email=$_POST["Email"];
						$age=$_POST["Age"];
						$state=$_POST["State"];
						$address=$_POST["Address"];
						$user_type = $_POST['UserType'];
						
						$sql_u = "SELECT Username 
								  FROM users 
								  WHERE Username like '%".$user_name."'";
						$result_u=mysqli_query($conn,$sql_u);
						$sql_e = "SELECT email 
								  FROM users 
								  WHERE Email like '%".$email."'";
						$result_e=mysqli_query($conn,$sql_e);
						$sql_id = "SELECT ID_Number 
								   FROM users 
								   WHERE 
								   ID_Number = '".$id."'";
						$result_id=mysqli_query($conn,$sql_id);

						if (mysqli_num_rows($result_u)) {
								echo  "Sorry... User Name already taken '".$user_name."'"; 	
							}
						else if(mysqli_num_rows($result_e)){
								echo  "Sorry... email already taken '".$email."'";
						}
						else if(mysqli_num_rows($result_id)){
								echo  "Sorry... ID already taken '".$id."'";
						}
						else{
						if (isset($_POST['UserType'])){
							$user_type = $_POST['UserType'];
				
						switch ($user_type) {
						case 'Patient':

						$sql="INSERT INTO patients(ID_Number
												,First_Name
												,Last_Name
												,Username
												,Password
												,Email
												,Age
												,State
												,Address
												,usertype) 
							VALUES 
												('".$id."','
												".$first_name."','
												".$last_name."','
												".$user_name."','
												".$password_name."','
												".$email."','
												".$age."','
												".$state."','
												".$address."','
												".$user_type."');";
						
						if (mysqli_query($conn, $sql)) {
							header("Location: patient.php");
							exit;
								} 
								else {
									echo "Error: " . $sql . "<br>" . mysqli_error($conn);
								}

						mysqli_close($conn);
						break;
						
						case 'Doctor':

						$sql="INSERT INTO doctors (ID_Number
												,First_Name
												,Last_Name
												,Username
												,Password
												,Email
												,Age
												,State
												,Address
												,usertype) 
							VALUES 
												('".$id."','
												".$first_name."','
												".$last_name."','
												".$user_name."','
												".$password_name."','
												".$email."','
												".$age."','
												".$state."','
												".$address."','
												".$user_type."');";
							if (mysqli_query($conn, $sql)) {
								header("Location: doctor.php");
								exit;
									} 
									else {
										echo "Error: " . $sql . "<br>" . mysqli_error($conn);
									}

							mysqli_close($conn);
						break;
						
						case 'Trainer':

							$sql="INSERT INTO trainers(ID_Number
												,First_Name
												,Last_Name
												,Username
												,Password
												,Email
												,Age
												,State
												,Address
												,usertype) 
							VALUES 
												('".$id."','
												".$first_name."','
												".$last_name."','
												".$user_name."','
												".$password_name."','
												".$email."','
												".$age."','
												".$state."','
												".$address."','
												".$user_type."');";
							if (mysqli_query($conn, $sql)) {
								header("Location: trainer.php");
								exit;
									} 
									else {
										echo "Error: " . $sql . "<br>" . mysqli_error($conn);
									}

							mysqli_close($conn);
						break;
						
						case 'Nutrition':

						$sql="INSERT INTO nutritionists(ID_Number
												,First_Name
												,Last_Name
												,Username
												,Password
												,Email
												,Age
												,State
												,Address
												,usertype) 
							VALUES 
												('".$id."','
												".$first_name."','
												".$last_name."','
												".$user_name."','
												".$password_name."','
												".$email."','
												".$age."','
												".$state."','
												".$address."','
												".$user_type."');";
							if (mysqli_query($conn, $sql)) {
								header("Location: nutritionist.php");
								exit;
									} 
									else {
										echo "Error: " . $sql . "<br>" . mysqli_error($conn);
									}

							mysqli_close($conn);
						break;
					}
				}
			}

?>