<?php
if(isset($_POST['reset']))
{
    $newpassword=$_POST['pass'];
    $confirmp=$_POST['cpass'];
    if($newpassword==$confirmp)
    {
        session_start();
        require_once("config.php");

        $db_host="localhost";
        $db_user="root";
        $db_pass="";
        $db_name="project_4";

        $con = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
        $emailid = $_SESSION['email'];
        $firstname = $_SESSION['firstname'];
        $sql = "UPDATE login SET password = '".$newpassword."' WHERE loginemail= '". $emailid."' "; 
        if(!mysqli_query($con,$sql))
        {
            echo "error updating password";
        }
        $sql = "UPDATE registration  SET password = '".$newpassword."' WHERE email= '". $emailid."' "; 
        if(!mysqli_query($con,$sql))
        {
            echo "error updating password";
        }
        if(!mysqli_query($con,$sql))
        {
            echo "error updating password";
        }
        if(mysqli_query($con,$sql) == true)
        {
            header('location: resetsuccess.html');
        }
       
        
    }
    else
    {
        echo 'The passwords do not match.';
    }
}
?>
<html>
    <head>
        <title>Reset The Password</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    </head>
<body>
<form  method="POST">
        <div class="container">
        
            <div class="center-div">
                <h1>Reset Your Password </h1>
       
        
        <label for="password"><b>New Password</b></label>
                    <input class="form-control"  type="password" name="pass" placeholder="Enter new Password" required>
                    
        <label for="cpassword"><b>Confirm Password</b></label>
                    <input class="form-control"  type="password" name="cpass" placeholder="Confirm Password" required>
                    
                    <hr class="mb-3">
                    <input class="btn btn-success" type="submit"  name="reset" value="RESET">
            
</div>
        </div>

    </form>
    
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
        
</body>
</html>
