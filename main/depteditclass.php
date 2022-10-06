<?php
include('header.php');
$id=$_REQUEST['id'];
$dept=$_POST['dept'];
mysqli_query($GLOBALS['connect'],"UPDATE dept set name='$dept' where id='$id'");
echo "<script>alert('Department Updated!')</script>";
echo "<script>location.replace('adddepartment.php')</script>";
?>