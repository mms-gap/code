<?php
session_start();
session_unset();
session_destroy();

header("location: http://localhost/mm_local/index_local.html");
exit();
?>