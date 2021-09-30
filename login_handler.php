<html>
	<head>
		<title>Add New Login Details</title>
	</head>
	<body>
	<?php
			if(isset($_POST['Submit']))
			{
				$data_missing=array();
				if(empty($_POST['Name']))
				{
					$data_missing[]='User Name';
				}
				else
				{
					$user_name=trim($_POST['Name']);
				}
				if(empty($_POST['Password']))
				{
					$data_missing[]='Password';
				}
				else
				{
					$password=$_POST['Password'];
				}

				if(empty($data_missing))
				{
					require_once('mysqli_connect.php');
					$query="INSERT INTO loginform (User,Password) VALUES (?,?)";
					$stmt=mysqli_prepare($dbc,$query);
					mysqli_stmt_bind_param($stmt,"ss",$user_name,$password);
					mysqli_stmt_execute($stmt);
					$affected_rows=mysqli_stmt_affected_rows($stmt);
					//echo $affected_rows."<br>";
					// mysqli_stmt_bind_result($stmt,$cnt);
					// mysqli_stmt_fetch($stmt);
					// echo $cnt;
					mysqli_stmt_close($stmt);
					mysqli_close($dbc);
					/*
					$response=@mysqli_query($dbc,$query);
					*/
					if($affected_rows==1)
					{
						echo "New Record Inserted Sucessfully";
					}
					else
					{
						echo "Submit Error";
						echo mysqli_error();
					}
				}
				else
				{
					echo "The following data fields were empty! <br>";
					foreach($data_missing as $missing)
					{
						echo $missing ."<br>";
					}
				}
			}
			else
			{
				echo "Submit request not received";
			}
		?>
	</body>
</html>