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
	
	$sql1 = "SELECT * FROM comments  where to_user = '".$_SESSION["ID"]."';";
	$result2 = mysqli_query($conn, $sql1);
	$row = mysqli_fetch_array($result2,MYSQLI_ASSOC);
	if(mysqli_num_rows($result2)){
		
		$sql2="SELECT image from images where id = '".$row["from"]."';";
		$sth=mysqli_query($conn, $sql2);
			if (mysqli_num_rows($sth)) {
				$result_temp=mysqli_fetch_array($sth,MYSQLI_ASSOC);
				$result="../images/".$result_temp["image"];
				}
	}
	else
		$result="../images/img_avatar.png";
	
	$sqlName = "select First_Name from users where ID_Number = '".$row["from"]."';";
	$resultName = mysqli_query($conn, $sqlName);
	if (mysqli_num_rows($resultName)) {
				$from=mysqli_fetch_array($resultName,MYSQLI_ASSOC);
				}
	else
		$from["First_Name"] = "No result";
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
		<link rel="stylesheet" href="../css/notification.css">
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
		<li><a href="#">Help</a></li>
      </ul>
	  <ul class="nav navbar-left" style="color:black">
		<li class="dropdown"  style="color:black">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" ><span class="label label-pill label-danger count" style="border-radius:10px;" ></span> 
			<span class="glyphicon glyphicon-bell" style="font-size:18px;" ></span></a>
			<ul class="dropdown-menu"></ul>
		</li>
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
<main class="bg" style="height:100%">

<?php 
$query = "SELECT * FROM comments  ORDER BY comment_id DESC";
$result33 = mysqli_query($conn, $query);
$i = 0;
if(mysqli_num_rows($result33) > 0)
{
 while($row = mysqli_fetch_array($result33))
 {
	 $i++;
	echo '<div id="message">
	<p>
	<h4 style="display:inline-block"><b>New message from:</b></h4>
	<img src="'.$result.'" alt="Your picture" id="avatar" style="width:50px; display:inline-block;"  class="w3-circle w3-hover-opacity">
	<p style="display:inline-block"><u>'.$from["First_Name"].'</u></p>
		<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#'.$i.'" aria-expanded="false" aria-controls="collapseExample">
			Open
		</button>
		<button class="btn btn-primary" type="button">
			Replay
		</button>
		</p>
</div>
<div class="collapse" id="'.$i.'" >
  <div class="card card-body">
   <h3>'.$row["comment_subject"].'</h3>
   <textarea>'.$row["comment_text"].'</textarea>
  </div>
</div>';
 }
}
?>
<a  href="php-notifications-master/index.php"><button  class="btn btn-primary" type="button">Send a Massege</a></button>

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
                      <p><a href="logOut.php" class="btn btn-primary">log out</a></p><br>
				  </div>
			</div>
</footer>

</body>
</html>
