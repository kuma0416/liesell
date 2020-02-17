<?php
ob_start();
session_start();
$uid=$_SESSION['user'];
$rid=$_GET['rid'];
include "readdb.php";
$sql = "DELETE FROM comment WHERE  RID = "."'".$rid."'";
$conn = readDb("liesell");
$result=mysqli_query($conn,$sql);
echo $sql;
header("Location: ./homepage.php");
?>