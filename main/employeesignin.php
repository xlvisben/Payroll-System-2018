<?php
include('connect.php');
session_start();
if($_GET['action']=="signin"){
$email=SanitizeString($_REQUEST['email']);
$pass=SanitizeString($_REQUEST['token']);
$query="SELECT payrollno from staff where staff_email='$email' and national_id='$pass'";
$result=queryMysql($query);
$query2="SELECT payrollno AS typer from staff where staff_email='$email'";
$result1=mysqli_query($GLOBALS['connect'],$query2);
$num = mysqli_num_rows($result);
if (mysqli_num_rows($result)!=0)
{


for ($j = 0 ; $j < $num ; ++$j)
 {
    $row = mysql_fetch_row($result);
    $user=$row[0];
 }
//saveUser($usersName);
 //session_start();
 $_SESSION['user'] = $user;
 $_SESSION['loggedIn']='TRUE';

 
     
echo <<<Home
<script type="text/javascript">
location.replace("employee/index.php");
</script>
Home;


}
else
{
    echo "<script type='text/javascript'>alert('No such user was found')</script>";
    $_SESSION['loggedIn']=FALSE;
 echo <<<Home
<script type="text/javascript">
location.replace("../employeelogin.php");

</script>
Home;
}



}
    
?>