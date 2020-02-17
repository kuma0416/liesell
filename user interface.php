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
<title>使用者介面</title>
</head>
<body style="margin:0px;background-color:#EEE7E8;">
<div class="head">
    <img src="logo.png" width="115" height="66" border="0" onclick="location.href='homepage.php'">
    </div>
    <button onclick="location.href='logout.php'" style="float:right;position:relative;top:-70px;border:1;background-color:#b3d9d9;color:#fff;border-radius:10px;height:50px;width:150px">Log out</button>
<div class="title" style="height:300px;width:50">使用者介面</div>

<div id="header" class="bg" style="cursor:pointer;width:200px;
        height:100px;
        text-align:center;
        line-height:100px;" onclick="location.href='shopping_cart.php'">
<div class="text">Shopping cart</div></div>
<br><br>
<div id="header" class="bg" style="cursor:pointer;width:200px;
        height:100px;
        text-align:center;
        line-height:100px;" onclick="location.href='record.php'">
<div class="text">Record</div></div>
<br><br>
<div id="header" class="bg" style="cursor:pointer;width:200px;
        height:100px;
        text-align:center;
        line-height:100px;" onclick="location.href='coupon.php'">
<div class="text">Coupon</div></div>
<br><br>
<div id="header" class="bg" style="cursor:pointer;width:200px;
        height:100px;
        text-align:center;
        line-height:100px;" onclick="location.href='goodsmanager.php'">
<div class="text">Goods manager</div></div>

<style type="text/css">
    .bg{
    	position: relative;
        border:dotted;
        border-radius:30px;
        border-width:1.5px;
        border-color:#008F8F;
        box-shadow: 0 10px 6px -6px #777;
        left: 650px;
        top: -250px;
   	    background-color:#C9FFFF;
   	    background:rgba(255,255,255,0.6)
	}
    .text{
    	color:#8CFFFF;
    	font-size:20px;
    	font-family:fantasy;
    	text-shadow:black 0.1em 0.1em 0.2em;
    }
    .title{
    	position: relative;
    	color:#D6D6FF;
    	text-shadow:black 0.1em 0.1em 0.2em;
    	left: 550px;
    	top:50px;
    	font-size:50px;
    	writing-mode: vertical-lr;
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
</style>

</body>
</html>