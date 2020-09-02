<?php


if(isset($_POST['Role']))
{
   $role = $_POST['Role'];
   
   
switch ($role) {
   case 1:
      header("Location:insertdata.php");
      exit;
   break;

   case 2:
      header("Location: Checkerdata.php");
      exit;
   break;

   case 3:
      header("Location: ViewerData.php");
      exit;
   break ;
   default : echo "Please select Role";
   exit;
}
}
else {
  // Function call 
  echo "plese select role";

   //header("Location: Role.php");

}
   ?>