<!DOCTYPE html>
<html>
<head>
<title>comment</title>
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
<body  style="margin:0px;background-color:#EEE7E8;">
	<div class="head">
  	<img src="logo.png" width="115" height="66" border="0" onclick="location.href='homepage.php'">
	</div>
	<button onclick="location.href='logout.php'" style="float:right;position:relative;top:-70px;border:1;background-color:#b3d9d9;color:#fff;border-radius:10px;height:50px;width:150px">Log out</button>
	<button onclick="location.href='user interface.php'" style="float:right;position:relative;top:-70px;right:20px;border-radius:10px;border:1;background-color:#b3d9d9;color:#fff;height:50px;width:150px">User interface</button>
	<div style="position:relative;top:100px;left:50%;margin-left:-300px;background-color:#FCCDAB;width:600px;height: 150px;border-radius:10px;padding:10px;box-shadow: 0 10px 6px -6px #777;text-align-last: center;">
	<div id="comment">
		<form id="score_form" action="commentquery.php" method="POST" accept-charset="utf-8">
		<!-- ¤U©Ô¿ï³æ -->
			<div id="score_box">
				<select name="list2" id="list2">
					<option value="0">Star</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
				</select>
			</div>
			<div style="position: relative;left:-20px;height: 20px;">
			<br>
			Comment: <input type="text" name="Message" class="inputtext" required style="width:300px";><br>
			</div>
			<div id="search_checkbox">
				<input id="add_submit" type="submit" name="submit" value="Sent" style="position: relative;top:50px;border-radius: 10px;width: 60px;height: 30px;">
			</div>
		</form>
	</div>

</body>
</html>