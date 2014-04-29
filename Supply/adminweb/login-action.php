<?php require_once('../Connections/connect_supply.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
mysql_select_db($database_connect_supply, $connect_supply);

//Get username and password from form.
$adminuser = $_POST['username'];
$adminpswd = $_POST['password'];

//encrypt password
$adminpswd = md5(sha1($adminpswd));

//mySQL-query
$admin_query= sprintf("SELECT * FROM users WHERE users.user_naam = %s", GetSQLValueString($adminuser, "text"));

$admin_result = mysql_query($admin_query, $connect_supply) or die(mysql_error());
$row_admin = mysql_fetch_assoc($admin_result);

if($adminuser == $row_admin['user_naam']) {
	if($adminpswd == md5($row_admin['user_pswd'])) {
	    session_start();
		$_SESSION['adminlogin'] = $adminuser;
		header("location: index.php");
	}
	else {
		echo "Your password is not correct."; 	
	}
}
else {
	echo "This user doesn't exist!";
}
?>