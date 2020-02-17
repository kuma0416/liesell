<?php
ob_start();
session_start();
if(!isset($_SESSION['user']))
{
	header("Location: ./homepage.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>多條件查詢</title>
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
	<div id="search" style="position:relative;top:100px;left:50%;margin-left:-300px;background-color:#b8b8dc;width:610px;border-radius:10px;padding:10px;box-shadow: 0 10px 6px -6px #777;text-align-last:center;">
		<form id="search_form" action="goodquery.php" method="POST" accept-charset="utf-8">
		<!-- 下拉選單 -->
			<div id="search_box">
				<select name="list1" id="list1">
					<option value="computer">電腦</option>
					<option value="cellphone">手機</option>
					<option value="clothes">上衣</option>
					<option value="pants">褲裙</option>
					<option value="shoes">鞋子</option>
					<option value="accessory">配件</option>
					<option value="cosmetic">保養品</option>
					<option value="makeup">化妝品</option>
					<option value="snack">零食</option>
					<option value="drink">飲料</option>
					<option value="dessert">蛋糕、甜點</option>
					<option value="bicycle">機車</option>
					<option value="car">汽車</option>
					<option value="feed">飼料</option>
					<option value="pet_clothes">寵物服飾</option>
					<option value="core">主機</option>
					<option value="table_game">桌遊</option>
					<option value="game_point">點數</option>
				</select>
			</div>
			<!-- 輸入欄 -->
			<br>
			商品名稱: <input type="text" name="Gname" class="inputtext" required style="width:150px";><br>
			商品價格: <input type="number" name="Price" class="inputtext" min="0" style="width:150px";><br>
			剩餘庫存: <input type="number" name="Inventory" class="inputtext" min="0" style="width:150px";><br>
			折價比率: <input type="number" name="Discount_rate" class="inputtext" min="0" max="100" style="width:150px";><br>
			商品貨號: <input type="text" name="GID" class="inputtext" style="width:150px";><br>
			<!-- 篩選條件 -->
			<div id="search_checkbox">
				<input type="checkbox" name="checkbox_bid" id="checkbox_bid" value="0">
				<label for="checkbox_bid">是否為競標商品</label>
				<!-- 送出按鈕 -->
				<input id="modify_submit" type="submit" name="submit" value="Modify">
				<!--新增-->
				<input id="add_submit" type="submit" name="submit" value="Add">
				<!--刪除-->
				<input id="del_submit" type="submit" name="submit" value="Del">
			</div>
		</form>
	</div>


	<table frame=void style="background-color:#C9BAE8;border-radius:10px;padding:10px;font-size:15px;position:relative;top:120px;left:50%;margin-left:-300px;">
	<div class="relative" id="show">
		<?php
			$u=$_SESSION['user'];
			$sql="SELECT * FROM good where uid =$u ";
			include "readdb.php";
			$conn = readDb("liesell");
			if (!$conn)
			{
				die("Connection failed: " . mysql_connect_error());
			}	
			$db_result = mysqli_query($conn,"SELECT * FROM user") or die("查詢失敗");
			$result=mysqli_query($conn,$sql);
			$row=mysqli_fetch_row($result);
			$col=mysqli_num_fields($result);



			if ( $result = mysqli_query($conn, $sql))
			{
				echo "<tr>";
				echo "<td>GoodID</td><td>SellerID</td><td>Classification</td><td>Good Name</td><td>Price</td><td>Inventory</td><td>Discount</td><td>Bid</td>";
				echo "</tr>";
				for ($i = 0 ; $i<mysqli_num_rows($result);$i++)
				{
					$row = mysqli_fetch_row($result); 
					echo "<tr>";
					for($j=0;$j<$col;$j++)
					{	$out = json_decode(json_encode($row),true);
						echo "<td>";
						if($j==5){if($out[5]==0){echo "待補貨";}else{echo $out[$j];}}
						else if($j==7){if($out[7]==0){echo "No";}else{echo "Yes";}}
						else{echo $out[$j];}
						echo "</td>";
					}
					echo "</tr>";
				}
			}
		?>
	</div>

</body>
</html>