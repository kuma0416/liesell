<?php
ob_start();
session_start();
$uid=$_SESSION['user'];
$gid=$_GET['gid'];
include "readdb.php";
$sql = "DELETE FROM cart WHERE  UID = "."'".$uid."'"." AND GID = "."'".$gid."'";
$conn = readDb("liesell");
$result=mysqli_query($conn,$sql);
echo $sql;
header("Location: ./shopping_cart.php");
?>