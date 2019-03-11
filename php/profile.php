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

<body>


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
			<div class="col-md-6 " id="profile_picture">
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
					<?php echo '<img src="'.$result.' " alt="Your picture" id="avatar" style="width:100px"  class="w3-circle w3-hover-opacity text-center">'?>
					<form action="" method="post" enctype="multipart/form-data">
						<input id="imageUpload" type="file" name="profile_photo" placeholder="Photo" required="" capture>
						<input type="submit" value="Upload Image" name="submitPicture">
					</form>
			</div>
			<div class="col-md-6 " id="usernameAndPass">
				<h4 style="display:inline-block"><b>User name:</h4></b>
				<p style="display:inline-block"><?php echo $_SESSION["userName"]?></p><br>
				<h4 style="display:inline-block"><b>Password:</h4></b>
				<p style="display:inline-block"><?php echo $_SESSION["Password"]?></p><br>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 " id="details1" style="padding-left: 50px;">
				<h4 style="display:inline-block"><b>Full Name:</h4></b>
				<p style="display:inline-block"><?php echo $_SESSION["lasttName"]. ' ' .$_SESSION["firstName"];?></p><br>
				<h4 style="display:inline-block"><b>Email:</h4></b>
				<p style="display:inline-block"><?php echo $_SESSION["Email"]?></p><br>
				<h4 style="display:inline-block"><b>ID:</h4></b>
				<p style="display:inline-block"><?php echo $_SESSION["ID"]?></p><br>
				<h4 style="display:inline-block"><b>Age:</h4></b>
				<p style="display:inline-block"><?php echo $_SESSION["Age"]?></p><br>
			</div>
			<div class="col-md-6 " id="details1" style="padding-left: 50px;">
				<h4 style="display:inline-block"><b>State:</h4></b>
				<p style="display:inline-block"><?php echo $_SESSION["State"]?></p><br>
				<h4 style="display:inline-block"><b>Address:</h4></b>
				<p style="display:inline-block"><?php echo $_SESSION["Address"]?></p><br>
				<form action="profile_changes.php?" method="post">
					<p><label>Choose your Doctor:<select id="doc" name="doc" class="form-control">
						<?php
							$sql_d = "SELECT *  FROM doctors";
							$result_d = mysqli_query($conn, $sql_d);
								if (mysqli_num_rows($result_d) > 0) {
									// output data of each row
								while($row_d = mysqli_fetch_assoc($result_d)) {
								echo '<option value="' . $row_d['ID_Number']. '">' . $row_d['First_Name']. $row_d['Last_Name'].'</option>';
								}
									} 
								else
									echo '<option value="No result">no result</option>';
						?>
					</p></select></label>
					<p><label>Choose your Trainer:<select id="trainer" name="trainer" class="form-control">
						<?php
							$sql_t = "SELECT *  FROM trainers";
							$result_t = mysqli_query($conn, $sql_t);
								if (mysqli_num_rows($result_t) > 0) {
									// output data of each row
								while($row_t = mysqli_fetch_assoc($result_t)) {
									echo '<option value="' . $row_t['ID_Number'] . '">' . $row_t['First_Name']. $row_t['Last_Name'].'</option>';
								}
									} 
							else 
								echo '<option value="No result">no result</option>';
						?>
					</p></select></label>
					<p><label>Choose your nutritionist:<select id="nutritionist" name="nutritionist" class="form-control">
						<?php
							$sql_n = "SELECT *  FROM nutritionists";
							$result_n = mysqli_query($conn, $sql_n);
								if (mysqli_num_rows($result_n) > 0) {
									// output data of each row
								while($row_n = mysqli_fetch_assoc($result_n)) {
									echo '<option value="' . $row_n['First_Name'] . '">' . $row_n['First_Name']. $row_n['Last_Name'].'</option>';
								}
									} 
							else 
								echo '<option value="No result">no result</option>';
						?>
					</p></select></label>
					<p><button type="submit" class="btn btn-primary">Save changes</button></p>
				</form>
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
					  <a href="#" class="btn btn-primary" onclick="document.getElementById('signIn1').style.display='block'">&ensp;&ensp;sign in&ensp;&ensp;</a>
				  </div>
			</div>
</footer>
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

</script>

</body>
</html>
