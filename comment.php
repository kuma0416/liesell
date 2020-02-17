<?php
ob_start();
session_start();
include "readdb.php";
$conn = readDb("liesell");
?>
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
<table frame=void style="background-color:#C9BAE8;border-radius:10px;padding:10px;font-size:15px;position: relative;left: 120px">
	<tr style="visibility: hidden;">
      	<td width="200px">
      	<td width="200px">
      </tr>
<?php
$gid=$_GET['gid'];
echo "<tr>";
echo "<td>Message</td><td>Score</td>";
echo "</tr>";
$flag=0;
if(isset($_SESSION['user'])){
$u=$_SESSION['user'];
$usql="SELECT UID FROM user where UID <= '0100'";
$uresult=mysqli_query($conn,$usql);
$urow=mysqli_fetch_row($uresult);
for($i=0;$i<mysqli_num_rows($uresult);$i++){
$uout = json_decode(json_encode($urow),true);
if(!empty($u)){
if($uout[0]==$u){
$flag=1;}}
$urow = mysqli_fetch_row($uresult);}}

$tempsql="SELECT * FROM record where GID ="."'".$gid."'";
$tempresult=mysqli_query($conn,$tempsql);
$temprow=mysqli_fetch_row($tempresult);
$tempcol=mysqli_num_fields($tempresult);
if ( $tempresult = mysqli_query($conn, $tempsql)){
for ($i = 0 ; $i<mysqli_num_rows($tempresult);$i++){
$temprow = mysqli_fetch_row($tempresult); 
$out = json_decode(json_encode($temprow),true);
$temprid=$out[0];
$sql="SELECT * FROM comment where RID ="."'".$temprid."'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_row($result);
if ( $result = mysqli_query($conn, $sql)){
for ($k = 0 ; $k<mysqli_num_rows($result);$k++){
$row = mysqli_fetch_row($result); 
echo "<tr>";
$out = json_decode(json_encode($row),true);
echo "<td>";
echo $out[1];
echo "</td>";
echo "<td>";
echo $out[2];
echo "</td>";
if($flag==1){echo "<td>";echo "<button onclick=\"location.href='comment_delete.php?rid=$temprid'\">Del</button>";echo "</td>";}
echo "</tr>";}}}}
?>
</table>
</div>
</body>
</html>