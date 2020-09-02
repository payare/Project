<?php
include_once 'database.php';
$First_name=$Last_name=$Contact_No=$Email=$password = $confirm_password= $Viewer_Id=$Department_Name="";
$First_Name_err=$Last_name_err=$Contact_No_err=$Email_err=$password_err = $confirm_password_err
=$Viewer_Id_err=$Department_Name_err ="";
if(isset($_POST['save']))
{	 
	if (empty($_POST['First_name'])) {
		$First_Name_err=  "First Name is required" ;
		}
		else{
			$First_name = $_POST['First_name'];
		}
	
	if (empty($_POST['Last_name'])) {
			$Last_name_err=  "Last Name is required" ;
			}
			else{
				$Last_name = $_POST['Last_name'];
			}
			if (empty($_POST['Contact_No'])) {
				$Contact_No_err=  "Contact_No is required" ;
				}
				else{
					$Contact_No = $_POST['Contact_No'];
				}
				if (empty($_POST['Email'])) {
					$Email_err=  "Email is required" ;
					}
					elseif(!filter_var($Email, FILTER_VALIDATE_EMAIL))
					{
						$Email_err = "Invalid email format"; 
					}
					else{
						$Email = $_POST['Email'];
					}

				// Validate password
				if(empty(trim($_POST["password"]))){
					$password_err = "Please enter a password.";     
				} elseif(strlen(trim($_POST["password"])) < 6){
					$password_err = "Password must have atleast 6 characters.";
				} else{
					$password = trim($_POST["password"]);
				}
				
				// Validate confirm password
				if(empty(trim($_POST["confirm_password"]))){
					$confirm_password_err = "Please confirm password.";     
				} else{
					$confirm_password = trim($_POST["confirm_password"]);
					if(empty($password_err) && ($password != $confirm_password)){
						$confirm_password_err = "Password did not match.";
					}
				}
				if (empty($_POST["Viewer_Id"])) {
					$Viewer_Id_err=  "Viewer ID  is required" ;
					}else{
						$Viewer_Id = $_POST["Viewer_Id"];
					}
					if (empty($_POST["Department_Name"])) {
						$Department_Name_err=  "Department  is required" ;
						}else{
							$Department_Name = $_POST["Department_Name"];
						}
	
	if(empty($First_Name_err) && empty($Last_name_err) && empty($Email_err) 
						&& empty($Contact_No_err)&& empty($password_err )&& empty($confirm_password_err)
						&& empty($Viewer_Id_err) && empty($Department_Name_err ))
						{

	 $user_check_query = "SELECT * FROM userdetails WHERE Email='$Email' and Type='V' LIMIT 1";
     $result = mysqli_query($conn, $user_check_query);
     $user = mysqli_fetch_assoc($result);
  
	 
	 if ($user) { // if user exists
		if ($user['Email'] == $Email) {
		  echo  "Viewer already exists";
		}
	
		}

else{
	 $sql = "INSERT INTO userdetails(First_name,Last_name,Email,Contact_No,Password,
	 Checker_Id,Viewer_Id,Department_Name,Type)
	VALUES ('$First_name','$Last_name','$Email','$Contact_No','$password' ,'',
	'$Viewer_Id',' $Department_Name','V')";
	 if (mysqli_query($conn, $sql)){ 
		echo "New record created successfully !";
	 } else {
		echo "Error: " . $sql . "
" . mysqli_error($conn);
	 }
	 mysqli_close($conn);
	}
}
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">

</head>
  <body>
  <!--action="Processview.php"-->
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
	<div class="ViewerReg">
	<h1>Viewer Registration</h1>
	<div class="form-group <?php echo (!empty($First_Name_err)) ? 'has-error' : ''; ?>">
                <label>First Name</label>
                <input type="text" name="First_name" class="form-control" value="<?php echo $First_name; ?>">
                <span class="help-block"><?php echo $First_Name_err; ?></span>
            </div>  
			<div class="form-group <?php echo (!empty($Last_Name_err)) ? 'has-error' : ''; ?>">
                <label>Last name</label>
                <input type="text" name="Last_name" class="form-control" value="<?php echo $Last_name; ?>">
                <span class="help-block"><?php echo $Last_name_err; ?></span>
            </div> 
			<div class="form-group <?php echo (!empty($Contact_No_err)) ? 'has-error' : ''; ?>">
                <label>Contact_No</label>
                <input type="text" name="Contact_No" class="form-control" value="<?php echo $Contact_No; ?>">
                <span class="help-block"><?php echo $Contact_No_err; ?></span>
            </div>  
			<div class="form-group <?php echo (!empty($Email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="text" name="Email" class="form-control" value="<?php echo $Email; ?>">
                <span class="help-block"><?php echo $Email_err; ?></span>
            </div> 
		
		
		<div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
		
			<div class="form-group <?php echo (!empty($Viewer_Id_err)) ? 'has-error' : ''; ?>">
                <label>Viewer ID</label>
                <input type="Text" name="Viewer_Id" class="form-control" 
				value="<?php echo $Viewer_Id; ?>">
                <span class="help-block"><?php echo $Viewer_Id_err; ?></span>
            </div>
	
			<div class="form-group <?php echo (!empty($Department_Name_err)) ? 'has-error' : ''; ?>">
                <label>Department Name</label>
                <input type="Text" name="Department_Name" class="form-control" value="<?php echo $Department_Name; ?>">
                <span class="help-block"><?php echo $Department_Name_err; ?></span>
            </div>
		
	<br><br>
		<input type="submit"  class="registerbtn" name="save" value="submit">
		<br><br>
		<a href="login.php">Already Registered </a> 
		</div>
	</form>
  </body>
</html>