<?php
	ob_start();
	session_start();
	include "readdb.php";
	$userID=$_SESSION['user'];
	$sellerID=0;
	$tempgid=$_SESSION['tempid'];
	$buynum=$_SESSION['num'];
	$conn=readDB('liesell');
	$sql_pur="SELECT * FROM good WHERE GID=".$tempgid;
	$pur_result=mysqli_query($conn,$sql_pur);
	$row=mysqli_fetch_row($pur_result);
	$col=mysqli_num_fields($pur_result);
	for ($i = 0 ; $i<mysqli_num_rows($pur_result);$i++){
		$out=json_decode(json_encode($row),true);
		$row=mysqli_fetch_row($pur_result);
		for($j=0;$j<$col;$j++){
			echo "<br>";
			if($j==1){
				$sellerID=$out[$j];
			}
		}
	}
	if ($sellerID==$userID){
		echo "<script>alert('不能購買自己所拍賣之物品!')</script>";
		echo "<script>window.location.href = 'homepage.php'</script>";
	}
	elseif ($buynum==0){
		echo "<script>alert('購買數量不得為0!')</script>";
		echo "<script>window.location.href = 'homepage.php'</script>";
	}
	else{
		echo "<script>window.location.href = 'transaction_2.php'</script>";
	}
?>