<?php

ob_start();
session_start();
include "readdb.php";
$conn = readDb("liesell");

$u=$_SESSION['user'];
$tempgid=$_SESSION['tempgid'];



//先把價錢尻出來
$sql="SELECT BIDPRICE FROM bid where GID=$tempgid";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_row($result);
$col=mysqli_num_fields($result);
$row1 = json_encode($row[0]);
$bidinfo = array();

if ($result = mysqli_query($conn, $sql))
{
	for ($i = 0 ; $i<mysqli_num_rows($result);$i++)
	{
		$row = mysqli_fetch_row($result); 
		for($j=0;$j<$col;$j++)
		{
			$out = json_decode(json_encode($row),true);
			array_push($bidinfo, $out[$j]);
		}
	}
}


//在bid表新增一列
$insertvalue = array();
$keyword_insert1 = " VALUES (";
$keyword_insert2 = ");";

array_push($insertvalue,"'".$u."'", "'".$tempgid."'", "'".$out[0]."'");
$insert_str = implode(", ",$insertvalue);
$sql = "INSERT INTO bid".$keyword_insert1.$insert_str.$keyword_insert2;
echo $sql;
$result=mysqli_query($conn,$sql);


//把good裡此商品狀態改成不可bid
$keyword_update = "";

$where_str = " WHERE `GID` = ".$tempgid;
$value_bid = "0";
$keyword_update = $keyword_update." `NBID` = ".$value_bid;

$sql = "UPDATE good SET ".$keyword_update.$where_str;
$result=mysqli_query($conn,$sql);


$goodprice_update = "";
$where = " WHERE GID = ".$tempgid;
$goodprice_update = $goodprice_update." Price = ".$out[0];
$sql = "UPDATE good SET ".$goodprice_update.$where;
echo $sql;
$result=mysqli_query($conn,$sql);


unset($_SESSION['tempgid']);
header("Location: ./homepage.php");
?>