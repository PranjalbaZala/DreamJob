<!DOCTYPE HTML>
<html>
<?php
	$con=mysqli_connect("localhost","root");
	$db=mysqli_select_db($con,"pms");
	if($con)
	{
		if(isset($_POST['login']))
		{
			if(isset($_POST['email']))
				$email = $_POST['email'];
			if(isset($_POST['password']))
			{
				$password = $_POST['password'];
				$password = md5($password);
			}		
		}
		$sql="SELECT `email`,`password` FROM student;";
		$query=mysqli_query($con,$sql);
		if($query)
		{
			while ($row=mysqli_fetch_array($query))
			{
				if($email==$row['email'] && $password==$row['password'])
				{
					session_start();
					$_SESSION['email']=$email;
					header("location:loginPage_Student.php");
				}
			}
			if(!isset($_SESSION['email']))
			{
			echo '<script type="text/javascript">
						alert("Wrong Email-ID or Password Entered!");
					</script>';
					header('refresh:1;url=login.html');
			}
		}
		else
			echo die(mysqli_error($con));
	}
			
	else
	{
		echo 'Not Connected To The Server';
	}
?>
</html>