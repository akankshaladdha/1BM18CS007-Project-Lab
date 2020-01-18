<?php
if(isset($_POST['reset'])&& isset($_POST['email']))
{


    session_start();

 $db_host="localhost";
 $db_user="root";
 $db_pass="";
 $db_name="self";

 $con = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
 $emailid			= $_POST['email'];

 $sql = " select * from login where  email='".$emailid."'  limit 1";
     $result= mysqli_query($con,$sql);
     $row=mysqli_fetch_array($result);

     if($row['email']==$emailid )
     {
            $_SESSION['email']=$emailid;
    $subject="Password reset link";
    $to=$_POST['email'];
    $message =  " Welcome " . $_SESSION['firstname'] . "  \n Please click on following link to reset password .\n http://localhost/self/forgotpass.php";
    $from= 'nitesh.cs18@bmsce.ac.in';
    mail($to, $subject, $message, 'From: nitesh.cs18@bmsce.ac.in');
    header('location: forgot.html');
    }

    else
    {
        echo 'The email id entered is not registered . ';
    }
}

?>
<html>
    <head>
        <title>Password Reset</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    </head>
<body>
<form  method="POST">
		<div class="container">
		
			<div class="center-div">
				<h1>Password Reset </h1>
        <h5>Enter email id</p>
        <hr class="mb-3">
        <label for="email"><b>Email ID</b></label>
                    <input class="form-control"  type="email" name="email" placeholder="Enter ur email" required>
                    
                    <hr class="mb-3">
					<input class="btn btn-success" type="submit"  name="reset" value="Send Link">
			
</div>
		</div>

	</form>
	
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
        
</body>
</html>
