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
						
if(isset($_POST["submitPicture"])) {
	$ImageName = $_FILES['profile_photo']['name'];
	$fileElementName = 'photo';
	$path = '../images/'; 
	$location = $path . $_FILES['profile_photo']['name']; 
	move_uploaded_file($_FILES['profile_photo']['tmp_name'], $location);
	$sql="INSERT INTO images (id,image) 
					   VALUES ('".$_SESSION["ID"]."','".$_FILES['profile_photo']['name']."');";
	mysqli_query($conn, $sql);
}

	$sql2="SELECT image from images where id = '".$_SESSION["ID"]."';";
	$sth=mysqli_query($conn, $sql2);
	if (mysqli_num_rows($sth)) {
		$result_temp=mysqli_fetch_array($sth,MYSQLI_ASSOC);
		$result="../images/".$result_temp["image"];
	}
	else
		$result="../images/img_avatar.png";
	
if (isset($_POST['Patient_id'])){
		$Patient_id = $_POST["Patient_id"];
		$sql3 = "select * from patients where ID_Number = ". $Patient_id. ";";
		$Patient=mysqli_query($conn, $sql3);
			if (mysqli_num_rows($Patient)) {
				$PatientID=mysqli_fetch_array($Patient,MYSQLI_ASSOC);
				$_SESSION["patientID"] = $PatientID["ID_Number"];
			}
}
	else{
		$PatientID_temp= "";
			}
if (isset($_POST['Patient_id'])){	
	$sql4="SELECT image from images where id = '".$PatientID["ID_Number"]."';";
	$sth4=mysqli_query($conn, $sql4);
	if (mysqli_num_rows($sth)) {
		$result_temp4=mysqli_fetch_array($sth4,MYSQLI_ASSOC);
		$result4="../images/".$result_temp4["image"];
	}
}
	else
		$result4="../images/img_avatar.png";
	
		
			if(isset($_POST['Patient_id'])){
				$sql_medical = "select * from medicalplan where patient_ID = ". $Patient_id. ";";
				$Patient_plan=mysqli_query($conn, $sql_medical);
				if (mysqli_num_rows($Patient_plan)) {
					$Patient_planID=mysqli_fetch_array($Patient_plan,MYSQLI_ASSOC);
				}
				else{
				$Patient_planID = array("Goals","Targets","Restrictions");
				$Patient_planID['Goals'] = "";
				$Patient_planID['Targets']= "";
				$Patient_planID['Restrictions'] = "";
				}
			}
			else{
				$Patient_planID = array("Goals","Targets","Restrictions");
				$Patient_planID['Goals'] = "";
				$Patient_planID['Targets']= "";
				$Patient_planID['Restrictions'] = "";
			}
				
	
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<!----Title---->
		<title>MMS-GAP</title>
	<!----Meta---->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	<!----Style---->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/doctor.css">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!----Script---->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		
</head>

<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">


<nav class="navbar navbar-fixed-top" id="navbar_home">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-center">
	   <li><a href="#">Profile</a></li>
        <li><a href="#">Programs</a></li>
        <li><a href="#">Make an appointment</a></li>
        <li><a href="#">Plan Progress</a></li>
        <li><a href="#">Forum</a></li>
        <li><a href="#">Notifications</a></li>
		<li><a href="#">Help</a></li>
      </ul>
    </div>
  </div>
</nav>

<header>
		<center>
			<div class="container">
				<div class="row">
						<div class="logo">
							<a href="mms-gapHome.html">
								<img src="../images/mms-gap.png" class="img-responsive" alt="LOGO MMS-GAP" id="header_logo">
							</a>
						</div>
				</div>
			</div>
		</center>
