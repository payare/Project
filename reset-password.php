<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect to login page
//if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    //header("location: login.php");
    //exit;
//}
 
// Include config file
require_once "Database.php";
 
// Define variables and initialize with empty values
$new_password = $confirm_password = $username="";
$new_password_err = $confirm_password_err =$username_err= "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have atleast 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    if(empty(trim($_POST["username"]))){
        $username_err = "Please username.";
    } else{
        $username = trim($_POST["username"]);
        
    }

    
        
    
    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err) && empty($username_err)){
        // Prepare an update statement
        $sql = "UPDATE userdetails SET Password = ? WHERE Email = ? and Type= ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_password, $param_id,$param_type);
            
            // Set parameters
            $param_password = $new_password;
            //$param_password = $new_password;
            //$param_id = $_SESSION["id"];
            //$param_id =$username;
            $param_id = (isset($_POST['username']) ? $_POST['username'] : '');
            $param_type=$_SESSION["Role"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){

                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                if(mysqli_stmt_num_rows($stmt)!=0)
                {
                    header("location: login.php");
                    exit();
                }
                else{
                    echo "You are accesing system with other role";
                }
               
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($conn);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Reset Password</h2>
        <p>Please fill out this form to reset your password.</p>
        <form  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"> 
        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>username</label>
                <input type="text" name="username" class="form-control"
                 value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                <label>New Password</label>
                <input type="password" name="new_password" class="form-control"
                 value="<?php echo $new_password; ?>">
                <span class="help-block"><?php echo $new_password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a class="btn btn-link" href="welcome.php">Cancel</a>
            </div>
        </form>
    </div>    
</body>
</html>

