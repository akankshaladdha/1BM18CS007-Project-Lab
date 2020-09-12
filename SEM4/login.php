<?php

session_start();
 
 require_once("config.php");

 $db_host="localhost";
 $db_user="root";
 $db_pass="";
 $db_name="project_4";

 $con = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
 if(isset($_POST['login']))
 {
     $first = $_POST['firstname'];
     $emailid = $_POST['email'];
     $pass = $_POST['password'];
     $one = "akankshaladdha5@gmail.com";
     
     $sql = " select * from login where loginemail='".$emailid."' limit 1";
     $result= mysqli_query($con,$sql);
     $row=mysqli_fetch_array($result);
     $count=mysqli_num_rows($result);

     if($row['fname']==$first && $row['loginemail']==$emailid && $row['password']==$pass && $count == 1)
     {
       $code=$row['status'];
      $sql = " select * from registration where email='".$emailid."' limit 1";
      $result= mysqli_query($con,$sql);
      $row=mysqli_fetch_array($result);
      $_SESSION['lastname']=$row['lastname']; 

         $_SESSION['firstname']=$first;
         $_SESSION['email']=$emailid;
          $_SESSION['phonenumber']="";

         
         if($code=="true" || $code=="1")
         {
           if($one==$_SESSION['email'])
           {
             header('location:main.php');
           }
           else{
            header('location: admin.php');
           }
         }
         else
         {
            echo '<script>'; 
            echo "alert('E-mail not verified')";
            echo '</script>';
         }
     }
     else
     {
        echo "<p style='
        position: absolute;
        top: 35%;z-index:1;
        font-size: 15px;
        margin-left: 610px;color:red;'>
       Enter correct name,email or password!</p>"; 
     }
    }
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="login.css">

</head>
<body>

<div id="id01" class="modal">
  
  <form class="modal-content animate" method="post">
    <div class="imgcontainer">
      
      <img src="images/login_logo.png"  class="avatar">
    </div>

    <div class="container">
      <label for="firstname"><b>Firstname</b></label>
      <input type="text" placeholder="Enter Firstname" name="firstname" autocomplete="off" required>
      
      <label for="email"><b>Email Address</b></label>
      <input type="email" placeholder="Enter Email" name="email" autocomplete="off" required>  

      <label for="password"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" autocomplete="off" required>
        <div>
      <button type="submit" name="login">Login</button>
      <span class="psw"><a href="forgot.php">Forgot password?</a></span>
      </div>
    </div>
    

    <div class="bottom" style="background-color:#D0D0D0">
    <p class="line"><b>Not a member ?</b>
      <button type="button" name="signup" class="cancelbtn" ><a href="registration.php">Signup</a></button></p>
    </div>
  </form>
</div>

</body>
</html>
