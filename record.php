<!DOCTYPE html>
<html>
<head>
<title>record</title>
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
	<div style="position:relative;top:100px;left:50%;margin-left:-400px;background-color:#FCCDAB;width:750px;border-radius:10px;padding:10px;box-shadow: 0 10px 6px -6px #777;text-align-last: center;">
	<table frame=void style="background-color:#C9BAE8;border-radius:10px;padding:10px;font-size:15px;">
	<?php
		ini_set("max_execution_time", "300");
		ob_start();
		session_start();
		include "readdb.php";
		$conn=readDB('liesell');
		$uid=$_SESSION['user'];
		$sql="Select record.RID,record.GID,good.GNAME,record.BUYERUID, record.AMOUNT,record.NUMBER,record.TIME,record.RECEIPT from good,record  WHERE ( BUYERUID = "."'".$uid."'"." AND good.GID = record.GID)";
		$result=mysqli_query($conn,$sql);
		$row=mysqli_fetch_row($result);
		$col=mysqli_num_fields($result);
		echo "BUY";
		echo "<tr>";
			echo "<td>RID</td>";
			echo "<td>GID</td>";
			echo "<td>GNAME</td>";
			echo "<td>BUYERUID</td>";
			echo "<td>AMOUNT</td>";
			echo "<td>QUANTITY</td>";
			echo "<td>DATE</td>";
			echo "<td>FINISH</td>";
			echo "<td>OPTIONS</td>";
		echo "</tr>";
		if ( $result = mysqli_query($conn, $sql)){
		for ($i = 0 ; $i<mysqli_num_rows($result);$i++){
			$row=mysqli_fetch_row($result);
			echo "<tr>";
			for($j=0;$j<$col;$j++){
				$out=json_decode(json_encode($row),true);
				echo "<td>";
				echo $out[$j];
				echo "</td>";
				if($j==7){
					echo "<td>";
					if($out[7]==0){echo "Processing...";}
					else{	$sql_comment="SELECT RID FROM comment WHERE RID="."'".$out[0]."'";
						$comment_result=mysqli_query($conn,$sql_comment);
						$nums=mysqli_num_rows($comment_result);
						if($nums != 0){echo "Finish~~";}
						else{echo "<button onclick=\"location.href='comment_insert.php'\">COMMENT</button>";
							$_SESSION['temprid']=$out[0];}}
			echo "</td>";}}
		echo "</tr>";}}

	?>
	</table>
	<table frame=void style="background-color:#C9BAE8;border-radius:10px;padding:10px;font-size:15px;position:relative;left:60px;">
	<?php
		echo "SELL";
		echo "<tr>";
		echo "<td>RID</td>";
		echo "<td>GID</td>";
		echo "<td>GNAME</td>";
		echo "<td>BUYERUID</td>";
		echo "<td>AMOUNT</td>";
		echo "<td>QUANTITY</td>";
		echo "<td>DATE</td>";
		echo "<td>FINISH</td>";
		echo "<td>OPTIONS</td>";
		echo "</tr>";
		$sql="Select record.RID,record.GID,good.GNAME,record.BUYERUID, record.AMOUNT,record.NUMBER,record.TIME,record.RECEIPT from good,record where ( good.UID="."'".$uid."'"." AND good.GID=record.GID)";
		$result=mysqli_query($conn,$sql);
		$row=mysqli_fetch_row($result);
		$col=mysqli_num_fields($result);
		if ( $result = mysqli_query($conn, $sql)){
		for ($i = 0 ; $i<mysqli_num_rows($result);$i++){
			$row=mysqli_fetch_row($result);
			echo "<tr>";
			for($j=0;$j<$col;$j++){
				$out=json_decode(json_encode($row),true);
				echo "<td>";
				echo $out[$j];
				echo "</td>";
				if($j==7){
					echo "<td>";
					if($out[7]==0){{echo "<button onclick=\"location.href='confirm.php'\">Confirm</button>";$_SESSION['temprid']=$out[0];}}
					else{echo "Finish~~";}
					echo "</td>";}}
		echo "</tr>";}}
	?>
</table>
</div>
</body>
</html>