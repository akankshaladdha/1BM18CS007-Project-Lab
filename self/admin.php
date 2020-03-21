<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <title>HOME</title>
  <link  href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  
  <!--
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  -->
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


  <!--    
  <link href="sidenav.css" rel="stylesheet">
  -->

  <link href="loggedin.css" rel="stylesheet">
  <link href="music-player.css" rel="stylesheet">
  <link href="alert.css" rel="stylesheet">
  <link href="admin.css" rel="stylesheet">

  <script type="text/javascript">
    function preventBack(){window.history.forward();}
      setTimeout("preventBack()",0);
      window.onunload=function(){null};
  </script>

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
    function myFunction(x) {
      x.classList.toggle("new");
      if(x.classList=="old")
        x.title="Add to liked songs";
      if(x.classList=="new")
        x.title="Added to liked songs";
    }
    </script>
    
   
</head>

<body>

  <?php
  if(!isset($_SESSION['firstname']))
  {
    header('location: regorlogin.php');
  }
  ?>

  <div class="header">
    
    <div class="logo">
      <img src="menu.png" width="60px" height="70px">
    </div>

    <div class="search-box">
      <input class="search-text" type="text" placeholder="SEARCH">
      <a class="search-btn" href="#">
      <i id="search" class="ion-search"></i></a>
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
        $db_name="self";
              
        $con = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
        $emailid=$_SESSION['email'];
        $sql = " select * from login where email='".$emailid."' limit 1";
        $result= mysqli_query($con,$sql);
        $row=mysqli_fetch_array($result);
        $count=mysqli_num_rows($result);

      ?>
              
      <label><b>Firstname : </b>&nbsp;<?php echo " "; echo $row['firstname']; ?></label><br>
      <label><b>Lastname :</b>&nbsp;<?php echo " "; echo $row['lastname']; ?></label><br>
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

    <img src="bekhayali.jpg" width="70px" height="80px">

    <div><i onclick="myFunction(this)" class="fa fa-heart old" ></i>
      <p style="cursor: pointer" onclick="selectSong('bekhayali.mp3')">"bekhayali.mp3"</p><br>
      <button><i class="fa fa-arrow-circle-down"></i></button>
    </div>
     <div><i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs"></i>
          <p style="cursor: pointer" onclick="selectSong('ghungroo.mp3')">"ghungroo.mp3"</p></div>
     <div><i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs"></i>
          <p style="cursor: pointer" onclick="selectSong('yaad.mp3')">"yaad.mp3"</p></div>
     <div><i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs"></i>
          <p style="cursor: pointer" onclick="selectSong('kabira.mp3')">"kabira.mp3"</p></div>
     <div><i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs"></i>
          <p style="cursor: pointer" onclick="selectSong('paniyosa.mp3')">"paniyosa.mp3"</p></div>

    </div>
      
  </div>

  <div class="buttons">
    <button class="shuffle"><i class="ion-shuffle"></i></button>
    <button class="back" onclick="back()"><i class="ion-skip-backward"></i></button>
    <button class="playorpause" onclick="playorpausesong()"><i class="ion-play"></i></button>
    <button class="next" onclick="next()"><i class="ion-skip-forward"></i></button>
    <button class="loop" onclick="replay()"><i class="ion-refresh"></i></button>
  </div>
        
  <div class="footer">
    <div class="seek-bar">
      <div class="fill"></div>
      <div class="handle"></div>
    </div>  
    
    <div id="curtimetext" class="current-time">00:00</div>
    <div id="durtimetext" class="duration-time">00:00</div> 
  </div>
              
  <script src="music-player.js"></script>
  <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>

</body>
</html>