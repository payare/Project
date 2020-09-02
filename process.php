<?php
include_once 'database.php';
if(isset($_POST['save']))
{	 
	 $first_name = $_POST['First_name'];
	 $last_name = $_POST['Last_name'];
	 $email = $_POST['Email'];
	 $Contact_No = $_POST['Contact_No'];
	 $Password = $_POST['Password'];
	 $Confirm_password = $_POST['Confirm_password'];


	 if (empty($first_name)) {
		echo  "First Name is required" ;
		exit();
	}
	if  (empty($last_name)) {
		echo "Last Name is required";
		exit();
	}
	if  (empty($email)) {
		echo "email is required";
		exit();
	}
	 if  (empty($Contact_No)) {
		echo "Contact_No is required";
		exit();
	}
	 if  (empty($Password)) {
		echo "Password is required";
		exit();
	}
	 if  (empty($Confirm_password)) {
		echo "Confirm_password is required";
		exit();
	}
	if($Password!=$Confirm_password)
	{
		echo "Password should be same";
	}


	//$passwordhash = password_hash($password, PASSWORD_DEFAULT);
	 $user_check_query = "SELECT * FROM userdetails WHERE Email='$email' and Type='M' LIMIT 1";
     $result = mysqli_query($conn, $user_check_query);
     $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['Email'] == $email) {
	  echo  "Maker already exists";
	  
    }

    }

	else
	{
	 $sql = "INSERT INTO userdetails (First_name,Last_name,Email,Contact_No,Password,Confirm_password,
	 Checker_Id,Viewer_Id,Department_Name,Type)
	 VALUES ('$first_name','$last_name','$email','$Contact_No','$Password' , '$Confirm_password',
	 '','','','M')";
	 if (mysqli_query($conn, $sql)) {
		echo "New record created successfully !";
	 } else {
		echo "Error: " . $sql . "
" . mysqli_error($conn);
	 }
	 mysqli_close($conn);
	}
}
?>