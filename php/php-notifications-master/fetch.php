<?php
session_start();
?>


<?php
include('connect.php');


if(isset($_POST['view'])){

// $con = mysqli_connect("localhost", "root", "", "notif");

if($_POST["view"] != '')
{
    $update_query = "UPDATE comments SET comment_status = 1 WHERE comment_status=0";
    mysqli_query($con, $update_query);
}
$query = "SELECT * FROM comments where to_user = '".$_SESSION["ID"]."' ORDER BY comment_id DESC LIMIT 5";
$result = mysqli_query($con, $query);
$output = '';
if(mysqli_num_rows($result) > 0)
{
 while($row = mysqli_fetch_array($result))
 {
   $output .= '
   <li class="notification">
   <a href="#" >
   <strong  style="color:black" >'.$row["comment_subject"].'</strong><br />
   <small  style="color:black" ><em>'.$row["comment_text"].'</em></small>
   </a>
   </li>
   ';

 }
}
else{
     $output .= '
     <li><a href="#" class="text-bold text-italic">No Noti Found</a></li>';
}



$status_query = "SELECT * FROM comments WHERE comment_status=0 and to_user = '".$_SESSION["ID"]."';";
$result_query = mysqli_query($con, $status_query);
$count = mysqli_num_rows($result_query);
$data = array(
    'notification' => $output,
    'unseen_notification'  => $count
);

echo json_encode($data);

}

?>