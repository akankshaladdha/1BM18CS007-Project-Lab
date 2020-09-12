<?php

session_start();

require_once("config.php");

?>
<?php
if(isset($_POST['delete']))
    {
    
        $db_host="localhost";
        $db_user="root";
        $db_pass="";
        $db_name="project_4";
              
        $con = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
        $song = $_POST['song_del'];
     
        $sql = "select * from category where song_name = '".$song."' ";
        $result= mysqli_query($con,$sql);
        $row=mysqli_fetch_array($result);

        if($result)
        {
            $artist = $row['artist_name'];
            $image = $row['song_image'];
            $email = $_SESSION['email'];
        }

            $sql="INSERT into admin(song_name,song_deleted,admin_email,artist_name,song_image)values(?,?,?,?,?)";
            $stmtinsert = $db->prepare($sql);
            $result = $stmtinsert->execute([ $song,"yes",$email,$artist,$image]);
            if($result)
            {
              
              /*echo '<style type="text/css">
              #$song{ 
                display: none;
              }
              </style>';*/
                $sql = "delete from category where song_name = '".$song."' ";
                $result= mysqli_query($con,$sql);
                if($result)
                {

                      $sql = "delete from liked where song_name = '".$song."' ";
                      $result= mysqli_query($con,$sql);
                      if($result)
                      {
                          echo '<script>';
                          echo "alert('Song deleted succesfully')";
                          echo '</script>'; 
                          
                      }
                }
            }
    }
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
<?php
          $db_host="localhost";
          $db_user="root";
          $db_pass="";
          $db_name="project_4";

          $con = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
          $email= $_SESSION['email'];

          $sql = "Select * from category";
          $result= mysqli_query($con,$sql);
          echo "<table border='4px solid white'>
          <tr>
          <th>Song Name</th>
          <th>Delete or Not</th>
          </tr>";

          while($row=mysqli_fetch_array($result))
          {?>
            <tr>
            <td><?php echo $row['song_name'];?></td>
            <td> <form method="post" action="#" class="form_del">
                    <input type="hidden" value="<?php echo $row['song_name']; ?>" name="song_del">
                    <button type="submit" name="delete" class="button_del" style=" border-radius: 5px;
    border: 1px solid black;
    padding :4px;
    text-align: center;
    width:80px;
    cursor: pointer;
    outline: none;
    box-shadow:inset 2px 2px 3px rgba(255,255,255,0.6),inset -2px -2px 3px rgba(0,0,0,0.6);     background-color:rgba(255,0,0,1);
   font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
 ">Delete</button>
                </form> 
            </td>
          </tr>
           <?php
          }
          echo "</table>";
 ?>
  </div>
  </div>

</body>
</html>