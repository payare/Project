<?php
include_once 'database.php';
if(isset($_POST['save']))
{	 
	 $first_name = $_POST['First_name'];
	 $last_name = $_POST['Last_name'];
	 $email = $_POST['Email'];
	 $Contact_No = $_POST['Contact_No'];
	 $Password = $_POST['Password'];
     $ConfirmPassword = $_POST['ConfirmPassword'];
     $Checker_Id = $_POST['Checker_Id'];
     $Department_Name = $_POST['Department_Name'];

	 $user_check_query = "SELECT * FROM userdetails WHERE Email='$email' and Type='C' LIMIT 1";
     $result = mysqli_query($conn, $user_check_query);
     $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['Email'] == $email) {
      echo  "Checker already exists";
    }

    }
else{
	//  $sql = "INSERT INTO checkerdata (First_name,Last_name,email,Contact_No,Password,
    //  ConfirmPassword,Employee_Id,Department_Name )
	//  VALUES ('$first_name','$last_name',$email',$Contact_No,'$Password','$Confirm_password',
	//  '$Checker_Id','$Department_Name')";
	$sql = "INSERT INTO userdetails (First_name,Last_name,Email,Contact_No,Password,Confirm_password,
	Checker_Id,Viewer_Id,Department_Name,Type)
	VALUES ('$first_name','$last_name','$email','$Contact_No','$Password' , '$ConfirmPassword',
	'$Checker_Id','','$Department_Name','C')";
	 if (mysqli_query($conn, $sql)){ 
		echo "New record created successfully !";
	 } else {
		echo "Error: " . $sql . "
" . mysqli_error($conn);
	 }
	 mysqli_close($conn);
	}
}
?>