<?php
ob_start();
session_start();
include "readdb.php";
$conn = readDb("liesell");
$rid=$_SESSION['temprid'];
$submit = $_POST['submit'];
if(isset($_POST['submit']))
{
	$where = array();
	$keyword_where = "";
	if($submit=='Sent'){
		$insertvalue = array();
		$keyword_insert1 = " VALUES (";
		$keyword_insert2 = ");";

		if(isset($_POST['Message']))
		{
			array_push($insertvalue, "'".$rid."'", "'".$_POST['Message']."'","'".$_POST['list2']."'");
			$insert_str = implode(", ",$insertvalue);
			$sql = "INSERT INTO comment".$keyword_insert1.$insert_str.$keyword_insert2;
			echo $sql;
		}
		$db_result = mysqli_query($conn,"SELECT * FROM user") or die("查詢失敗");
		$result=mysqli_query($conn,$sql);
		header("Location: ./record.php");}
	$conn = readDb("liesell");
	if (!$conn) {
		die("Connection failed: " . mysql_connect_error());}	
	$db_result = mysqli_query($conn,"SELECT * FROM user") or die("查詢失敗");
	$result=mysqli_query($conn,$sql);
	unset($_SESSION['temprid']);
}
?>