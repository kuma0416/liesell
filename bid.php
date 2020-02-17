<!DOCTYPE html>
<html>
<head>
<title>bid</title>
<style type="text/css">
	.head{
 		background-color:#E7BCBC;
  		color: #F1DEFF;
  		font-size:15px;
  		text-align: left;
  		padding: 10px;
  		border-width: 3px;
  		border-color: #000000;
  		box-shadow: 0 10px 6px -6px #777;
	}
table {
  border-collapse: collapse;
  font-family:monospace;
}
caption {
  margin: 1em auto;
}
th,td {
  padding: .2em;
}
th,td {
  border-bottom: 1px solid #d8d8eb;
  border-top: 1px solid #d8d8eb;
  text-align: center;
}
</style>
</head>
<body style="margin:0px;background-color:#EEE7E8;">
	<div class="head">
  	<img src="logo.png" width="115" height="66" border="0" onclick="location.href='homepage.php'">
	</div>
	<button onclick="location.href='logout.php'" style="float:right;position:relative;top:-70px;border:1;background-color:#b3d9d9;color:#fff;border-radius:10px;height:50px;width:150px">Log out</button>
	<button onclick="location.href='user interface.php'" style="float:right;position:relative;top:-70px;right:20px;border-radius:10px;border:1;background-color:#b3d9d9;color:#fff;height:50px;width:150px">User interface</button>
	<div style="position:relative;top:100px;left:50%;margin-left:-320px;background-color:#FCCDAB;width:650px;border-radius:10px;padding:10px;box-shadow: 0 10px 6px -6px #777;text-align-last: center;">
	<table frame=void style="background-color:#C9BAE8;border-radius:10px;padding:10px;font-size:15px;position: relative;left: 25px;">
<?php
ob_start();
session_start();

include "readdb.php";
$conn = readDb("liesell");

$u=$_SESSION['user'];
$gid=$_GET['gid'];

unset($_SESSION['tempgid']);
$_SESSION['tempgid']=$gid;


$sql="SELECT BIDPRICE FROM bid where GID=$gid";
$result=mysqli_query($conn,$sql);
$nums=mysqli_num_rows($result);

$sql="SELECT UID,PRICE FROM good where GID=$gid";

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

if($nums == 0)
{
	echo '無人競標，目前訂價: ';
	echo $bidinfo[1];
}
else
{
	$sql="SELECT BIDPRICE FROM bid where GID = $gid";
	$result=mysqli_query($conn,$sql);
	$row = mysqli_fetch_row($result);
	$out = json_decode(json_encode($row),true);
	$price=$out[0];

	echo '目前競標最高價格: ';
	echo $price;
}



if($bidinfo[0] == $u)
{
	echo "<br>";
	echo "<button onclick=\"location.href='bidend.php'\">結束競標</button>";
}
else
{
	echo "<form id='search_form' action='bid2.php' method='POST' accept-charset='utf-8'>";
		echo "<br>";
		echo "出價: <input type='number' name='Bid' class='inputtext' min='1' required>";
		echo "<input id='bid_submit' type='submit' name='submit' value='Bid'>";
	echo "</form>"; 
}

?>
</body>
</html>
