<?php
include('header.php');
if ($_POST) {
	# code...
	$usr=$_SESSION['user'];
	$touser=sanitizeString($_POST['touser']);
	$msg=sanitizeString($_POST['msg']);
	$sub=sanitizeString($_POST['sub']);
	mysqli_query($GLOBALS['connect'], ("INSERT INTO messages(uname,touser,msgsub,msg,status)VALUES('$usr','$touser','$sub','$msg','0')");
	echo "<script>location.replace('mailbox.php')</script>";
}

?>