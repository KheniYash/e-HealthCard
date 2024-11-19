<?php
	session_start();
	if(isset($_SESSION['unique_hospital']))
	{
		
	}
	else
	{
		header("location:login.php");	
	}

?>