</header>
<main class="bg">
	<section>
		<div class="row ">
			<div class="col-md-3 " id="profile_picture">
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
				<?php echo '<img src="'.$result.'" alt="Your picture" id="avatar" style="width:100px"  class="w3-circle w3-hover-opacity text-center">'?>
				<form action="" method="post" enctype="multipart/form-data">
				<input id="imageUpload" type="file" name="profile_photo" placeholder="Photo" required="" capture>
				<input type="submit" value="Upload Image" id="Upload" class="btn btn-warning" name="submitPicture" style="display:none">
				</form>
				<h2 ><b>Welcome DR. <?php echo $_SESSION["lasttName"]. ' ' .$_SESSION["firstName"];?></h2><br><br>
				<button type="button" class="btn btn-primary"><b>Edit Your Profile<a href="#" ></a></button>
				<p></p><br>
				<form action="" method="post">
					<p><label>Choose your Patient:<select id="Patient_id" name="Patient_id" class="form-control">
							<?php
								$sql_p = "select * from patients as p inner join patientanddoctorrelated as rl on p.ID_Number = rl.patientID where rl.doctorID like '%". $_SESSION["ID"]. "%';";
								$result_p = mysqli_query($conn, $sql_p);
									if (mysqli_num_rows($result_p) > 0) {
										// output data of each row
									while($row_p = mysqli_fetch_assoc($result_p)) {
									echo '<option value="' . $row_p['ID_Number']. '">' . $row_p['First_Name']. $row_p['Last_Name'].'</option>';
									}
										} 
									else
										echo '<option value="No result">no result</option>';
								?>
					</p></select></label>
					<button type="submit" class="btn btn-primary">Save</button>
				</form>
			<div class="row">
				<img src="../images/google-calendar-logo.png" class="img-responsive" alt="Google Calendar"style="width:200px;">
				<iframe src="../html/calendar.html" border="0" scrolling="no" frameborder="0" style="height:300px ">
				</iframe>
				
			</div>
			</div>
			
			<div class="col-md-9 " id="Your_patient">
			<h5><b>Your Patient:</h5>
			<div id="border">
			<div class="row">
				<img src=<?php echo $result4 ?> alt="Your_Patient_picture" id="avatar_Patient" style="width:100px; float:left; margin-left:20px;"  class="w3-circle w3-hover-opacity text-center">
				<div class="h3_titles">
					<br><h3 style="display:inline-block"><b>mr. 
					<?php
					if (isset($_POST['Patient_id'])){
					echo $PatientID["Last_Name"]. ' ' .$PatientID["First_Name"];
					}
					else
						echo $PatientID_temp;
					?>
					</h3><br>
					<h3 style="display:inline-block" id="patientID"><b>ID: 
					<?php
					if (isset($_POST['Patient_id'])){
					echo  $PatientID["ID_Number"];
					}
					else
						echo $PatientID_temp;
					?>
					</h3>
				</div>
			</div>
			<div class="clear"></div>
			<div class="row container-fluid" id="medical_program">
				<div class="col-md-6">
					<div class="text-center" id="goals">
						<br><h3><b><u>Goals:</u></b></h3>
						<p id="MyGoals"></p><br>
						<h3><b><u>Targets:</u></b></h3>
						<p id="MyTargets"></p>
						<button type="button" id="btn1" class="btn btn-primary" onclick="document.getElementById('goals-modal').style.display='block'"><b>Edit/View<a href="#" ></a></button>
						<div id="goals-modal" class="modal">
						<form class="modal-content1 animate" action="paitent_medicalP.php" method="post">
						
							<div class="container-fluid">
								<span onclick="document.getElementById('goals-modal').style.display='none'" class="close" >&times;</span>
									<br><h3><b><u>Goals:</u></b></h3>
									<textarea class="input" placeholder="Enter Goals" name="Goals"><?php echo $Patient_planID['Goals']; ?></textarea>
									<h3><b><u>Targets:</u></b></h3>
									<textarea  class="input" placeholder="Enter Targets" name="Targets"><?php echo $Patient_planID['Targets']; ?></textarea>
									<button type="submit" class="btn btn-primary">Save</button>
							</div>
						</form>
						</div>
						
					</div>
				</div>
				<div class="col-md-6">
					<div class="text-center" id="Restrictions">
						<br><h3><b><u>Restrictions:</u></b></h3>
						<p id="MyRestrictions"></p><br>
						<button type="button" id="btn2" class="btn btn-primary" onclick="document.getElementById('RestrictionsForm').style.display='block'"><b>Edit/View<a href="#" ></a></button>
						<div id="RestrictionsForm" class="modal">
						<form class="modal-content2 animate" action="paitent_medicalP.php" method="post">
							<div class="container-fluid">
								<span onclick="document.getElementById('RestrictionsForm').style.display='none'" class="close" >&times;</span>
								<br><h3><b><u>Restrictions:</u></b></h3>
								<textarea class="input" placeholder="Enter Restrictions" name="Restrictions"><?php echo $Patient_planID['Restrictions']; ?></textarea>
									<button type="submit" class="btn btn-primary">Save</button>
							</div>
						</form>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
			<center>
				<div class="col-md-12">
					<img src="../images/positive-d005-512.png" alt="Your picture" id="runing icon" style="width:80px; height:67px; float:left;">
					<br><p class="patientName" style="float:left;"><u> - Training Program.PDF</p>
					<button type="button" id="btn3" class="btn btn-warning"><b>Comments<a href="#"></a></button><br><Br><br>
				</div>
				<div class="col-md-12">
					<img src="../images/nutrition-icon-7533.png" alt="Your picture" id="runing icon" style="width:80px; height:67px; float:left;">
					<br><p class="patientName" style="float:left"><u> - Food Program.PDF</p>
					<button type="button" id="btn4" class="btn btn-warning"><b>Comments<a href="#"></a></button>
				</div>
			</center>
			</div>
			</div>
			</div>
		</div>
	
	</section>

</main>
<footer class="navbar-default navbar-bottom row" id="footer_main">
			<div class="container-fluid">
				<div class="col-md-4 text-center">
                      <img src="../images/mms-gap.png" class="img-responsive" alt="LOGO MMS-GAP" id="footer_logo">
					  <p class="text-md-left grey-text">© Copyright: <a href="mms-gap.html"><strong> MMS-GAP</strong></a></p>
                  </div>
				  <div class="col-md-2 text-center">
                      <h5 class="text-uppercase mb-4 mt-3 font-weight-bold">Category</h5>
                      <p>Product</p>
					  <p>About Us</p>
					  <p>Downloads</p>
					  <p>Team</p>
                  </div>
				  
				  <div class="col-md-2 text-center">
                      <h5 class="text-uppercase mb-4 mt-3 font-weight-bold">Management</h5>
                      <p>Resources</p>
					  <p>Institutions</p>
					  <p>Locations</p>
					  <p>Contact</p>
                  </div>
				  <div class="col-md-2 text-center">
                      <p><a href="#" class="btn btn-primary">Back to top</a></p><br>
				  </div>
			</div>
</footer>
<script>
var modal = document.getElementById('goals-modal');


window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
<script>
$("#avatar").click(function(e) {
    $("#imageUpload").click();
});

function fasterPreview( uploader ) {
    if ( uploader.files && uploader.files[0] ){
          $('#avatar').attr('src', 
             window.URL.createObjectURL(uploader.files[0]) );
    }
}

$("#imageUpload").change(function(){
    fasterPreview( this );
});

var modal = document.getElementById('Upload');


window.onclick = function(event) {
    if (event.target == imageUpload) {
        modal.style.display = "block";
    }
}
</script>

</body>
</html>
