<?php

	if(isset($_POST['btn']))
	{
		$id = $_POST['id'];

		$yash = explode("@", $id);

		print_r($yash);

		$i=0;

		foreach($yash as $data)
		{

			if($i==1)
			{
				if($data == 'admin')
				{
					echo "admin";
				}
				elseif($data == 'hospital')
				{
					echo "hospital";
				}
				elseif($data == 'doctor')
				{
					echo "doctor";
				}
				else
				{
					echo ",,user";
				}


			}

			$i = $i + 1;

			
		}

		if($i==1)
		{
			echo "null";
		}
	}


?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>


	<form method="post">
		
		<input type="text" name="id">

		<input type="submit" name="btn">

	</form>


</body>
</html>