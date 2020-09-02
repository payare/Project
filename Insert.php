<?php

$conn = mysqli_connect("localhost","root","","mydata") or die(mysqli_error());
// $db = mysql_select_db('mydata',$conn ) or die(mysql_error());

if(!$conn)
{
	die('Connection failed!'.mysqli_error($conn));
}

$sno = $_POST['Id'];
$name = $_POST['Name'];
$uname = $_POST['Email'];
$pwd = $_POST['Password'];
$Conpwd = $_POST['Confirm Password'];

$sql = "INSERT INTO registration(Id, Name, Email, Password,Confirm Password) VALUES('$sno', '$name','$uname',
 '$pwd','$Conpwd')";

if(mysqli_query($conn,$sql))
{
	echo "Registerd Successfully";
}
else
{
	echo mysql_error($conn);
}

?>