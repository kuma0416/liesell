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
	<table frame=void style="background-color:#C9BAE8;border-radius:10px;padding:10px;font-size:15px;position: relative;left: 25px;">
	欲購商品之資料:
    <?php
    	ob_start();
    	session_start();
    	$good_ID=$_GET['gid'];
    	unset($_SESSION['tempid']);
    	$_SESSION['tempid']=$good_ID;
    	unset($_SESSION['allinventory']);
    	$_SESSION['allinventory']=0;
		include "readdb.php";
		$conn=readDB('liesell');
		$good_discount=1;
		$sql_pur="SELECT * FROM good WHERE GID=".$good_ID;
		$pur_result=mysqli_query($conn,$sql_pur);
		$row=mysqli_fetch_row($pur_result);
		$col=mysqli_num_fields($pur_result);
		echo "<tr>";
			echo "<td>GID</td>";
			echo "<td>sellerID</td>";
			echo "<td>classification</td>";
			echo "<td>gname</td>";
			echo "<td>price</td>";
			echo "<td>inventory</td>";
			echo "<td>discountrate</td>";
			echo "<td>nbid</td>";
		echo "</tr>";
		for ($i = 0 ; $i<mysqli_num_rows($pur_result);$i++){
			$out=json_decode(json_encode($row),true);
			$row=mysqli_fetch_row($pur_result);
			echo "<tr>";
			for($j=0;$j<$col;$j++){
				echo "<td>";
				echo $out[$j];
				echo "</td>";
				if($j==5){
					$_SESSION['allinventory']=$out[$j];
				}
				if($j==6){
					$good_discount=$out[$j];
				}
			}
			echo "</tr>";
		}
    ?>
	</table>
	<form action="" method="post">
		請選擇購買數量:
		<select name="amount" onchange="javascript:submit()">
			<?php
				for($i=0;$i<=$out[5];$i++){
					if($i==0)
					{
						echo "<option>--</option>";
						echo "cannot be 0!";
					}
					else
					{
						echo "<option>$i</option>";
					}
				}
			?>
		</select>
	</form>
	<?php
		$total=0;
		unset($_SESSION['num']);
		$_SESSION['num']=0;
		unset($_SESSION['total_money']);
		$_SESSION['total_money']=0;
		if($good_discount==0){
			$good_discount=1;
		}
		else{
			$good_discount=$good_discount/100;
		}
		if(isset($_POST['amount']))
		{	
			$select=$_POST['amount'];
			$total=$select*$out[4]*$good_discount;
			$_SESSION['num']=$select;
			$_SESSION['total_money']=$total;
		}
		echo "總金額為: ";
		echo round($_SESSION['total_money'],0);
		echo "<br>";
		echo "總數量為: ";
		echo $_SESSION['num'];
		echo "<form id='search_form' action='tran_usercheck.php' method='POST' accept-charset='utf-8'>";
		echo "<input type='submit' name='trancheck' value='下一步' style='border-radius: 10px;width: 80px;height: 40px;position: relative;top:5px;background-color:#c7c7e2;color:#fff;'>";
		echo "</form>";
	?>
</body>
</html>