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
						
						$sql = "select patientID from  patientanddoctorrelated where patientID = '".$_SESSION["ID"]."';";
						$true=mysqli_query($conn, $sql);
						if (mysqli_num_rows($true)) {
								if (isset($_POST['doc'])){
									$docID = $_POST["doc"];
									$sql3 = "ALTER TABLE patientanddoctorrelatedwhere DROP COLUMN DoctorID";
									mysqli_query($conn, $sql3);
									$sql2="UPDATE patientanddoctorrelated set DoctorID = '".$docID."' where patientID = '".$_SESSION["ID"]."';";
								mysqli_query($conn, $sql2);
								}
							}
						else
							if (isset($_POST['doc'])){
								$docID = $_POST["doc"];
								$sql2="INSERT INTO patientanddoctorrelated(patientID,trainerID)
									VALUES('".$_SESSION["ID"]."','
									".$docID."');";
								mysqli_query($conn, $sql2);
							}
							
							
						$sql_t = "select patientID from  patientandtrainerrelated where patientID = '".$_SESSION["ID"]."';";
						$true_t=mysqli_query($conn, $sql_t);
						if (mysqli_num_rows($true_t)) {
								if (isset($_POST['trainer'])){
									$trainerID = $_POST["trainer"];
									$sql2_t="UPDATE patientandtrainerrelated set trainerID = '".$trainerID."' where patientID = '".$_SESSION["ID"]."';";
								mysqli_query($conn, $sql2_t);
								}
							}
						else
							if (isset($_POST['trainer'])){
								$trainerID = $_POST["trainer"];
								$sql23_t="INSERT INTO patientandtrainerrelated(patientID,trainerID)
									VALUES('".$_SESSION["ID"]."','
									".$trainerID."');";
								mysqli_query($conn, $sql23_t);
							}
							
						header("Location: patient.php");
						mysqli_close($conn);
?>