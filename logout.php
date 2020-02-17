<?php
   ob_start();	
   session_start();
   unset($_SESSION['account']);
   unset($_SESSION['password']);
   unset($_SESSION['user']);
   header("Location: ./homepage.php");
   
?>