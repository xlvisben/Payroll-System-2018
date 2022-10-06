<?php
include('header.php');

if ($_POST) {

$bankcode= mysqli_escape_string($GLOBALS['connect'],($_POST['bank']);
$branch=mysqli_escape_string($GLOBALS['connect'],($_POST['branch']);
$code=mysqli_escape_string($GLOBALS['connect'],($_POST['branchcode']);

mysqli_query($GLOBALS['connect'],"INSERT INTO bankbranch(bankCode,bname,code)values('$bankcode','$branch','$code')");

echo "<script>alert('Branch added')</script>";
echo "<script>location.replace('addbranch.php')</script>";
}
?>