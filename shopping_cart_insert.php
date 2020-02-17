<!DOCTYPE html>
<html>
<head>
<title>liesell</title>
</head>
<body>
<?php
ob_start();
session_start();
$uid=$_SESSION['user'];
include "readdb.php";
$gid=$_GET['gid'];
$insertvalue = array();
$keyword_insert1 = " VALUES (";
$keyword_insert2 = ");"	;
array_push($insertvalue, "'".$uid."'", "'".$gid."'");
$insert_str = implode(", ",$insertvalue);
$sql = "INSERT INTO cart".$keyword_insert1.$insert_str.$keyword_insert2;
$conn = readDb("liesell");
if (!$conn) {die("Connection failed: " . mysql_connect_error());}	
$result=mysqli_query($conn,$sql);
header("Location: ./shopping_cart.php");
?>
</body>
</html>