<?php
include('header.php');
$id=sanitizeString($_REQUEST['id']);
if ($_GET['action']=="updatestaff") {
		$std1=sanitizeString($_POST['sname']);
		$bcode1=sanitizeString($_POST['sidno']);
		$sch1=sanitizeString($_POST['semail']);
		$pname1=sanitizeString($_POST['stel']);
		$pid1=sanitizeString($_POST['sstatus']);
		$stafftype=sanitizeString($_POST['stype']);
		$nssfno=sanitizeString($_POST['nssf']);
		$nhifno=sanitizeString($_POST['nhif']);
		$pinno=sanitizeString($_POST['pinno']);
		mysqli_query($GLOBALS['connect'],"UPDATE staff SET staff_name='$std1',national_id='$bcode1',staff_email='$sch1',staff_telno='$pname1',status='$pid1',nhifno='$nhifno',nssfno='$nssfno',pinno='$pinno',staff_type='$stafftype' WHERE id='$id' ");
		echo "<script>location.replace('staffdetails.php')</script>";
}elseif ($_GET['action']=="delete") {
	$id=$_REQUEST['id'];
	mysqli_query($GLOBALS['connect'],"DELETE FROM staff WHERE id='$id'");
	echo "<script>alert('Staff Details Deleted')</script>";
	echo "<script>location.replace('staffdetails.php')</script>";
}elseif ($_GET['action']=="deletetype") {
	$id=$_REQUEST['id'];
	mysqli_query($GLOBALS['connect'],"DELETE FROM stafftype WHERE id='$id'");
	echo "<script>alert('Staff Type Details Deleted')</script>";
	echo "<script>location.replace('addstafftype.php')</script>";
}elseif($_GET['action']=="setbank") {
	$bname=$_POST['bank'];
	mysqli_query($GLOBALS['connect'],"UPDATE staff SET bankcode='$bname' WHERE id='$id' ");
	echo "<script>location.replace('staffmember.php?id=$id')</script>";
}elseif($_GET['action']=="setbranch") {
	//$bname=$_POST['bank'];
	$branch=$_POST['bankbranch'];
	$accno=$_POST['accno'];
	$accname=$_POST['accname'];
	mysqli_query($GLOBALS['connect'],"UPDATE staff SET branchcode='$branch',accountno='$accno',accountname='$accname' WHERE id='$id' ");
	echo "<script>location.replace('staffmember.php?id=$id')</script>";
}elseif ($_GET['action']=="setsalary") {
	$salary=$_POST['salary'];
	//$allowance=$_POST['allowance'];
	mysqli_query($GLOBALS['connect'],"UPDATE staff SET salary='$salary' WHERE id='$id' ");
	echo "<script>location.replace('staffmember.php?id=$id')</script>";

}elseif ($_GET['action']=="addDeduction") {
	$amount=$_POST['amount'];
	$deduction=$_POST['deduction'];
	mysqli_query($GLOBALS['connect'],"INSERT INTO empdeductions(employeeId,amount,empdeductionid)VALUES('$id','$amount','$deduction') ");
	
	echo "<script>location.replace('staffmember.php?id=$id')</script>";
}elseif ($_GET['action']=="addadvance") {
	$datea=$_POST['datea'];
	$period=$_POST['period'];
	$empid=$_REQUEST['id'];
	$amnt=$_POST['amount'];
	mysqli_query($GLOBALS['connect'],"INSERT INTO empvsadvances(payrollPeriod,amount,dateadded,empid)VALUES('$period','$amnt','$datea','$empid')");

	echo "<script>location.replace('staffmember.php?id=$id')</script>";
}elseif ($_GET['action']=="deletedept") {
	
	$id=$_REQUEST['id'];
	mysqli_query($GLOBALS['connect'],"DELETE FROM dept WHERE id='$id'");
	echo "<script>alert('Department Deleted!')</script>";
	echo "<script>location.replace('adddepartment.php?id=$id')</script>";
}
?>