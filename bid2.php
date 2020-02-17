2<?php
ob_start();
session_start();
include "readdb.php";
$conn = readDb("liesell");

$u=$_SESSION['user'];
$tempgid=$_SESSION['tempgid'];


$sql="SELECT BIDPRICE FROM bid where GID=$tempgid";
$result=mysqli_query($conn,$sql);
$nums=mysqli_num_rows($result);
$result=mysqli_query($conn,$sql);
$row = mysqli_fetch_row($result);
$out = json_decode(json_encode($row),true);
$price=$out[0];

$gsql="SELECT PRICE FROM good where GID=$tempgid";
$gresult=mysqli_query($conn,$gsql);
$gnums=mysqli_num_rows($gresult);
$gresult=mysqli_query($conn,$gsql);
$grow = mysqli_fetch_row($gresult);
$gout = json_decode(json_encode($grow),true);
$gprice=$gout[0];

if(isset($_POST['submit']))
{
	if($price > $_POST['Bid'])
	{
		echo "<script>alert('競標價格需大於當前價格')</script>";
		echo "<script>window.location.href = 'homepage.php'</script>";
	}
	else if($gprice > $_POST['Bid'])
	{
		echo "<script>alert('競標價格需大於底價')</script>";
		echo "<script>window.location.href = 'homepage.php'</script>";
	}
	else
	{
		if($nums == 0)
		{
			$insertvalue = array();
			$keyword_insert1 = " VALUES (";
			$keyword_insert2 = ");";
			array_push($insertvalue,"'".$u."'", "'".$tempgid."'", "'".$_POST['Bid']."'");
			$insert_str = implode(", ",$insertvalue);
			$sql = "INSERT INTO bid".$keyword_insert1.$insert_str.$keyword_insert2;
			$result=mysqli_query($conn,$sql);
		}
		else
		{
			$keyword_update = "";
			$where_str = " WHERE GID = ".$tempgid;
			$keyword_update = $keyword_update." BIDPRICE = ".$_POST['Bid'];
			$sql = "UPDATE bid SET ".$keyword_update.$where_str;
			$result=mysqli_query($conn,$sql);
		}

		$goodprice_update = "";
		$where = " WHERE GoodID = ".$tempgid;

		$goodprice_update = $goodprice_update." Price = ".$_POST['Bid'];

		$sql = "UPDATE good SET ".$goodprice_update.$where;
		$result=mysqli_query($conn,$sql);
		unset($_SESSION['tempgid']);
		header("Location: ./homepage.php");
	}
}
?>