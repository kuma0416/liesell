<!DOCTYPE html>
<html>
<head>
<title>coupon</title>
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
	<div style="position:relative;top:100px;left:50%;margin-left:-320px;background-color:#FCCDAB;width:650px;border-radius:10px;padding:10px;box-shadow: 0 10px 6px -6px #777;">
	<table frame=void style="background-color:#C9BAE8;border-radius:10px;padding:10px;font-size:15px;position: relative;left: 240px;">
	<?php
		session_start();
		include "readdb.php";
		$uid=$_SESSION['user'];
		$conn=readDB('liesell');
		$sql_coupon="SELECT * FROM coupon WHERE UID=".$uid;
		$coupon_result=mysqli_query($conn,$sql_coupon);
		$row=mysqli_fetch_row($coupon_result);
		$col=mysqli_num_fields($coupon_result);
		echo "<tr>";
			echo "<td>CID</td>";
			echo "<td>coupon_rate</td>";
			echo "<td>UID</td>";
		echo "</tr>";
		for ($i = 0 ; $i<mysqli_num_rows($coupon_result);$i++){
			$out=json_decode(json_encode($row),true);
			$row=mysqli_fetch_row($coupon_result);
			echo "<tr>";
			for($j=0;$j<$col;$j++){
				echo "<td>";
				echo $out[$j];
				echo "</td>";
			}
			echo "</tr>";
		}
	?>
	</table>
</div>
</body>
</html>