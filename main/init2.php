<?php
include('header.php');
$str="0";
$result=mysqli_query($GLOBALS['connect'],"SELECT bankcode,id from staff where bankcode='01'");
while ($row=mysqli_fetch_array($result)) {
	$bcode=$row['bankcode'];
	$newcode=$str.$bcode;
	$id=$row['id'];
	// "<script>alert('$newcode')</script>";
	mysqli_query($GLOBALS['connect'],"UPDATE staff SET bankcode='$newcode' WHERE id='$id'");
}

?>