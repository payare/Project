<?php
include_once 'database.php';
if(isset($_POST['save']))
{	 
	$username = $_POST['Email'];
	$password = $_POST['Password'];
	$passwordHashed = password_hash($password, PASSWORD_BCRYPT);
	
		$sql = "Select * From userdetails Where Email ='$username'";
	
	
	$sql = $conn->query($sql);
	if($sql)
	{
		$sql = $sql->fetch_assoc();
		
		//if(password_verify($password, $sql['Password']))
		if($password==$sql['Password'])
		{
			session_start();
			$_SESSION['username'] = $username;
			echo "You have successfully logged-in";
			//header('location: role.php');
		}
		else
		{
			echo "You have entered wrong username and password";
		}
	}
	else
	{
		echo "You have done wrong";
		 //header('location: role.php');
		 //exit();
	}
}


?>