<?php

session_start();


?>

<!DOCTYPE html>
<html>
<head>
    <title>HOME</title>
    <link  href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link href="music-player.css" rel="stylesheet">
        <link href="loggedin.css" rel="stylesheet">
        <link href="sidenav.css" rel="stylesheet">
        <link href="alert.css" rel="stylesheet">
        <script type="text/javascript">
          function preventBack(){window.history.forward();}
            setTimeout("preventBack()",0);
            window.onunload=function(){null};
          </script>

          <script>
             var confirmbox = document.getElementById('confirm');
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

<div>
    <?php

   
    if(!isset($_SESSION['firstname']))
    {
      header('location: regorlogin.php');
    }
    ?>

   
    <form method="POST">
     
      <div class="dropdown">
            <input type="button" class="btn1"  name="user"   onclick="document.getElementById('info').style.display='block'" value="<?php echo $_SESSION['firstname']; ?>">

      </div>
                <img src="menu.png"  class="menu">
    
    
    </form>      
    <button class="profile" disabled><i class="ion-person"></i></button> 
    
    <div class="sidenav">
            <a href="#about">About</a>
            <a href="#services">Services</a>
            <a href="#clients">Clients</a>
            <a href="editprofile.php">Edit Profile</a>
            <a href="changepassword.php">Change Password</a>
            <input type="button" class="log" value="Log out" onclick="document.getElementById('confirm').style.display = 'block'">
    </div>

            <div id="confirm">
              <div class="message" style="color:black"><b>Are you sure you want to logout?</b></div>    
              <button class="yes"><a href="regorlogin.php" style="text-decoration:none">Logout</a></button>
              <button id="no1" class="no" onclick="document.getElementById('confirm').style.display='none'">Cancel</button>
              </div>
            </div>
        
                      <div class="search-box">
                            <input class="search-text" type="text" placeholder="SEARCH">
                            <a class="search-btn" href="#">
                            <i id="search" class="ion-search"></i></a>
                      </div>
                      


                      <div id="info">
              <div class="message" style="color:black"><b>User Info</b></div>
              <hr class="mb-3">
              <div class="info-contents">
              <label><b>Firstname : </b>&nbsp;<?php echo " "; echo $_SESSION['firstname']; ?></label><br>
              <label><b>Lastname :</b>&nbsp;<?php echo " "; echo $_SESSION['lastname']; ?></label><br>
              <label><b>Email-id &nbsp;&nbsp;: </b>&nbsp;<?php echo " "; echo $_SESSION['email']; ?></label>
              </div>
              <button id="no1" class="no" onclick="document.getElementById('info').style.display='none'">Ok</button>
              </div>
            </div>
    <footer class="footer-bottom">
      </footer>
    <div class="audio-player" id="audioPlayer">
    <button class="next" onclick="next()"><i class="ion-skip-forward"></i></button>
                  <button class="loop" onclick="replay()"><i class="ion-refresh"></i></button>
                    <button class="back" onclick="back()"><i class="ion-skip-backward"></i></button>
                    <button class="shuffle"><i class="ion-shuffle"></i></button>
                      <button class="playorpause" onclick="playorpausesong()"><i class="ion-play"></i></button>
            <div class="seek-bar">
            
                <div class="fill"></div>
                <div class="handle"></div>
            </div>
            
              <div id="curtimetext" class="current-time">00:00</div>
              <div id="durtimetext" class="duration-time">00:00</div>     
      </div>
      
      <script src="music-player.js"></script>

    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>

</div>

</body>
</html>