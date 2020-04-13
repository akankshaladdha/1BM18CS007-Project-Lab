<?php

session_start();

require_once("config.php");

?>

<html>
<head>
  <link rel="stylesheet" href="editprofile.css">
  <link href="loggedin.css" rel="stylesheet">
  <link href="alert.css" rel="stylesheet">
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

    <title>Edit Profile</title>



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

  <?php
    
    $db_host="localhost";
    $db_user="root";
    $db_pass="";
    $db_name="self";
    
    $con = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
    $email= $_SESSION['email'];
    $sql="select * from login where loginemail='".$email."' limit 1";
    $result= mysqli_query($con,$sql);
    $row=mysqli_fetch_array($result);
    
    if(isset($_POST['save']))
    { 
        $fname1 = $_POST['fname'];
        $lname1 = $_POST['lname'];
        $phone1 = $_POST['phone'];
        $dob1 = $_POST['dob'];
       
        $sql = "UPDATE registration SET lastname = '".$lname1."',firstname = '".$fname1."'  WHERE email= '".$email."' ";
        if(mysqli_query($con,$sql) == true)
        {
          $_SESSION['lastname']=$lname1;
         
        
        }

        $sql = "UPDATE login SET fname = '".$fname1."',phonenumber='".$phone1."' WHERE loginemail= '".$email."' ";
        if(mysqli_query($con,$sql) == true)
        {
            $_SESSION['firstname']=$fname1;
            $_SESSION['phonenumber']=$phone1;
            $_SESSION['datebirth']=$dob1;
            header('location:editprofile.php'); 
        }

        
        
           

           
    }
  
  ?>
   
   <div class="header">
    
    <div class="logo">
      <img src="menu.png" width="60px" height="70px">
    </div>

    <div class="premium">
    <button style='font-size:22px' onclick="document.getElementById('member').style.display='block'" ><i class='fas fa-crown'></i>Premium</button>
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
        $db_name="self";
              
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
      <div><a href="#about">Home</a></div><br>
      <div><a href="#services">Liked Songs</a></div><br>
      <div><a href="#clients">Trending</a></div><br>
      <div><a href="editprofile.php">Edit Profile</a></div><br>
      <div><a href="changepassword.php">Change Password</a></div><br>
      <div><a href="#about">About Us</a></div><br>
      <div><input type="button" class="log" value="Logout" onclick="document.getElementById('logout').style.display = 'block'"></div>
    </div>

    <div class="main">
      
      <form method="POST" class="modal-content">
          
      <div class="container">
        <label><b>Firstname  </b><br>
        <input class="details" type="text" name="fname" value="<?php echo $_SESSION['firstname']; ?>" placeholder="enter a new firstname" required>
        </label>
        <br>
        <label><b>Lastname  </b><br>
        <input class="details" type="text" name="lname" value="<?php echo $_SESSION['lastname']; ?>" placeholder="enter a new lastname" required>
        </label>  
        <br>

        <label><b>Phone  </b><br>
          <input class="details" id="intTextBox" maxlength="10" name="phone" value="<?php if($_SESSION['phonenumber']){echo $_SESSION['phonenumber'];} ?>">
            <script>
            function setInputFilter(textbox, inputFilter) {
              ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
                textbox.addEventListener(event, function() {
                  if (inputFilter(this.value)) {
                    this.oldValue = this.value;
                    this.oldSelectionStart = this.selectionStart;
                    this.oldSelectionEnd = this.selectionEnd;
                  } else if (this.hasOwnProperty("oldValue")) {
                    this.value = this.oldValue;
                    this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                  } else {
                    this.value = "";
                  }
                });
              });
            }

              setInputFilter(document.getElementById("intTextBox"), function(value) {
              return /^-?\d*$/.test(value); });
            </script>
        </label>
        <br>

        <label><b>Date of birth  </b><br>
            <input class="details" name="dob" type="date" value="<?php echo $_SESSION['datebirth']; ?>" >
        </label>
        <br>
        
        <button type="submit" class="save"  name="save"  onClick="window.location.href=window.location.href">Save</button>
        <button type="reset" class="cancel" name="cancel">Cancel</button>

      </div>
<!--
<div class="bottom" style="background-color:#D0D0D0">
<p class="line"><a href="admin.php">Go back to listening music</a></p>
    </div>
-->
      </form>
    </div>
  </div>

</body>
</html>