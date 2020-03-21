
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
    $code = $_POST['code'];

     $sql = " select * from login where  firstname = '".$first."' && email='".$emailid."' && password='".$pass."' && code='".$code."'limit 1";
     $result= mysqli_query($con,$sql);
     $row=mysqli_fetch_array($result);
     $count=mysqli_num_rows($result);

     if($row['firstname']==$first && $row['email']==$emailid && $row['password']==$pass && $row['code']==$code && $count == 1)
     {
         $_SESSION['firstname']=$first;
         $_SESSION['lastname']=$row['lastname'];
         $_SESSION['email']=$emailid;
         $sql = "UPDATE login SET status= true WHERE firstname='".$first."'";
         if(mysqli_query($con,$sql) == true){

         header('location: admin.php');
         }
     }
     else
     {
        echo "<p style='
        position: absolute;
        top: 35%;z-index:1;
        font-size: 15px;
        margin-left: 549px;color:red;'>
      Login failed! Enter correct name ,email,password or code!</p>"; 
     }
 }
 
?>
<html>
<head>
<title>LOGIN PAGE </title>
<link rel="stylesheet" href="login1.css">
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

      <label for="code"><b>Verification Code</b></label>
					<input placeholder="Enter code"   type="text" name="code" required>
        <div>
      <button type="submit" name="login">Login</button>
      <span class="psw"><a href="forgot.php">Forgot password?</a></span>
      </div>
    </div>
  </form>
</div>
</body>

</html>
