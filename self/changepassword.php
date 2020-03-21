<?php
require_once("config.php");
session_start();

?>

<html>
<head>
<link href="changepass.css" rel="stylesheet">

    <title>Change Password</title>
</head>

<body>
<div>

    <?php

    $db_host="localhost";
    $db_user="root";
    $db_pass="";
    $db_name="self";
    
    $con = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
    $first= $_SESSION['email'];
    $sql = " select * from login where email = '".$first."' limit 1";
    $result= mysqli_query($con,$sql);
    $row= mysqli_fetch_array($result);
   

    if(isset($_POST['save']))
    {
        $current= $_POST['cpass'];
        $new = $_POST['npass'];
        $confirmnew = $_POST['cnpass'];
        if($current==$row['password'] && $new==$confirmnew)
        {
            $sql = "UPDATE login SET password = '".$new."'  WHERE email= '". $first."' "; 
            if(mysqli_query($con,$sql) == true){
                $subject="Security Alert !!";
                $to=$first;
                $message =  " Hello " . $_SESSION['firstname'] . " " .$_SESSION['lastname'] . " \n Your password was recently changed. You are getting this email to make sure it is you. Kindlyb use your new password to login to your account.\n";
                $from= 'nitesh.cs18@bmsce.ac.in';
                mail($to, $subject, $message, 'From: nitesh.cs18@bmsce.ac.in');
                
            echo "Password changed successfully";}
        }
        else
        {
            echo 'Enter the correct password.';
        }
    }
    
    ?>
    <div class="top">
        <h1>Title </h1>
</div>
    <div class="modal">
    <div class="header">
    <p class="line">Change password</p>
    </div>
</p>
        <form method="POST" class="modal-content">
       
<div class="container">
            <label><b>Current Password  </b>
            <input type="password" name="cpass"  placeholder="enter current password" required>
            </label>
            <br>
            <label><b>New Password  </b>
            <input type="password" name="npass"  placeholder="enter new password" required>
            </label>
            <br>
            <label><b>Confirm New Password  </b>
            <input type="password" name="cnpass"  placeholder="confirm new password" required>
            </label>
            <br>
            

</div>
<div class="bottom" style="background-color:#D0D0D0">
<button type="submit"  name="save" >Save</button>
<button type="reset" name="cancel" class="reset"><a href="admin.php">Go back</a></button>
            </div>

        </form>
    </div>

</div>
</body>
</html>