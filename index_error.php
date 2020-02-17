<?php 
	ob_start();
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>登入</title>
</head>
<body background="login.png" style="background-repeat:no-repeat;background-size: cover;margin:0px;">
    <div class="head">
    <img src="logo.png" width="115" height="66" border="0" onclick="location.href='homepage.php'">
    </div>
	<div id="login" class="absolute" style="background-color:#C9FFFF;box-shadow: 0 10px 6px -6px #777;border-color:#008F8F;border:dotted;
        border-radius:30px;
        border-width:1.5px;
        border-color:
        width:300px;
        height:300px;">
		<form id="login_form" action="multiple_query.php" method="POST" accept-charset="utf-8">
			<!-- 輸入欄 -->
			<div class="Data-Title">
				<div class="AlignRight">
					<br><br><br><br>
			Account:
			Password:
				</div>
			</div>
			<div class="Data-Items">
				<br><br><br><br>
			<input type="text" name="account_">
			<br>
			<input type="text" name="psw">
			<br>
			<br>
			<h2 style="color:red;position: relative;top:60px;">error!</h2>
			<br>
			</div>
			<!-- 送出按鈕 -->
			<input id="login_submit" type="submit" name="submit" value="Log in"  onclick="multiple_query.php" class="button">
		</form>
	</div>
<style type="text/css">
	.absolute {
            position:absolute;
            left:50%;
            top:50%;
            margin-top:-200px;
            margin-left:-180px;
        }
    .Data-Title {
        float: left;
        width: 30%; /* Label寬度，視情況調整 */
        margin-right: 20px;
        border-style:none;
    }
    .Data-Items {
        float: left;
        width: 30%;
        border-style:none;
    }
    .AlignRight {
        text-align: right;
        border-style:none;
    }
    .button{
    	position:absolute;
        top:160px;
        left:112px;
        border-radius:10px;
        height:30px;
        width:60px;
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