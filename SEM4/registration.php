<?php
 
session_start();

require_once("config.php");
 
?>

<html>

    <head>
		<title>Registration</title>
			
		<script type="text/javascript">
			function preventBack(){window.history.forward();}
            setTimeout("preventBack()",0);
            window.onunload=function(){null};
		</script>

		<link rel="stylesheet" type="text/css" href="registration.css">

	</head>
	
<body>
 
	<div id="id01" class="modal">
		
	<!--
		<div class="imgcontainer">
		<img src="external.png"  class="avatar">
		</div>
	-->
	<div class="modal-content animate">

		<div class="heading">
			<h1>Registration</h1>
		</div>

		<div class="err_msg">
		
		<?php 
	
			if(isset($_POST['create']))
			{

				$db_host="localhost";
				$db_user="root";
				$db_pass="";
				$db_name="project_4";

				$con = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
		
				$firstname 		= $_POST['firstname'];
				$lastname 		= $_POST['lastname'];
				$emailid		= $_POST['email'];
				$password 		= $_POST['password'];
				$gender        =  $_POST['gender'];
				$one = "akankshaladdha5@gmail.com";

				$sql = " select * from registration where email='".$emailid."' limit 1";
				$result= mysqli_query($con,$sql);
				$row=mysqli_fetch_array($result);
				$count=mysqli_num_rows($result);

				if($row['email']==$emailid  && $count == 1)
				{
					echo 'The entered email-id is already registered with us. Please use a different email to create an account.';
				}
				
				else{

					$user_activation_code = rand(1000000,9999999);
					$activation = $user_activation_code;
					$sql = "INSERT INTO registration VALUES(?,?,?,?,?,?)";
					$stmtinsert = $db->prepare($sql);
					$result = $stmtinsert->execute([$firstname, $lastname, $emailid,  $password, $gender,$activation]);
					
					if($result)
					{
						if($one==$emailid)
						{ 
							$status="true";
							$sql = "INSERT INTO login(fname,loginemail,password,status)values(?,?,?,?)";
							$stmtinsert = $db->prepare($sql);
							$result = $stmtinsert->execute([$firstname, $one,  $password, $status]);
							if($result)
							{
								header('location:login.php');
							}
						}
						else{
						
						$subject="Email Verification link";
						$to=$emailid;
						$message =  " Welcome " . $firstname . " " .$lastname . " \n Please click on the following link to login.\n http://localhost/self/login1.php \n"  .$activation. "\n Enter this code to login.";
						$from= 'akankshaladdha0625@gmail.com';
						mail($to, $subject, $message, 'From: akankshaladdha0625@gmail.com');
						echo  "Verification code has been sent to ur registered email-id . Click on the link to log in to your account.";
						}
					}
					else{
						echo 'There were errors while saving the data in registration.';
					}
				}
			}
			?>

		</div>

		<form method="post" class="signup_btn">

		<div class="container">
			<div class="inputs">
				<label for="firstname" class="labels"><b>Firstname</b></label><br>
				<input class="select" type="text" placeholder="Enter Firstname" name="firstname" autocomplete="off" required>
				<br>
				<label for="lastname" class="labels"><b>Lastname</b></label><br>
				<input class="select" type="text" placeholder="Enter Lastname" name="lastname" autocomplete="off" required>
				<br>
				<label for="email" class="labels"><b>Email Address</b></label><br>
				<input class="select" type="email" placeholder="Enter Email" name="email" autocomplete="off" required>  
				<br>
				<label for="password" class="labels"><b>Password</b></label><br>
				<input class="select" type="password" placeholder="Enter Password" name="password" autocomplete="off" required>
				<br>
				<label class="labels"><b>Gender :</b>
					<input type="radio" name="gender" value="male">Male
					<input type="radio" name="gender" value="female">Female
					<input type="radio" name="gender" value="other">Other
				</label>
			</div>
			<div class="btn">
				<button class="btn-success" type="submit" id="register" name="create">Sign Up</button>
			</div>
		</div>
		</form>
    
    	<div class="bottom">
    		<p class="line"><b>Already a member ?</b>
     		<button type="button" name="signup" class="cancelbtn" ><a href="login.php">Signin</a></button></p>
    	</div>
	</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

</body>
</html>
