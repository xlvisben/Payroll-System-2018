<?php
include('header.php');
if ($_POST) {
	# code...
	$bname=sanitizeString($_POST['bname']);
	$bbranch=sanitizeString($_POST['bbranch']);
	$datea=sanitizeString($_POST['datea']);
	$acc=sanitizeString($_POST['accountno']);
	$bbal=sanitizeString($_POST['bbal']);
	$user=$_SESSION['user'];
	$query="INSERT INTO bankdetails(bankname,bankbranch,dateadded,accountno)Values('$bname','$bbranch','$datea','$acc')";
	mysqli_query($GLOBALS['connect'],$query);
	$addlog="INSERT INTO bankbalance (account,amountin,recordedby,dateadded)
	VALUES('$acc','$bbal','$user','$datea')";
	mysqli_query($GLOBALS['connect'],$addlog);
	if (!mysql_error()) {
		# code...
		//echo "<script>location.replace('banks.php')</script>";
		}else
		echo mysql_error();
	}
?>