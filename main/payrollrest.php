<?php
include('header.php');
$period=$_REQUEST['period'];
mysqli_query($GLOBALS['connect'],"DELETE FROM payroll_tbl where payrollrun='$period'");
mysqli_query($GLOBALS['connect'],"DELETE FROM payrollruns where period='$period'");
	echo "<script>alert('Payroll Reset Successful')</script>";
		echo "<script>location.replace('payroll.php')</script>";
