<?php
	session_start();
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
						$patientID = $_SESSION["patientID"];
						$sql = "select patient_ID from  medicalplan where patient_ID = '".$patientID."';";
						$true=mysqli_query($conn, $sql);
						if (mysqli_num_rows($true)) {
								if (isset($_POST['Goals'])){
									$Goals = $_POST["Goals"];
									echo $Goals;
									$sql24="UPDATE medicalplan set Goals = '".$Goals."' where patient_ID = '".$patientID."';";
								mysqli_query($conn, $sql24);
								}
								if (isset($_POST['Targets'])){
									$Targets = $_POST["Targets"];
									$sql21="UPDATE medicalplan set Targets = '".$Targets."' where patient_ID = '".$patientID."';";
								mysqli_query($conn, $sql21);
								}
								else if (isset($_POST['Restrictions'])){
									$Restrictions = $_POST["Restrictions"];
									echo $Restrictions;
									$sql22="UPDATE medicalplan set Restrictions = '".$Restrictions."' where patient_ID = '".$patientID."';";
								mysqli_query($conn, $sql22);
								}
							}
						else
							if (isset($_POST['Goals'])){
								$Goals = $_POST["Goals"];
								$Targets = $_POST["Targets"];
								$sql_g="INSERT INTO medicalplan (patient_ID, Golas,Targets)
									VALUES('".$patientID."','".$Goals."','".$Targets."');";
								mysqli_query($conn, $sql_g);
							}
						header("Location: doctor.php");
						mysqli_close($conn);
?>