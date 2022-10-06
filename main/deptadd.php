<?php
include('header.php');
if ($_POST) {

$dept=$_POST['dept'];

mysqli_query($GLOBALS['connect'],"INSERT INTO dept(name)VALUES('$dept')");
echo "<script>alert('Department added successfully')</script>";
echo "<script>location.replace('adddepartment.php')</script>";

}

?>