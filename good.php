<?php
ob_start();
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>liesell</title>
</head>
<body>
<table border="1">
<?php
ob_start();
session_start();
$c=$_GET['clas'];
$sql="SELECT * FROM good where classification ="."'".$c."'";
$_SESSION['classification']=$sql;
header("Location: ./homepage.php");
?>
</body>
</html>