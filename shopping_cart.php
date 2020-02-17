<?php
   ob_start();
   session_start();
   $uid=$_SESSION['user'];
	include ("readdb.php");
	$conn = readDb("liesell");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Cart page</title>
</head>
<body style="margin:0px;background-color:#EEE7E8;">

	<div class="head">
  	<img src="logo.png" width="115" height="66" border="0" onclick="location.href='homepage.php'">
	</div>
	<button onclick="location.href='logout.php'" style="float:right;position:relative;top:-70px;border:1;background-color:#b3d9d9;color:#fff;border-radius:10px;height:50px;width:150px">Log out</button>
	<button onclick="location.href='user interface.php'" style="float:right;position:relative;top:-70px;right:20px;border-radius:10px;border:1;background-color:#b3d9d9;color:#fff;height:50px;width:150px">User interface</button>

    <a href="?clear_cart" style="float:right;position:relative;right:-50px;top: 75px;">Clear Shoppint Cart</a>
    <?php

	if(isset($_GET['clear_cart'])) {
	$sql = "DELETE FROM cart WHERE  UID = $uid";
	$result=mysqli_query($conn,$sql);
	header("Location: ./shopping_cart_insert.php");
		}
    ?>

	<div id="cart_table" class="cart">
		<table frame=void style="background-color:#C9BAE8;border-radius:10px;padding:10px;box-shadow: 0 10px 6px -6px #777;" >
			<tr>
				<td><div style="color:#f3f3fa;font-size:16px;">Cart detail</div></td>
			</tr>
			<tr bgcolor="#ffe8e8">
				<th width="200px">GID</th>
				<th width="200px">SELLER UID</th>
				<th width="200px">CLASSIFICATION</th>
				<th width="500px">GNAME</th>
				<th width="200px">PRICE</th>
				<th width="200px">INVENTORY</th>
				<th width="200px">DISCOUNTRATE</th>
				<th width="200px">BID</th>
				<th width="1000px">OPTIONS</th>
			</tr>
<?php
$sql="Select * from cart where  UID ="."'".$uid."'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_row($result);
if ( $result = mysqli_query($conn, $sql)){
for ($i = 0 ; $i<mysqli_num_rows($result);$i++){
$row = mysqli_fetch_row($result); 
for($j=0;$j<1;$j++){
$out = json_decode(json_encode($row),true);
$gid=$out[1];
$gsql="SELECT * FROM good where GID ="."'".$gid."'";
$gresult=mysqli_query($conn,$gsql);
$grow=mysqli_fetch_row($gresult);
$gcol=mysqli_num_fields($gresult);
if ( $gresult = mysqli_query($conn, $gsql)){
for ($h = 0 ; $h<mysqli_num_rows($gresult);$h++){
$grow = mysqli_fetch_row($gresult); 
echo "<tr>";
for($k=0;$k<$gcol;$k++){
$gout = json_decode(json_encode($grow),true);
echo "<td>";
echo $gout[$k];
echo "</td>";}
echo "<td>";
echo "<button onclick=\"location.href='cart_delete.php?gid=$gid'\">Del</button>";
echo "<button onclick=\"location.href='comment.php?gid=$gid'\">Comment</button>";
if($gout[7]==0){echo "<button onclick=\"location.href='transaction.php?gid=$gid'\">Purchase</button>";}
else{echo "<button onclick=\"location.href='bid.php?gid=$gid'\">Bid</button>";}
echo "</td>";
echo "</tr>";
}}
}}}
echo "</table>";				
?>	
</div>



	<style type="text/css">
	.cart{
		width:2000px;
		margin: 0 auto;
		position: relative;
		top: 100px;
		left: 210px;
	}
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

</body>
</html>