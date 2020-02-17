<?php 
	ob_start();
	session_start();

	if($_POST['submit'])
	{
		$password_where = array();
		$account_where = "";
		if(isset($_POST['account_'])){
			$account_where  = " account ='".$_POST['account_']."' and ";
		}
		if(isset($_POST['psw'])){
			$password_where[]  = " password ='".$_POST['psw']."'";
		}
		$where_str = " WHERE ".$account_where.implode(" And ",$password_where);
		$sql = "SELECT * from user ".$where_str;
		include "readdb.php";
		$conn = readDb("liesell");
		if (!$conn) {
			die("Connection failed: " . mysql_connect_error());
		}	
		$db_result = mysqli_query($conn,"SELECT * FROM user") or die("查詢失敗");
		$result=mysqli_query($conn,$sql);
		$row=mysqli_fetch_row($result);
		if ( $result = mysqli_query($conn, $sql))
		{
			$i=0;
			while ( $meta = mysqli_fetch_field($result)) 
			{
				$i++;
			}
		}
		if($row[0]==NULL)
		{
			header("Location: ./index_error.php");
		}
		else
		{
			$_SESSION['account'] = $_POST['account_'] ;
			$_SESSION['password'] = $_POST['psw'] ;
			header("Location: ./homepage.php");
		}
	}
	//header('refresh:2;url="index.php"')
?>