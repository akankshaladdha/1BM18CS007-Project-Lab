<?php
 
 require_once("config.php");

 session_start();

 $db_host="localhost";
 $db_user="root";
 $db_pass="";
 $db_name="self";

 $con = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
 if(isset($_POST['login']))
 {
     $first = $_POST['firstname'];
     $emailid = $_POST['email'];
     $pass = $_POST['password'];
     
     $sql = " select * from login where  firstname = '".$first."' && email='".$emailid."' && password='".$pass."' limit 1";
     $result= mysqli_query($con,$sql);
     $row=mysqli_fetch_array($result);
     $count=mysqli_num_rows($result);

     if($row['firstname']==$first && $row['email']==$emailid && $row['password']==$pass && $count == 1)
     {
         $_SESSION['firstname']=$first;
         $_SESSION['lastname']=$row['lastname'];
         $_SESSION['email']=$emailid;
         header('location: admin.php');
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
      
      <img src="external.png"  class="avatar">
    </div>

    <div class="container">
      <label for="firstname"><b>Firstname</b></label>
      <input type="text" placeholder="Enter Firstname" name="firstname" required>
      
      <label for="email"><b>Email Address</b></label>
      <input type="email" placeholder="Enter Email" name="email" required>  

      <label for="password"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>
        <div>
      <button type="submit" name="login">Login</button>
      <span class="psw"><a href="forgot.php">Forgot password?</a></span>
      </div>
    </div>
    

    <div class="bottom" style="background-color:#D0D0D0">
    <p class="line"><b>Not a member ?</b>
      <button type="button" name="signup" class="cancelbtn" ><a href="regorlogin.php">Signup</a></button></p>
    </div>
  </form>
</div>

</body>
</html>