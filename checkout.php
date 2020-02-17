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
	<?php
		ob_start();
		session_start();
		include "readdb.php";
		$goodID=$_SESSION['tempid'];
		$conn=readDB('liesell');
		$sql_good="SELECT GNAME FROM good WHERE GID=".$goodID;
		$good_result=mysqli_query($conn,$sql_good);
		$good_row=mysqli_fetch_row($good_result);
		$good_col=mysqli_num_fields($good_result);
		$one=1;
		echo "購買物品名稱為:";
		for ($i = 0 ; $i<mysqli_num_rows($good_result);$i++){
			$good_out=json_decode(json_encode($good_row),true);
			$good_row=mysqli_fetch_row($good_result);
			for($j=0;$j<$good_col;$j++){
				echo $good_out[$j];
			}
		}
		echo "<br>";
		echo "購買數量為:";
		echo $_SESSION['num'];
		echo "<br>";
		if($_SESSION['couponses']==0){
			echo "此次無使用coupon";
		}
		else{
			echo "使用優惠券為:";
			echo $_SESSION['couponses'];
			echo "<br>";
			echo "此優惠券為 ";
			echo $_SESSION['couponrate'];
			echo "% 優惠券";
			$sql_usecou="DELETE FROM coupon WHERE CID=".$_SESSION['couponses'];
			$del_cou=mysqli_query($conn,$sql_usecou);
		}
		echo "<br>";
		echo "總金額為:";
		$total=$_SESSION['total_money'];
		echo round($total,0);
		$now_inven=$_SESSION['allinventory']-$_SESSION['num'];
		$sql_upinventory="UPDATE good SET INVENTORY = ".$now_inven." WHERE GID = ".$_SESSION['tempid'];
		$upinven=mysqli_query($conn,$sql_upinventory);


		function GeraHash($qtd)
		{
			$Caracteres = '0123456789';
			$QuantidadeCaracteres = strlen($Caracteres);
			$QuantidadeCaracteres--;
			$Hash=NULL;
	    		for($x=1;$x<=$qtd;$x++)
	    		{
	    			$Posicao = rand(0,$QuantidadeCaracteres);
	        		$Hash .= substr($Caracteres,$Posicao,1);
	        	}
			return $Hash;
		}
		function Check($temp)
		{
			$sql="SELECT * FROM good where GID = $temp";
			$conn = readDb("liesell");
			if (!$conn) 
			{
				die("Connection failed: " . mysql_connect_error());
			}	
			$db_result = mysqli_query($conn,"SELECT * FROM user") or die("查詢失敗");
			$result=mysqli_query($conn,$sql);
		}
		$temp = GeraHash(4);
		Check($temp);
		while(isset($result))
		{
			$temp = GeraHash(4);
			Check($temp);
		}


		$sql_record="INSERT INTO record VALUES ('".$temp."','".$_SESSION['tempid']."','".$_SESSION['user']."','".$_SESSION['total_money']."','".$_SESSION['num']."','".date('Y-m-d')."','0')";
		echo "<br>";
		$sql_totalres=mysqli_query($conn,$sql_record);
		
	?>
	<br>
	<form id='search_form' action='homepage.php' method='POST' accept-charset='utf-8'>
	<input type='submit' name='goback' value='回首頁'>
	</form>
</div>
</body>
</html>