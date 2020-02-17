<?php
	ob_start();
	session_start();
	include "readdb.php";
	$conn=readDB('liesell');
	$sql = "UPDATE record SET RECEIPT = 1 WHERE RID = "."'".$_SESSION['temprid']."'";
	echo $sql;
	$result=mysqli_query($conn,$sql);
	unset($_SESSION['temprid']);
	header("Location: ./record.php");
?>