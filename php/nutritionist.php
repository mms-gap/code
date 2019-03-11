<?php
	session_start();
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
				<img src="../images/img_avatar.png" alt="Your picture" id="avatar" style="width:100px"  class="w3-circle w3-hover-opacity text-center">
				<h2 ><b>Welcome <?php echo $_SESSION["lasttName"]. ' ' .$_SESSION["firstName"];?></h2><br><br>
				<button type="button" class="btn btn-primary"><b>Edit Your Profile<a href="#" ></a></button>
				<p></p><br>
				<p><b>Enter patient ID:</p>
				<form class="form-inline active-cyan-3 active-cyan-4 ">
					<input class="form-control form-control-sm ml-3 w-75" type="text" placeholder="Search" aria-label="Search" style="width:150px;">
					<i class="fa fa-search" aria-hidden="true"></i>
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
				<img src="../images/img_avatar.png" alt="Your_Patient_picture" id="avatar_Patient" style="width:100px; float:left; margin-left:20px;"  class="w3-circle w3-hover-opacity text-center">
				<div class="h3_titles">
					<br><h3 style="display:inline-block"><b>mr.</h3><br>
					<h3 style="display:inline-block" id="patientID"><b>ID:</h3>
				</div>
			</div>
			<div class="clear"></div>
			<div class="row container-fluid" id="medical_program">
				<div class="col-md-6">
					<div class="text-center" id="goals">
						<br><h3><b><u>Goals:</h3>
						<p id="MyGoals"></p><br>
						<h3><b><u>Targets:</h3>
						<p id="MyTargets"></p>
					</div>
				</div>
				<div class="col-md-6">
					<div class="text-center" id="Restrictions">
						<br><h3><b><u>Restrictions:</h3>
						<p id="MyRestrictions"></p><br>
					</div>
				</div>
			</div>
			<div class="row">
			<center>
				<div class="col-md-12">
					<img src="../images/positive-d005-512.png" alt="Your picture" id="runing icon" style="width:80px; height:67px; float:left;">
					<br><p class="patientName" style="float:left;"><u> - Training Program.PDF</p>
					<button type="button" id="btn3" class="btn btn-warning"><b>View<a href="#"></a></button><br><Br><br>
				</div>
				<div class="col-md-12">
					<img src="../images/nutrition-icon-7533.png" alt="Your picture" id="runing icon" style="width:80px; height:67px; float:left;">
					<br><p class="patientName" style="float:left"><u> - Food Program.PDF</p>
					<button type="button" id="btn4" class="btn btn-warning"><b>Upload/Edit<a href="#"></a></button>
				</div>
			</center>
			</div>
			</div>
			</div>
		</div>
	
	</section>
	<section>
		
			
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


</body>
</html>
