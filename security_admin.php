<?php
	session_start();
	if(isset($_SESSION['unique']))
	{
		
	}
	else
	{
		header("location:login.php");	
	}

?>