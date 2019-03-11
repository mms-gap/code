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

?>

<!DOCTYPE html>
<html>
 <head>
  <title>Notification using PHP Ajax Bootstrap</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <body>
  <br /><br />
  <div class="container">
   <nav class="navbar navbar-inverse">
    <div class="container-fluid">
     <div class="navbar-header">
      <a class="navbar-brand" href="#">PHP Notification Tutorial</a>
     </div>
     <ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
       <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count" style="border-radius:10px;"></span> <span class="glyphicon glyphicon-bell" style="font-size:18px;"></span></a>
       <ul class="dropdown-menu"></ul>
      </li>
     </ul>
    </div>
   </nav>
   <br />
   <form method="post" id="comment_form">
    <div class="form-group">
     <label>Enter Subject</label>
     <input type="text" name="subject" id="subject" class="form-control">
    </div>
    <div class="form-group">
     <label>Enter Comment</label>
     <textarea name="comment" id="comment" class="form-control" rows="5"></textarea>
    </div>
	<p><label>to :<select id="professional" name="professional" class="form-control">
	<?php
							$sql_u = "select usertype from users where ID_Number = '".$_SESSION["ID"]."';";
							$result_u = mysqli_query($conn, $sql);
							$usertype = mysqli_fetch_assoc($result_u);
							if($usertype == "Patient"){
								$sql = "SELECT *  FROM relationship where patientID = '".$_SESSION["ID"]."';";
								$result = mysqli_query($conn, $sql);
									if (mysqli_num_rows($result) > 0) {
											while($row = mysqli_fetch_assoc($result)) {
												$sql2 = "SELECT *  FROM users where ID_Number = '".$row["trainerID"]."';";
												$result2 = mysqli_query($conn, $sql2);
												while($row2 = mysqli_fetch_assoc($result2)) {
													echo '<option value="' . $row2['ID_Number']. '">' . $row2['First_Name']. $row2['Last_Name'].'</option>';
													}
												}
										} 
							
									else
										echo '<option value="No result">no result</option>';
							}
	?>
	</p></select></label>
    <div class="form-group">
     <input type="submit" name="post" id="post" class="btn btn-info" value="Post" />
    </div>
   </form>
   
  </div>
 </body>
</html>

<script>
$(document).ready(function(){
 
 function load_unseen_notification(view = '')
 {
  $.ajax({
   url:"fetch.php",
   method:"POST",
   data:{view:view},
   dataType:"json",
   success:function(data)
   {
    $('.dropdown-menu').html(data.notification);
    if(data.unseen_notification > 0)
    {
     $('.count').html(data.unseen_notification);
    }
   }
  });
 }
 
 load_unseen_notification();
 
 $('#comment_form').on('submit', function(event){
  event.preventDefault();
  if($('#subject').val() != '' && $('#comment').val() != '')
  {
   var form_data = $(this).serialize();
   $.ajax({
    url:"insert.php",
    method:"POST",
    data:form_data,
    success:function(data)
    {
     $('#comment_form')[0].reset();
     load_unseen_notification();
    }
   });
  }
  else
  {
   alert("Both Fields are Required");
  }
 });
 
 $(document).on('click', '.dropdown-toggle', function(){
  $('.count').html('');
  load_unseen_notification('yes');
 });
 
 setInterval(function(){ 
  load_unseen_notification();; 
 }, 5000);
 
});
</script>
