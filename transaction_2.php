<!DOCTYPE html>
<html>
<head>
<title>liesell</title>
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
	<table frame=void style="background-color:#C9BAE8;border-radius:10px;padding:10px;font-size:15px;position: relative;left: 235px;">
		您所擁有之折價券: 
		<?php
			ob_start();
			session_start();
			include "readdb.php";
			$cou_arr=array("");
			$cou_arr[0]=0;
			$courate_arr=array("");
			$courate_arr[0]=0;
			$uid=$_SESSION['user'];
			$conn=readDB('liesell');
			$sql_coupon="SELECT * FROM coupon WHERE UID=".$uid;
			$coupon_result=mysqli_query($conn,$sql_coupon);
			$cou_row=mysqli_fetch_row($coupon_result);
			$cou_col=mysqli_num_fields($coupon_result);
			$one=1;
			echo "<tr>";
				echo "<td>CID</td>";
				echo "<td>coupon_rate</td>";
				echo "<td>UID</td>";
			echo "</tr>";
			for ($i = 0 ; $i<mysqli_num_rows($coupon_result);$i++){
				$cou_out=json_decode(json_encode($cou_row),true);
				$cou_row=mysqli_fetch_row($coupon_result);
				echo "<tr>";
				for($j=0;$j<$cou_col;$j++){
					echo "<td>";
					echo $cou_out[$j];
					echo "</td>";
					if($j==0){
						$cou_arr[$i+$one]=$cou_out[$j];
					}
					if($j==1){
						$courate_arr[$i+$one]=$cou_out[$j];
					}
				}
				echo "</tr>";
			}
		?>
	</table>
	<form action="" method="post">
		請選擇couponID:
		<select name="couponID" onchange="javascript:submit()">
			<?php
				for($i=0;$i<=mysqli_num_rows($coupon_result)+1;$i++){
					if($i==0)
					{
						echo "<option>--</option>";
					}
					else if($i==mysqli_num_rows($coupon_result)+1)
					{
						echo "<option>不使用優惠券</option>";
					}
					else
					{
						echo "<option>$cou_arr[$i]</option>";
					}
				}
			?>
		</select>
	</form>
	<?php
		$coupon_ID=0;
		unset($_SESSION['couponses']);
		$_SESSION['couponses']=0;
		if(isset($_POST['couponID'])){
			if($_POST['couponID']!="不使用優惠券"){
				$coupon_ID=$_POST['couponID'];
				$_SESSION['couponses']=$coupon_ID;
				echo "使用優惠券為:";
				echo $_SESSION['couponses'];
				echo "<br>";
				$uid=$_SESSION['user'];
				$conn=readDB('liesell');
				$sql_coupon="SELECT COUPONRATE FROM coupon WHERE CID=".$coupon_ID;
				$coupon_result=mysqli_query($conn,$sql_coupon);
				$cou_row=mysqli_fetch_row($coupon_result);
				$cou_out=json_decode(json_encode($cou_row),true);
				$cou_row=mysqli_fetch_row($coupon_result);
				$courate=($cou_out[0]/100);
				unset($_SESSION['couponrate']);
				$_SESSION['couponrate']=0;
				$_SESSION['couponrate']=$courate*100;
				echo "使用優惠券後,金額變為:";
				$total=$_SESSION['total_money'];
				$total=$total*$courate;
				$_SESSION['total_money']=$total;
				echo round($total,0);
			}
			else{
				echo "不使用優惠券之價格為:";
				echo $_SESSION['total_money'];
			}
		}
	?>
	<form id='search_form' action='checkout.php' method='POST' accept-charset='utf-8'>
	<input type='submit' name='checkout' value='結帳' style="border-radius: 10px;width: 80px;height: 40px;position: relative;top: 5px;background-color:#c7c7e2;color:#fff;">
	</form>
</body>
</html>