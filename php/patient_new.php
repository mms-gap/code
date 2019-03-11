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
	
	$sql3="select * from doctors as d inner join patientanddoctorrelated as rl on d.ID_Number = rl.DoctorID;";
	$Doc=mysqli_query($conn, $sql3);
	if (mysqli_num_rows($Doc)) {
	$DocID=mysqli_fetch_array($Doc,MYSQLI_ASSOC);
	}
	else{
		$DocID= " ";
	}
	
	if(mysqli_num_rows($Doc)){
				$sql_medical = "select * from medicalplan where patient_ID = '".$_SESSION["ID"]."';";
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
		<link rel="stylesheet" href="../css/patient.css">
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
					<?php echo '<img src="'.$result.' " alt="Your picture" id="avatar" style="width:100px"  class="w3-circle w3-hover-opacity text-center">'?>
				<form action="" method="post" enctype="multipart/form-data">
					<input id="imageUpload" type="file" name="profile_photo" placeholder="Photo" required="" capture>
					<input type="submit" value="Upload Image" id="Upload" class="btn btn-warning" name="submitPicture" style="display:none">
				</form>
				<h2 ><b>Welcome <?php echo $_SESSION["lasttName"]. ' ' .$_SESSION["firstName"];?></h2><br><br>
				<a href="profile.php" ><button type="button" class="btn btn-primary"><b>Edit Your Profile</button> </a>
			<div class="row">
				<img src="../images/google-calendar-logo.png" class="img-responsive" alt="Google Calendar"style="width:200px;">
				<iframe src="../html/calendar.html" border="0" scrolling="no" frameborder="0" style="height:300px ">
				</iframe>
				
			</div>
			</div>
			
			<div class="col-md-9 " id="Your_patient">
			<div class="row container-fluid" id="medical_program">
				<div class="col-md-6">
					<div class="text-center" id="goals">
						<br><h3><b><u>Goals:</u></b></h3>
						<p id="MyGoals"></p><br>
						<h3><b><u>Targets:</u></b></h3>
						<p id="MyTargets"></p>
						<button type="button" id="btn1" class="btn btn-primary" onclick="document.getElementById('goals-modal').style.display='block'"><b>View<a href="#" ></a></button>
						<div id="goals-modal" class="modal">
						<form class="modal-content1 animate" action="paitent_medicalP.php" method="post">
						
							<div class="container-fluid">
								<span onclick="document.getElementById('goals-modal').style.display='none'" class="close" >&times;</span>
									<br><h3><b><u>Goals:</u></b></h3>
									<textarea class="input"  name="Goals"><?php echo $Patient_planID['Goals']; ?></textarea>
									<h3><b><u>Targets:</u></b></h3>
									<textarea  class="input" name="Targets"><?php echo $Patient_planID['Targets']; ?></textarea>
							</div>
						</form>
						</div>
						
					</div>
				</div>
				<div class="col-md-6">
					<div class="text-center" id="Restrictions">
						<br><h3><b><u>Restrictions:</u></b></h3>
						<p id="MyRestrictions"></p><br>
						<button type="button" id="btn2" class="btn btn-primary" onclick="document.getElementById('RestrictionsForm').style.display='block'"><b>View<a href="#" ></a></button>
						<div id="RestrictionsForm" class="modal">
						<form class="modal-content2 animate" action="paitent_medicalP.php" method="post">
							<div class="container-fluid">
								<span onclick="document.getElementById('RestrictionsForm').style.display='none'" class="close" >&times;</span>
								<br><h3><b><u>Restrictions:</u></b></h3>
								<textarea class="input" name="Restrictions"><?php echo $Patient_planID['Restrictions']; ?></textarea>
							</div>
						</form>
						</div>
					</div>
				</div>
			</div>
		<div class="row">
			<center>
				<div class="col-md-12 programs" style="margin-top:-10%">
				<div id="Training">
					<img src="../images/positive-d005-512.png" alt="Your picture" id="runing icon" style="width:80px; height:67px; border-right:solid; float:left;">
					<div id="line">
						<h3><u>Training program</h3></u><br><br>
					</div>
					<div id="line2">
						<h6 id="trainerUser" ><u>MR.</h6>
						<h6 ><u>Personal trainer</h6>
					</div>
					<div id="line3" class="clear">
						<h6><b>Your opnion</h6>
						<img src="../images/5star.png" alt="Your picture" id="5 stars" style="width:80px;">
					</div>
				</div>
				<div id="Food">
					<img src="../images/nutrition-icon-7533.png" alt="Your picture" id="Nutrition icon" style="width:80px; height:67px; border-right:solid; float:left;">
					<div id="line">
						<h3><u>Nutrition program</h3><br><br>
					</div>
					<div id="line2">
						<h6 id="dieticianUser" ><u>MR.</h6>
						<h6 ><u>Dietician </h6>
					</div>
					<div id="line3" class="clear">
						<h6><b>Your opnion</h6>
						<img src="../images/5star.png" alt="Your picture" id="5 stars" style="width:80px;">
					</div>
				
				</div>
				<div id="Health">
					<img src="../images/doc.png" alt="Your picture" id="Doctor icon" style="width:80px; height:64px; border-right:solid; float:left;">
					<div id="line">
						<h3><u>Health program</h3><br><br>
					</div>
					<div id="line2">
						<h6 id="doctorUser" ><u>DR.<?php echo $DocID['First_Name']. ' ' .$DocID['Last_Name']; ?> </h6>
						<h6 ><u>Doctor</h6>
					</div>
					<div id="line3" class="clear">
						<h6><b>Your opnion</h6>
						<img src="../images/5star.png" alt="Your picture" id="5 stars" style="width:80px;">
					</div>
				
				</div>
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
