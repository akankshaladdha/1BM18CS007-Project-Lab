<?php

session_start();

require_once("config.php");

?>

<?php

if(isset($_POST['admin']))
{
    header('location:options.php');
}

?>
<html>
<head>
  <link rel="stylesheet" href="editprofile.css">
  <link href="loggedin.css" rel="stylesheet">
  <link href="alert.css" rel="stylesheet">
  <link href="display_details.css" rel="stylesheet">


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


</head>
<body>

  


   
   <div class="header">
    
    <div class="logo">
      <img src="menu.png" width="60px" height="70px">
    </div>


    <div class="premium" id="premium">
      <form method="POST">
      <button style='font-size:24px; outline:none;cursor:pointer; padding:10px; color:#d8d8d8;font-weight:bold;background:#282828; border:none;' name ="admin">Admin</button>
      </form>
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

  <div class="content_2">

    <div class="sidenav_2">
      <div class="side_style"><a href="main.php">Home</a></div><br>
      <div class="side_style"><a href="liked_songs.php">Display Liked Songs</a></div><br>
      <div class="side_style"><a href="downloaded_songs.php">Display downloaded songs</a></div><br>
      <div class="side_style"><a href="display_details.php">Display details</a></div><br>
      <div class="side_style"><a href="revoke_membership.php">Revoke membership</a></div><br>
      <div class="side_style"><a href="delete_songs.php">Delete Song</a></div><br>
      <div class="side_style"><a href="#about">About Us</a></div><br>
      <div class="side_style"><input type="button" class="log" value="Logout" onclick="document.getElementById('logout').style.display = 'block'"></div>
    </div>

    <div class="main_2">
      <h1>Registered Users</h1><br>
      <?php

      
        $db_host="localhost";
        $db_user="root";
        $db_pass="";
        $db_name="project_4";
        
        $con = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
        $email= $_SESSION['email'];
   
        $sql = "Select * from registration";
        $result= mysqli_query($con,$sql);
        echo "<table border='4px solid white'>
        <tr>
        <th>First name</th>
        <th>Last name</th>
        <th>Email-id</th>
        <th>Verification Code</th>
        </tr>";

        while($row=mysqli_fetch_array($result))
        {
          echo "<tr>";
          echo "<td>".$row['firstname']."</td>";
          echo "<td>".$row['lastname']."</td>";
          echo "<td>".$row['email']."</td>";
          echo "<td>".$row['code']."</td>";
          echo "</tr>";

        }
        echo "</table>";
      ?>
      <h1>Logged-in Users</h1><br>
      <?php

          $db_host="localhost";
          $db_user="root";
          $db_pass="";
          $db_name="project_4";

          $con = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
          $email= $_SESSION['email'];

          $sql = "Select * from login";
          $result= mysqli_query($con,$sql);
          echo "<table border='4px solid white'>
          <tr>
          <th>First name</th>
          <th>Email-id</th>
          <th>Phone Number</th>
          <th>Date of Birth</th>
          </tr>";

          while($row=mysqli_fetch_array($result))
          {
            echo "<tr>";
            echo "<td>".$row['fname']."</td>";
            echo "<td>".$row['loginemail']."</td>";
            echo "<td>".$row['phonenumber']."</td>";
            echo "<td>".$row['datebirth']."</td>";
            echo "</tr>";
  
          }
          echo "</table>";

      ?>
      <h1>Premium Users</h1><br>
      <?php
          $db_host="localhost";
          $db_user="root";
          $db_pass="";
          $db_name="project_4";

          $con = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
          $email= $_SESSION['email'];

          $sql = "Select * from premium";
          $result= mysqli_query($con,$sql);
          echo "<table border='4px solid white'>
          <tr>
          <th>Membership-no</th>
          <th>Email-id</th>
          <th>Starting Date</th>
          <th>Expire Date</th>
          </tr>";

          while($row=mysqli_fetch_array($result))
          {
            echo "<tr>";
            echo "<td>".$row['membership_no']."</td>";
            echo "<td>".$row['premium_email']."</td>";
            echo "<td>".$row['start_date']."</td>";
            echo "<td>".$row['expiry_date']."</td>";
            echo "</tr>";

          }
          echo "</table>";
      ?>
    </div>
  </div>

</body>
</html>