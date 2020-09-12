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


<?php

$db_host="localhost";
$db_user="root";
$db_pass="";
$db_name="project_4";

$con = mysqli_connect($db_host,$db_user,$db_pass,$db_name);


if(isset($_POST['revoke']))
{
    $email = $_SESSION['email'];
    $emailid_user = $_POST['emailid_user'];
    $username = $_POST['username'];
    $membership = $_POST['membership'];

    $sql = "select * from login where loginemail = '".$emailid_user."' AND fname = '".$username."' ";
    $result= mysqli_query($con,$sql);
    $row=mysqli_fetch_array($result);
    $count=mysqli_num_rows($result); 

    if($count==1)
    {
        $sql = "select * from premium where premium_email = '".$emailid_user."' and membership_no = '".$membership."' ";
        $result= mysqli_query($con,$sql);
        $row=mysqli_fetch_array($result);
        $count=mysqli_num_rows($result); 
        if($count==1)
        {
            $sql = "delete from premium where premium_email = '".$emailid_user."' ";
            $result= mysqli_query($con,$sql);
            if($result)
                {
                    $count = 0;
                    $str = 99999;
                   $sql = "UPDATE liked set downloaded = '".$count."' , premium_id ='".$str."'  where liked_email = '".$emailid_user."' ";
                   if(mysqli_query($con,$sql))
                   {
                    echo '<script>';
                    echo "alert('Membership Revoked')";
                    echo '</script>';                     
                  }
                }
        }
        else
        {
          echo '<script>';
          echo "alert('Not a premium member')";
          echo '</script>';         
        }
    }
    else
    {
      echo '<script>';
      echo "alert('Invalid Username')";
      echo '</script>'; 
    }
}

?>

<?php

if(isset($_POST['cancel']))
{
    header('location:revoke_membership.php');
}

?>


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

  <div class="content">

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

    <div class="main">
      
    <form method="POST" class="modal-content">
          
      <div class="container">
        <label><b>User Name </b><br>
        <input class="details" type="text" name="username"  placeholder="enter user name" required>
        </label>
        <br>
       
        <label><b>Email-id</b><br>
          <input class="details" type="email" name="emailid_user" placeholder="enter email_id" required>
        </label>
        <br>

        <label><b>Membership No</b><br>
            <input class="details" name="membership" type="text" placeholder="enter membership no" required>
        </label>
        <br>
        
      <br>
      
        <button type="submit" class="save"  name="revoke"  onClick="window.location.href=window.location.href">Revoke</button>
        <button type="submit" class="cancel" name="delete">Cancel</button>

      </div>

      </form>
    </div>
  </div>


</body>
</html>