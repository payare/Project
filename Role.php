
<?php

if(isset($_POST['Submit']))
{
   
if(isset($_POST['Role']))
{
   $role = $_POST['Role'];
  
   session_start();
                            
   // Store data in session variables
  
switch ($role) {
   case 1:
      $_SESSION["Role"] = "M";
      header("Location:insertdata.php");
     
      exit;
   break;

   case 2:
      $_SESSION["Role"] = "C";
      header("Location: Checkerdata.php");
      exit;
   break;

   case 3:
      $_SESSION["Role"] = "V";
      header("Location: ViewerData.php");
      exit;
   break ;
   
}
}
else {
  // Function call 
  echo "please select role";

   //header("Location: Role.php");

}

}

   ?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>


<h1 id="headname"> Secure Login System</h1>
<form method="post" >
<div class="container">
   
  <p> Select Role to access system:</p>
  <input type="radio" id="male" name="Role"  value="1" >
  <label for="male">Maker</label>
  <input type="radio" id="female" name="Role"  value="2"  >
  <label for="female">Checker</label>
  <input type="radio" id="other" name="Role"  value="3" >
  <label for="other">Viewer</label>

  <br><br>
  <input type="submit" value="Submit" name="Submit">
  <div>
</form>

</body>
</html>
