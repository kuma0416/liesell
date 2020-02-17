<?php 	
	function readDb($dbName)
	{
		$dbName = 'liesell';
		$conn = mysqli_connect( 
			'localhost',  // MySQL主機名稱 
			'root',       // 使用者名稱 
			'',  // 密碼
			$dbName);  // 預設使用的資料庫名稱
		$sql = "SELECT * FROM user";
		mysqli_query($conn,$sql);

		if(!mysqli_select_db($conn, $dbName))
		{
		   die("無法開啟 $dbName 資料庫!<br/>");
		}
		return $conn;
	}
?>