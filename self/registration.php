<?php
 
 require_once("config.php");
 
?>

<html>
    <head>
		<title>Login Page</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<script type="text/javascript">
          function preventBack(){window.history.forward();}
            setTimeout("preventBack()",0);
            window.onunload=function(){null};
          </script>
    </head>
<body>
	
	<div>
	<?php 

	
	if(isset($_POST['create']))
{


	session_start();

 $db_host="localhost";
 $db_user="root";
 $db_pass="";
 $db_name="self";

 $con = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
 
	$firstname 		= $_POST["firstname"];
	$lastname 		= $_POST['lastname'];
	$emailid			= $_POST['email'];
	$password 		= $_POST['password'];
	$gender1        =  $_POST['gender'];

	$sql = " select * from login where  email='".$emailid."'  limit 1";
     $result= mysqli_query($con,$sql);
     $row=mysqli_fetch_array($result);
     $count=mysqli_num_rows($result);

     if($row['email']==$emailid  && $count == 1)
     {
		 echo 'The entered email id already exists. Use other email id to register';
	 }
	 else{

		$user_activation_code = rand(100000,9999999);
		$activation = $user_activation_code;
		$sql = "INSERT INTO login (firstname, lastname, email, password ,code, gender) VALUES(?,?,?,?,?,?)";
		$stmtinsert = $db->prepare($sql);
		$result = $stmtinsert->execute([$firstname, $lastname, $emailid,  $password, $activation , $gender1]);
		if($result)
		{
			
			$subject="Email Verification link";
			$to=$_POST['email'];
			$message =  " Welcome " . $firstname . " " .$lastname . " \n Please click on following link to login.\n http://localhost/self/login1.php \n"  .$activation. "\n Enter this code to login.";
			$from= 'nitesh.cs18@bmsce.ac.in';
			mail($to, $subject, $message, 'From: nitesh.cs18@bmsce.ac.in');
			echo 'Verification code has been sent to ur registered email-id . Click on the link to log in to your account';
		}
		else{
			echo 'There were erros while saving the data.';
			header('location: registration.php');
		}
	 }
}
	?>
	</div>
    <form  method="POST">
		<div class="container">
		<div class="row">
			<div class="col-sm-3">
				<h1>Registration</h1>
        <p>Fill out the form</p>
        <hr class="mb-3">
        <label for="firstname"><b>First Name</b></label>
					<input class="form-control"  type="text" name="firstname" required>

					<label for="lastname"><b>Last Name</b></label>
					<input class="form-control"   type="text" name="lastname" required>

					<label for="email"><b>Email Address</b></label>
					<input class="form-control"   type="email" name="email" required>

					<label for="password"><b>Password</b></label>
					<input class="form-control"   type="password" name="password" required>

					<label><b>Gender :</b>
							<input type="radio" name="gender" value="male">Male
							<input type="radio" name="gender" value="female">Female
							<input type="radio" name="gender" value="other">Other
					</label>

					<hr class="mb-3">
					<input class="btn btn-success" type="submit" id="register" name="create" value="Sign Up">
			</div>
			</div>
		</div>

	</form>
	
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

</body>
</html>