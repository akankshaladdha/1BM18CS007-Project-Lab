<?php

session_start();

require_once("config.php");

?>

<html>
<head>
  <link rel="stylesheet" href="editprofile.css">
  <link href="loggedin.css" rel="stylesheet">
  <link href="alert.css" rel="stylesheet">
  <link rel="stylesheet" href="changepass.css">

  <link  href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
  
  <!--
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  -->
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script type='text/javascript' src='//ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js'></script>

    <title>Change Password</title>



  <script>
    var confirmbox = document.getElementById('logout');
    window.onclick = function(event){
      if(event.target==confirmbox){
        confirmbox.style.display='none';
      }
    }    
  </script>
  
  <script>    
    var confirmbox = document.getElementById('info');
    window.onclick = function(event){
      if(event.target==confirmbox){
        confirmbox.style.display='none';
      } 
    }    
  </script>

<script>    
    var confirmbox = document.getElementById('member');
    window.onclick = function(event){
      if(event.target==confirmbox){
        confirmbox.style.display='none';
      } 
    }    
  </script>
</head>
<body>
<div>

    <?php

    $db_host="localhost";
    $db_user="root";
    $db_pass="";
    $db_name="project_4";
    
    $con = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
    $email= $_SESSION['email'];
    $sql = " select * from login where loginemail = '".$email."' limit 1";
    $result= mysqli_query($con,$sql);
    $row= mysqli_fetch_array($result);

    if(isset($_POST['save']))
    {
        $current= $_POST['cpass'];
        $new = $_POST['npass'];
        $confirmnew = $_POST['cnpass'];
        if($current==$row['password'] && $new==$confirmnew)
        {
            $sql = "UPDATE login SET password = '".$new."' WHERE loginemail= '". $email."' "; 
            if(!mysqli_query($con,$sql))
            {
                echo '<script>';
                echo "alert('Error updating password')";
                echo '</script>';
            }
           
            if(mysqli_query($con,$sql) == true)
            {
                $subject="Security Alert !!";
                $to=$email;
                $message =  " Hello " . $_SESSION['firstname'] . " " .$_SESSION['lastname'] . " \n Your password was recently changed. You are getting this email to make sure it is you. Kindlyb use your new password to login to your account.\n";
                $from= 'akankshaladdha0625@gmail.com';
                mail($to, $subject, $message, 'From: akankshaladdha0625@gmail.com');
                
                echo '<script>';
                echo "alert('Password changed successfully')";
                echo '</script>';   
            }

            $sql = "UPDATE registration SET password = '".$new."' WHERE email= '". $email."' "; 
            if(!mysqli_query($con,$sql))
            {
              echo '<script>';
              echo "alert('Error updating password')";
              echo '</script>';             
            }

        }
        else
        {
          echo '<script>';
          echo "alert('Enter the correct password')";
          echo '</script>';    
        }
    }
    
    ?>
   
            

   <div class="header">
    
    <div class="logo">
      <img src="menu.png" width="60px" height="70px">
    </div>

    <div class="premium">
    <button style='font-size:24px; outline:none;cursor:pointer; padding:10px; color:#d8d8d8;font-weight:bold;background:#282828; border:none;'><i class='fas fa-crown'></i>Premium</button>
  </div>


    <div class="profile">
      <div>
        <button class="profile_icon" disabled><i class="ion-person"></i></button> 
      </div>

      <div class="username">
        <form method="POST">
          <input type="button" name="user" class="btn1" onclick="document.getElementById('info').style.display='block'" value="<?php echo $_SESSION['firstname']; ?>">
        </form>  
      </div>  

    </div>

  </div>

  <div id="member">
    <div class="prem_message" style="color:black"><b>Do you wish to join premium membership?</b></div> 
      <button class="yes"><a href="#" style="text-decoration:none">Yes</a></button>
      <button id="no" class="no" onclick="document.getElementById('member').style.display='none'">Cancel</button>
    </div>
  </div>

  <div id="logout">
    <div class="message" style="color:black"><b>Are you sure you want to logout?</b></div>    
      <button class="yes"><a href="regorlogin.php" style="text-decoration:none">Logout</a></button>
      <button id="no1" class="no" onclick="document.getElementById('logout').style.display='none'">Cancel</button>
    </div>
  </div>

  <div id="info">
    <div class="message" style="color:black"><b>User Info</b></div>
      <hr class="mb-3">
      
      <div class="info-contents">

      <?php
        
        $db_host="localhost";
        $db_user="root";
        $db_pass="";
        $db_name="project_4";
              
        $con = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
        $emailid=$_SESSION['email'];
        $sql = " select * from registration where email='".$emailid."' limit 1";
        $result= mysqli_query($con,$sql);
        $row=mysqli_fetch_array($result);
        $count=mysqli_num_rows($result);

      ?>
              


<label><b>Firstname : </b>&nbsp;<?php echo " "; echo $_SESSION['firstname']; ?></label><br>
      <label><b>Lastname :</b>&nbsp;<?php echo " "; echo $_SESSION['lastname']; ?></label><br>
      <label><b>Email-id &nbsp;&nbsp;: </b>&nbsp;<?php echo " "; echo $row['email']; ?></label>
      
      </div>      
      <button id="no1" class="no" onclick="document.getElementById('info').style.display='none'">Ok</button>
    </div>
  </div>

  <div class="content">

    <div class="sidenav">
      <div class="side_style"><a href="admin.php">Home</a></div><br>
      <div class="side_style" onclick="liked_visit()"><a href="#services">Liked Songs</a></div><br>
      <div class="side_style" onclick="liked_visit()"><a href="#clients">Trending</a></div><br>
      <div class="side_style"><a href="editprofile.php">Edit Profile</a></div><br>
      <div class="side_style"><a href="changepassword.php">Change Password</a></div><br>
      <div class="side_style"><a href="regorlogin.php">About Us</a></div><br>
      <div class="side_style"><input type="button" class="log" value="Logout" onclick="document.getElementById('logout').style.display = 'block'"></div>
    </div>
    <script>
      function liked_visit(){
      alert('Visit home page');
      }
  </script>
<div class="main">
      
      <form method="POST" class="modal-content">
          
        <div class="container">
            <label><b>Current Password  </b><br>
            <input type="password" name="cpass" class="details" placeholder="enter current password" autocomplete="off" required>
            </label>
            <br>
            <label><b>New Password  </b><br>
            <input type="password" name="npass" class="details" placeholder="enter new password" autocomplete="off" required>
            </label>
            <br>
            <label><b>Confirm New Password  </b><br>
            <input type="password" name="cnpass" class="details" placeholder="confirm new password" autocomplete="off" required>
            </label>
            <br>
        </div>

        <div class="bottom">
            <button type="submit" class="save" name="save" >Save</button>
            <button type="reset" name="cancel" class="cancel"><a href="admin.php">Go back</a></button>
        </div>

        </form>
    </div>

</body>
</html>
