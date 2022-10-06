<?php // rnfunctions.php
error_reporting(E_ALL ^ E_DEPRECATED);
$dbhost = 'localhost'; // Unlikely to require changing
$dbname = 'payroll_test_one'; // Modify these...
$dbuser = 'root'; // ...variables according
$dbpass = ''; // ...to your installation
$connect = mysqli_connect($dbhost, $dbuser, $dbpass) or die(mysqli_error($connect));
mysqli_select_db($connect, $dbname) or die(mysqli_error($connect));
function sessionStart()
{
session_start();
}
function createTable($name, $query)
{
if (tableExists($name))
{
echo "Table '$name' already exists<br />";
}
else
{
queryMysql("CREATE TABLE $name($query)");
echo "Table '$name' created<br />";
}
}
function tableExists($name)
{
$result = queryMysql("SHOW TABLES LIKE '$name'");
return mysqli_num_rows($result);
}
function queryMysql($query)
{
$result = mysqli_query($GLOBALS['connect'], $query) or die(mysqli_error($GLOBALS['connect']));
return $result;
}
function destroySession()
{
$_SESSION=array();
if (session_id() != "" || isset($_COOKIE[session_name()]))
setcookie(session_name(), '', time()-2592000, '/');
session_destroy();
}
function sanitizeString($var)
{
$var = strip_tags($var);
$var = htmlentities($var);
$var = stripslashes($var);
return mysqli_real_escape_string($GLOBALS['connect'], $var);
}


function processQuery($query)
{
    
    $result=queryMysql($query);
    return $result;
    
}

function longdate($timestamp)
{
return date("l F jS Y", $timestamp);
}
function getTaxableIncome($staffid,$nssf,$period){
	$r=mysqli_fetch_array(mysqli_query($GLOBALS['connect'], "SELECT salary,totalbenefits FROM payroll_tbl where staffid='$staffid' and payrollrun='$period'"));
	$bens=$r['totalbenefits'];
	$salary=$r['salary'];
	$taxableincome=($bens+$salary)-$nssf;
	return $taxableincome;

}
?>
