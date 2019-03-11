<?php
session_start();
?>

<?php
//insert.php
if(isset($_POST["subject"]))
{
 include("connect.php");
 $fromID = $_SESSION["ID"];
 $professionalID = $_POST["professional"];
 $subject = mysqli_real_escape_string($con, $_POST["subject"]);
 $comment = mysqli_real_escape_string($con, $_POST["comment"]);
 $query = "
 INSERT INTO comments(from_user,to_user,comment_subject, comment_text)
 VALUES ('$fromID','$professionalID','$subject', '$comment')
 ";
 mysqli_query($con, $query);
}
?>