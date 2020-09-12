<?php

session_start();

if(isset($_POST['reset']) && isset($_POST['email']))
{

 $db_host="localhost";
 $db_user="root";
 $db_pass="";
 $db_name="project_4";

 $con = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
 $emailid = $_POST['email'];

 $sql = " select * from login where loginemail='".$emailid."'  limit 1";
     $result= mysqli_query($con,$sql);
     $row=mysqli_fetch_array($result);

     if($row['loginemail']==$emailid )
     {
        $_SESSION['email']=$emailid;
        $subject="Password reset link";
        $to=$_POST['email'];
        $message =  " Welcome " . $_SESSION['firstname'] . "  \n Please click on following link to reset password .\n http://localhost/self/forgotpass.php";
        $from= 'akankshaladdha0625@gmail.com';
        mail($to, $subject, $message, 'From: akankshaladdha0625@gmail.com');
        header('location: forgot.html');
    }

    else
    {
        echo 'The email entered is not registered . ';
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
