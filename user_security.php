<?php
	session_start();
	if(isset($_SESSION['unique_user']))
	{
		
	}
	else
	{
		header("location:login.php");	
	}

?>