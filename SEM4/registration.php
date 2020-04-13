
<?php
 
session_start();

require_once("config.php");
 
?>

<html>
    <head>
		<title>Login Page</title>
		<script type="text/javascript">
          function preventBack(){window.history.forward();}
            setTimeout("preventBack()",0);
            window.onunload=function(){null};
		  </script>
		  		  <link rel="stylesheet" type="text/css" href="registration.css">

    </head>
<body>
	
	<div>
	<?php 

	
	if(isset($_POST['create']))
    {

        $db_host="localhost";
        $db_user="root";
        $db_pass="";
        $db_name="self";

        $con = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
 
	$firstname 		= $_POST['firstname'];
	$lastname 		= $_POST['lastname'];
	$emailid		= $_POST['email'];
	$password 		= $_POST['password'];
	$gender        =  $_POST['gender'];

	$sql = " select * from registration where email='".$emailid."' limit 1";
     $result= mysqli_query($con,$sql);
     $row=mysqli_fetch_array($result);
     $count=mysqli_num_rows($result);

     if($row['email']==$emailid  && $count == 1)
     {
		 echo 'The entered email id already exists. Use other email id to register';
     }
     
	   else{

		$user_activation_code = rand(1000000,9999999);
		$activation = $user_activation_code;
		$sql = "INSERT INTO registration VALUES(?,?,?,?,?,?)";
		$stmtinsert = $db->prepare($sql);
		$result = $stmtinsert->execute([$firstname, $lastname, $emailid,  $password, $gender,$activation]);
    if($result)
		{
			$subject="Email Verification link";
			$to=$emailid;
			$message =  " Welcome " . $firstname . " " .$lastname . " \n Please click on the following link to login.\n http://localhost/self/login1.php \n"  .$activation. "\n Enter this code to login.";
			$from= 'nitesh.cs18@bmsce.ac.in';
			mail($to, $subject, $message, 'From: nitesh.cs18@bmsce.ac.in');
			echo  "<p style='
			position: absolute;
			top: 75%;z-index:1;
			font-size: 15px;
			margin-left: 510px;color:red;'>Verification code has been sent to ur registered email-id . Click on the link to log in to your account</p>";
		}
		else{
			echo 'There were errors while saving the data in registration.';
        }
	 }
}
	?>
  </div>
  
 
	<div id="id01" class="modal">
  
  <form class="modal-content animate" method="post">
   <!--
 	 <div class="imgcontainer">
      
      <img src="external.png"  class="avatar">
    </div>
  -->
  <div class="head">
    <h1>Registration</h1>
  </div>

    <div class="container">
      <label for="firstname"><b>Firstname</b></label>
	  <input class="select" type="text" placeholder="Enter Firstname" name="firstname" autocomplete=off required>
	  
	  <label for="lastname"><b>Lastname</b></label>
      <input class="select" type="text" placeholder="Enter Lastname" name="lastname" autocomplete=off required>
      
      <label for="email"><b>Email Address</b></label>
      <input class="select" type="email" placeholder="Enter Email" name="email" autocomplete=off required>  

      <label for="password"><b>Password</b></label>
	  <input class="select" type="password" placeholder="Enter Password" name="password" autocomplete=off required>
	  
	  <label><b>Gender :</b>
			<input type="radio" name="gender" value="male">Male
			<input type="radio" name="gender" value="female">Female
			<input type="radio" name="gender" value="other">Other
	  </label>
	  
        <div class="btn">
		<button class="btn-success" type="submit" id="register" name="create">Sign Up</button>
      </div>
    </div>
    
    <div class="bottom" style="background-color:#D0D0D0">
    <p class="line"><b>Already a member ?</b>
      <button type="button" name="signup" class="cancelbtn" ><a href="login.php">Signin</a></button></p>
    </div>
  </form>
</div>


		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

</body>
</html>
