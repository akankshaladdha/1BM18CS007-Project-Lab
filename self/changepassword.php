<?php
require_once("config.php");
session_start();

?>

<html>
<head>
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
    $first= $_SESSION['firstname'];
    $sql = " select * from login where firstname = '".$first."' limit 1";
    $result= mysqli_query($con,$sql);
    $row= mysqli_fetch_array($result);
   

    if(isset($_POST['change']))
    {
        $current= $_POST['cpass'];
        $new = $_POST['npass'];
        if($current==$row['password'])
        {
            $sql = "UPDATE login SET password = '".$new."'  WHERE firstname= '". $first."' "; 
            if(mysqli_query($con,$sql) == true){
            header('location: login.php');}
        }
        else
        {
            echo 'Enter the correct password.';
        }
    }
    
    ?>
    <div class="password">
    <form method="POST">
    <label><b>Current Password : </b>
     <input type="password" name="cpass"  placeholder="enter current password" required>
    </label>
    <label><b>New Password : </b>
     <input type="password" name="npass"  placeholder="enter new password" required>
    </label>
    <button type="submit" name="change">Change Password</button>

    </form>
    </div>

    </div>
    </body>
    </html>