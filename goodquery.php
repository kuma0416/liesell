<?php
ob_start();
session_start();
include "readdb.php";
$conn = readDb("liesell");

$GIDWRONG = "0";


$uid=$_SESSION['user'];
$submit = $_POST['submit'];

if(!isset($_SESSION['user']))
{
	header("Location: ./homepage.php");
}

if(isset($_POST['submit']))
{
	$where = array();
	$keyword_where = "";
	if(isset($_POST['Gname']))
	{
		$keyword_where  = " name like '%".$_POST['Gname']."%' and ";
	}
	if(isset($_POST['checkbox_bid'])) 
	{
		$where[]  = " N_bid =".$_POST['checkbox_bid'];
	}

	if($submit=='Modify')
	{
		//提出每個商品的GID
		$u=$_SESSION['user'];
		$gid=$_POST['GID'];
		$sql="SELECT * FROM good where uid =$u ";

		$result=mysqli_query($conn,$sql);
		$row=mysqli_fetch_row($result);
		$col=mysqli_num_fields($result);

		$row1compare = json_encode($row[0],true);
		$gidcompare = array();
		echo $row1compare;
		echo $gid;
		for ($i = 0 ; $i<mysqli_num_rows($result)-1;$i++)
		{
			$row = mysqli_fetch_row($result); 	
			$out = json_decode(json_encode($row),true);
				
			array_push($gidcompare, $out[0]);
		}



		$url = "./goodsmanager.php";
		
		//沒輸入GID
		if(empty($_POST['GID']))
		{
			$GIDWRONG = "1";

			echo "<script>alert('欲修改之商品GID不得為空')</script>";
			echo "<script>window.location.href = '$url'</script>";
		}
		else
		{
			//該GID不存在
			$qsql="SELECT GID FROM good where ( uid =$u AND gid=$gid )";
			$qresult=mysqli_query($conn,$qsql);
			$num=mysqli_num_rows($qresult);
			if($num==0)
			{
				$GIDWRONG = "1";

				echo "<script>alert('輸入之GID不存在')</script>";
				echo "<script>window.location.href = '$url'</script>";
			}

			$keyword_update = "";

			$where_str = " WHERE `GID` = ".$_POST['GID'];

			if(!empty($_POST['Gname'])){
				$keyword_update = $keyword_update." `GNAME` = '".$_POST['Gname'];
				$keyword_update = $keyword_update."'";
			}
			if(!empty($_POST['Price'])){
				$keyword_update = $keyword_update.", `PRICE` = ".$_POST['Price'];
			}
			if(!empty($_POST['Inventory'])){
				$keyword_update = $keyword_update.", `INVENTORY` = ".$_POST['Inventory'];
			}
			if(!empty($_POST['Discount_rate'])){
				$keyword_update = $keyword_update.", `DISCOUNTRATE` = ".$_POST['Discount_rate'];
			}

			if(!isset($_POST['checkbox_bid']))
			{
				$value_bid = "0";
			}
			else
			{
				$value_bid = "1";
			}
			$keyword_update = $keyword_update.", `NBID` = ".$value_bid;
		}


		$sql = "UPDATE good SET ".$keyword_update.$where_str;
		echo $sql;
	}


	if($submit=='Add')
	{
		$insertvalue = array();
		$keyword_insert1 = " VALUES (";
		$keyword_insert2 = ");";

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
		if(isset($_POST['Gname']) and isset($_POST['Price']) and isset($_POST['Inventory']) and isset($_POST['Discount_rate']))
		{
			if(!isset($_POST['checkbox_bid']))
			{
				$value_bid = "0";
			}
			else
			{
				$value_bid = "1";
			}
			array_push($insertvalue, "'".$temp."'", "'".$uid."'", "'".$_POST['list1']."'", "'".$_POST['Gname']."'", "'".$_POST['Price']."'", "'".$_POST['Inventory']."'", "'".$_POST['Discount_rate']."'", "'".$value_bid."'");
			$insert_str = implode(", ",$insertvalue);
			$sql = "INSERT INTO good".$keyword_insert1.$insert_str.$keyword_insert2;
			echo $sql;
		}
	}

	if($submit == 'Del')
	{
		if(isset($_POST['Gname']))
		{
			$delname = $_POST['Gname'];
		}
		else
		{
			echo "欲刪除之商品名不得為空!!";
		}
		$sql = "DELETE FROM good WHERE  GNAME = "."'".$delname."'"." AND UID = "."'".$uid."'";
		echo $sql;
	}
	
	$conn = readDb("liesell");
	if (!$conn) 
	{
		die("Connection failed: " . mysql_connect_error());
	}	
	$db_result = mysqli_query($conn,"SELECT * FROM user") or die("查詢失敗");
	$result=mysqli_query($conn,$sql);
	

	if($GIDWRONG == "0")
	{
		header("Location: ./goodsmanager.php");
	}
}
?>