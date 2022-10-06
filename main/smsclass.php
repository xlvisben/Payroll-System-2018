<?php
include('header.php');
if ($_GET['action']=="addsms") {
    $sms=$_POST['msg'];
    mysqli_query($GLOBALS['connect'],"INSERT INTO sms(body)VALUES('$sms')");
    echo "<script>location.replace('smslist.php')</script>";
}elseif ($_GET['action']=="deletesms") {
    $id=$_REQUEST['id'];
    mysqli_query($GLOBALS['connect'],"DELETE FROM sms WHERE id='$id' ");
    echo "<script>location.replace('smslist.php')</script>";
}

?>
