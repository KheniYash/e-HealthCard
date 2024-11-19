<?php
	session_start();
	if(isset($_SESSION['unique_doctor']))
	{
		
	}
	else
	{
		header("location:login.php");	
	}

?>