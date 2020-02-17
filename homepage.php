<?php
ob_start();
session_start();
include "readdb.php";
$conn = readDb("liesell");
?>
<!DOCTYPE html>
<html style="height: 100vh;">
<head>
<meta charset="utf-8" />
<title>首頁</title>
<style type="text/css">
body {
  font-size:16px;
  font-weight:bold;
}
#nav ul {
 list-style-type:none;
 margin:0;
 padding:0;
 line-height:2.8;
}
#nav li {
  margin:1px;
  width:130px;
  position:relative;
}
#nav a {
 text-decoration: none;
 color:#000000;
 background:#99E7FF;
 padding:6px 5px 6px 15px;
 display:inline-block;
 width:100%;
 border-radius: 10px;
}
.sub ul {
  display:none;
  position:absolute;
  left:150px;
  top:-1px;
}
#nav .sub a {
  background:#cbe5ed;}
#nav li:hover .sub ul {
  display:block;}
#nav li a:hover {
  background:#a3a3a3;}
#menu>li:hover a {
  background:#cbe5ed;}
#menu>li:hover a:hover {
  background:#ffaaaa;}
#menu>li>a:after {
 content:">";
 font-family:"Georgia";
 color:#000000;
 position:absolute;
 right:2px;
 top:4px;
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
</head>

<body style="margin:0px;background-color:#EEE7E8;">

<div class="head">
  <img src="logo.png" width="115" height="66" border="0" onclick="location.href='homepage.php'">
</div>

<div id="button"  >


<?php
if(isset($_SESSION['account'])){
$v=$_SESSION['account'];
$t=$_SESSION['password'];
$sql="SELECT * FROM user where ( account=$v && password=$t)";
if (!$conn){
die("Connection failed: " . mysql_connect_error());}	
$db_result = mysqli_query($conn,"SELECT * FROM user") or die("查詢失敗");
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_row($result);
if ( $result = mysqli_query($conn, $sql)){
$out = json_decode(json_encode($row),true);
$_SESSION['user']=$out[0];}}
?>


<?php
if (isset($_SESSION['account'])){
  echo "<button onclick=\"location.href='logout.php'\" style=\"float:right;position:relative;top:-70px;border-radius:10px;border:1;background-color:#b3d9d9;color:#fff;border-radius:10px;height:50px;width:150px\">Log out</button>"."<br>";
	echo "<button onclick=\"location.href='user interface.php'\" style=\"float:right;position:relative;top:-92px;right:20px;border-radius:10px;border:1;background-color:#b3d9d9;color:#fff;border-radius:10px;height:50px;width:150px\">User interface</button>"."<br>";
	
}else{
	echo "<button onclick=\"location.href='index.php'\" style=\"float:right;position:relative;top:-70px;border-radius:10px;border:1;background-color:#b3d9d9;color:#fff;border-radius:10px;height:50px;width:150px\">Log in</button>"."<br>";}
?>
</div>

<div id="nav">
<ul id="menu">
<li><a href="#">3C</a>
  <div class="sub">
   <ul>
       <li><a href="good.php?clas=computer">電腦</a></li>
       <li><a href="good.php?clas=cellphone">手機</a></li>
   </ul>
  </div>
</li>
<li><a href="#">服飾</a>
  <div class="sub">
   <ul>
       <li><a href="good.php?clas=clothes">上衣</a></li>
       <li><a href="good.php?clas=pants">褲裙</a></li>
       <li><a href="good.php?clas=shoes">鞋子</a></li>
       <li><a href="good.php?clas=accessory">配件</a></li>
   </ul>
  </div>
</li>
<li><a href="#">美妝保健</a>
  <div class="sub">
   <ul>
       <li><a href="good.php?clas=cosmetic">保養品</a></li>
       <li><a href="good.php?clas=makeup">化妝品</a></li>
   </ul>
  </div>
</li>
<li><a href="#">美食</a>
  <div class="sub">
   <ul>
       <li><a href="good.php?clas=snack">零食</a></li>
       <li><a href="good.php?clas=drink">飲料</a></li>
       <li><a href="good.php?clas=dessert">蛋糕、甜點</a></li>
   </ul>
  </div>
</li>
<li><a href="#">汽機車</a>
  <div class="sub">
   <ul>
       <li><a href="good.php?clas=bicycle">機車</a></li>
       <li><a href="good.php?clas=car">汽車</a></li>
   </ul>
  </div>
</li>
<li><a href="#">寵物</a>
  <div class="sub">
   <ul>
       <li><a href="good.php?clas=feed">飼料</a></li>
       <li><a href="good.php?clas=pet_clothes">寵物服飾</a></li>
   </ul>
  </div>
</li>
<li><a href="#">遊戲王</a>
  <div class="sub">
   <ul>
       <li><a href="good.php?clas=core">主機</a></li>
       <li><a href="good.php?clas=table_game">桌遊</a></li>
       <li><a href="good.php?clas=game_point">點數</a></li>
   </ul>
  </div>
</li>
</ul>
</div>

<div style="float:right;position:relative;right:150px;top:-400px;">
  <table frame=void style="background-color:#C9BAE8;border-radius:10px;padding:10px;box-shadow: 0 10px 6px -6px #777;">
  <?php
if(isset($_SESSION['classification'])){
$sql=$_SESSION['classification'];}
else{$sql="SELECT * FROM good ";}
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_row($result);
$col=mysqli_num_fields($result);
if ( $result = mysqli_query($conn, $sql)){
echo "<tr>";
echo "<td>GoodID</td><td>SellerID</td><td>Classification</td><td>Good Name</td><td>Price</td><td>Inventory</td><td>Discount(%)</td><td>Bid</td>";
echo "</tr>";
for ($i = 0 ; $i<mysqli_num_rows($result);$i++){
$row = mysqli_fetch_row($result); 
echo "<tr>";
for($j=0;$j<$col;$j++){
$out = json_decode(json_encode($row),true);
echo "<td>";
if($j==0){
$tempgid=$out[$j];}
if($j==5){if($out[5]==0){echo "待補貨";}else{echo $out[$j];}}
else if($j==7){if($out[7]==0){echo "No";}else{echo "Yes";}}
else{echo $out[$j];}
echo "</td>";}
echo "<td>";
echo "<button onclick=\"location.href='comment.php?gid=$tempgid'\">Comment</button>";
echo"</td>";
if (isset($_SESSION['account'])){
echo "<td>";
echo "<button onclick=\"location.href='shopping_cart_insert.php?gid=$tempgid'\">Put In Cart</button>";
echo "</td>";
if($out[7]==0){
echo "<td>";
echo "<button onclick=\"location.href='transaction.php?gid=$tempgid'\">Purchase</button>";
echo "</td>";}
else{
echo "<td>";
echo "<button onclick=\"location.href='bid.php?gid=$tempgid'\">Bid</button>";
echo "</td>";}}
echo "</tr>";}}
unset($_SESSION['classification']);
  ?>
</table>
</div>

<div style="position:relative;left:50%;bottom:-180px;margin-left:-50px">
© 2019 group 11 <sup>tw</sup>
</div>

</body>
</html>