

<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <title>HOME</title>
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

  <!--    
  <link href="sidenav.css" rel="stylesheet">
  -->

  <link href="loggedin.css" rel="stylesheet">
  <link href="alert.css" rel="stylesheet">
  <link href="admin.css" rel="stylesheet">
  <link href="music-player.css" rel="stylesheet">


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
    var confirmbox = document.getElementById('member');
    window.onclick = function(event){
      if(event.target==confirmbox){
        confirmbox.style.display='none';
      } 
    }    
  </script>

 <script>
      function myFunction(x) {
        x.classList.toggle("new");
        if(x.title=="Add to liked songs")
          x.title="Song added to liked songs";
        else
          x.title="Add to liked songs";
      }
    </script>
    
    <script>
      function changeDisplay(albumId){
        
        var album = document.getElementById(albumId);
        var section = document.getElementById('sections');
        section.style.display='none';
        album.style.display='flex';
      }
      </script>

      <script>
        function goBack(albumId){
          
        var album = document.getElementById(albumId);
        var section = document.getElementById('sections');
        section.style.display='block';
        album.style.display='none';
        }
      </script>
   
</head>

<body>

  
  <div class="header">
    
    <div class="logo">
      <img src="menu.png" width="60px" height="70px">
    </div>

    <div class="search-box">
      <input class="search-text" type="text" placeholder="SEARCH">
      <a class="search-btn" href="#">
      <i id="search" class="ion-search"></i></a>
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

  <div id="logout">
    <div class="message" style="color:black"><b>Are you sure you want to logout?</b></div>    
      <button class="yes"><a href="regorlogin.php" style="text-decoration:none">Logout</a></button>
      <button id="no1" class="no" onclick="document.getElementById('logout').style.display='none'">Cancel</button>
    </div>
  </div>


  <div id="member">
    <div class="message" style="color:black"><b>Do you wish to join premium membership?</b></div>    
      <button class="yes" name="yes">Yes</button>
      <button id="no1" class="no" onclick="document.getElementById('member').style.display='none'">Cancel</button>
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

    <div class="bekhayali not_visible" id="bekhayali">

      <div class="album_name">
      <h1>Kabir Singh</h1>
      <input type="button" onclick="goBack('bekhayali')" value="close"></input>
      </div>

      <div class="album">
        <div class="card">   
          <div>
          <img src="images/bekhayali.jpg" class="song_img">
          </div>
          
          <div class="actions">
            <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs"></i>
            <a href="music/bekhayali.mp3" download="Bekhayali">
              <img src="images/download_icon.jpg" class="download_icon">
            </a>
          </div>
          
          <div  style="cursor: pointer" onclick="selectSong('bekhayali.mp3')">Bekhayali</div>
        </div>
      </div>

    </div>

    <div class="sections visible" id="sections">

      <h1>Albums</h1>

      <div class="album">
        <div class="card " >   
          <div>
          <img src="images/bekhayali.jpg" class="song_img" onclick="changeDisplay('bekhayali')">
          </div>
          
          <div class="actions">
            <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs"></i>
            <a href="music/bekhayali.mp3" download="Bekhayali">
              <img src="images/download_icon.jpg" class="download_icon">
            </a>
          </div>
          
          <div class="song_name" style="cursor: pointer" onclick="selectSong('bekhayali.mp3')">Bekhayali</div>
        </div>

        <div class="card">   
          <div>
          <img src="images/ghungroo.jpg" class="song_img">
          </div>
        
          <div class="actions">
            <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs"></i>
            <a href="music/ghungroo.mp3" download="ghungroo">
              <img src="images/download_icon.jpg" class="download_icon">
            </a>
          </div>

          <div style="cursor: pointer" onclick="selectSong('ghungroo.mp3')">Ghungroo</div>
        </div>

        <div class="card">   
          <div>
          <img src="images/yaad.jpg" class="song_img">
          </div>
          
          <div class="actions">
            <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs"></i>
            <a href="music/yaad.mp3" download="yaad">
              <img src="images/download_icon.jpg" class="download_icon">
            </a>
          </div>

          <div style="cursor: pointer" onclick="selectSong('yaad.mp3')">Yaad</div>
        </div>

        <div class="card">   
          <div>
          <img src="images/kabira.jpg" class="song_img">
          </div>
        
          <div class="actions">
            <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs"></i>
            <a href="music/kabira.mp3" download="kabira">
              <img src="images/download_icon.jpg" class="download_icon">
            </a>
          </div>

          <div style="cursor: pointer" onclick="selectSong('kabira.mp3')">Kabira</div>
        </div>

        <div class="card">   
          <div>
          <img src="images/paniyosa.jpg" class="song_img">
          </div>
        
          <div class="actions">
            <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs"></i>
            <a href="music/paniyosa.mp3" download="paniyosa">
              <img src="images/download_icon.jpg" class="download_icon">
            </a>
          </div>

          <div style="cursor: pointer" onclick="selectSong('paniyosa.mp3')">Paniyosa</div>
        </div>

        <div class="card">   
          <div>
          <img src="images/bekhayali.jpg" class="song_img">
          </div>
          
          <div class="actions">
            <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs"></i>
            <a href="music/bekhayali.mp3" download="Bekhayali">
              <img src="images/download_icon.jpg" class="download_icon">
            </a>
          </div>
          
          <div style="cursor: pointer" onclick="selectSong('bekhayali.mp3')">Bekhayali</div>
        </div>

        <div class="card">   
          <div>
          <img src="images/ghungroo.jpg" class="song_img">
          </div>
        
          <div class="actions">
            <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs"></i>
            <a href="music/ghungroo.mp3" download="ghungroo">
              <img src="images/download_icon.jpg" class="download_icon">
            </a>
          </div>

          <div style="cursor: pointer" onclick="selectSong('ghungroo.mp3')">Ghungroo</div>
        </div>

        <div class="card">   
          <div>
          <img src="images/yaad.jpg" class="song_img">
          </div>
          
          <div class="actions">
            <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs"></i>
            <a href="music/yaad.mp3" download="yaad">
              <img src="images/download_icon.jpg" class="download_icon">
            </a>
          </div>

          <div style="cursor: pointer" onclick="selectSong('yaad.mp3')">Yaad</div>
        </div>

        <div class="card">   
          <div>
          <img src="images/kabira.jpg" class="song_img">
          </div>
        
          <div class="actions">
            <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs"></i>
            <a href="music/kabira.mp3" download="kabira">
              <img src="images/download_icon.jpg" class="download_icon">
            </a>
          </div>

          <div style="cursor: pointer" onclick="selectSong('kabira.mp3')">Kabira</div>
        </div>

        <div class="card">   
          <div>
          <img src="images/paniyosa.jpg" class="song_img">
          </div>
        
          <div class="actions">
            <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs"></i>
            <a href="music/paniyosa.mp3" download="paniyosa">
              <img src="images/download_icon.jpg" class="download_icon">
            </a>
          </div>

          <div style="cursor: pointer" onclick="selectSong('paniyosa.mp3')">Paniyosa</div>
        </div>
    
      </div>

      <h1>Artists</h1>

      <div class="album">
        <div class="card " onclick="changeDisplay('bekhayali')">   
          <div>
          <img src="images/bekhayali.jpg" class="song_img">
          </div>
          
          <div class="actions">
            <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs"></i>
            <a href="music/bekhayali.mp3" download="Bekhayali">
              <img src="images/download_icon.jpg" class="download_icon">
            </a>
          </div>
          
          <div style="cursor: pointer" onclick="selectSong('bekhayali.mp3')">Bekhayali</div>
        </div>

        <div class="card">   
          <div>
          <img src="images/ghungroo.jpg" class="song_img">
          </div>
        
          <div class="actions">
            <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs"></i>
            <a href="music/ghungroo.mp3" download="ghungroo">
              <img src="images/download_icon.jpg" class="download_icon">
            </a>
          </div>

          <div style="cursor: pointer" onclick="selectSong('ghungroo.mp3')">Ghungroo</div>
        </div>

        <div class="card">   
          <div>
          <img src="images/yaad.jpg" class="song_img">
          </div>
          
          <div class="actions">
            <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs"></i>
            <a href="music/yaad.mp3" download="yaad">
              <img src="images/download_icon.jpg" class="download_icon">
            </a>
          </div>

          <div style="cursor: pointer" onclick="selectSong('yaad.mp3')">Yaad</div>
        </div>

        <div class="card">   
          <div>
          <img src="images/kabira.jpg" class="song_img">
          </div>
        
          <div class="actions">
            <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs"></i>
            <a href="music/kabira.mp3" download="kabira">
              <img src="images/download_icon.jpg" class="download_icon">
            </a>
          </div>

          <div style="cursor: pointer" onclick="selectSong('kabira.mp3')">Kabira</div>
        </div>

        <div class="card">   
          <div>
          <img src="images/paniyosa.jpg" class="song_img">
          </div>
        
          <div class="actions">
            <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs"></i>
            <a href="music/paniyosa.mp3" download="paniyosa">
              <img src="images/download_icon.jpg" class="download_icon">
            </a>
          </div>

          <div style="cursor: pointer" onclick="selectSong('paniyosa.mp3')">Paniyosa</div>
        </div>

        <div class="card">   
          <div>
          <img src="images/bekhayali.jpg" class="song_img">
          </div>
          
          <div class="actions">
            <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs"></i>
            <a href="music/bekhayali.mp3" download="Bekhayali">
              <img src="images/download_icon.jpg" class="download_icon">
            </a>
          </div>
          
          <div style="cursor: pointer" onclick="selectSong('bekhayali.mp3')">Bekhayali</div>
        </div>

        <div class="card">   
          <div>
          <img src="images/ghungroo.jpg" class="song_img">
          </div>
        
          <div class="actions">
            <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs"></i>
            <a href="music/ghungroo.mp3" download="ghungroo">
              <img src="images/download_icon.jpg" class="download_icon">
            </a>
          </div>

          <div style="cursor: pointer" onclick="selectSong('ghungroo.mp3')">Ghungroo</div>
        </div>

        <div class="card">   
          <div>
          <img src="images/yaad.jpg" class="song_img">
          </div>
          
          <div class="actions">
            <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs"></i>
            <a href="music/yaad.mp3" download="yaad">
              <img src="images/download_icon.jpg" class="download_icon">
            </a>
          </div>

          <div style="cursor: pointer" onclick="selectSong('yaad.mp3')">Yaad</div>
        </div>

        <div class="card">   
          <div>
          <img src="images/kabira.jpg" class="song_img">
          </div>
        
          <div class="actions">
            <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs"></i>
            <a href="music/kabira.mp3" download="kabira">
              <img src="images/download_icon.jpg" class="download_icon">
            </a>
          </div>

          <div style="cursor: pointer" onclick="selectSong('kabira.mp3')">Kabira</div>
        </div>

        <div class="card">   
          <div>
          <img src="images/paniyosa.jpg" class="song_img">
          </div>
        
          <div class="actions">
            <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs"></i>
            <a href="music/paniyosa.mp3" download="paniyosa">
              <img src="images/download_icon.jpg" class="download_icon">
            </a>
          </div>

          <div style="cursor: pointer" onclick="selectSong('paniyosa.mp3')">Paniyosa</div>
        </div>
    
      </div>

      <h1>Songs</h1>

      <div class="album">
        <div class="card">   
          <div>
          <img src="images/bekhayali.jpg" class="song_img">
          </div>
          
          <div class="actions">
            <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs"></i>
            <a href="music/bekhayali.mp3" download="Bekhayali">
              <img src="images/download_icon.jpg" class="download_icon">
            </a>
          </div>
          
          <div style="cursor: pointer" onclick="selectSong('bekhayali.mp3')">Bekhayali</div>
        </div>

        <div class="card">   
          <div>
          <img src="images/ghungroo.jpg" class="song_img">
          </div>
        
          <div class="actions">
            <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs"></i>
            <a href="music/ghungroo.mp3" download="ghungroo">
              <img src="images/download_icon.jpg" class="download_icon">
            </a>
          </div>

          <div style="cursor: pointer" onclick="selectSong('ghungroo.mp3')">Ghungroo</div>
        </div>

        <div class="card">   
          <div>
          <img src="images/yaad.jpg" class="song_img">
          </div>
          
          <div class="actions">
            <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs"></i>
            <a href="music/yaad.mp3" download="yaad">
              <img src="images/download_icon.jpg" class="download_icon">
            </a>
          </div>

          <div style="cursor: pointer" onclick="selectSong('yaad.mp3')">Yaad</div>
        </div>

        <div class="card">   
          <div>
          <img src="images/kabira.jpg" class="song_img">
          </div>
        
          <div class="actions">
            <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs"></i>
            <a href="music/kabira.mp3" download="kabira">
              <img src="images/download_icon.jpg" class="download_icon">
            </a>
          </div>

          <div style="cursor: pointer" onclick="selectSong('kabira.mp3')">Kabira</div>
        </div>

        <div class="card">   
          <div>
          <img src="images/paniyosa.jpg" class="song_img">
          </div>
        
          <div class="actions">
            <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs"></i>
            <a href="music/paniyosa.mp3" download="paniyosa">
              <img src="images/download_icon.jpg" class="download_icon">
            </a>
          </div>

          <div style="cursor: pointer" onclick="selectSong('paniyosa.mp3')">Paniyosa</div>
        </div>

        <div class="card">   
          <div>
          <img src="images/bekhayali.jpg" class="song_img">
          </div>
          
          <div class="actions">
            <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs"></i>
            <a href="music/bekhayali.mp3" download="Bekhayali">
              <img src="images/download_icon.jpg" class="download_icon">
            </a>
          </div>
          
          <div style="cursor: pointer" onclick="selectSong('bekhayali.mp3')">Bekhayali</div>
        </div>

        <div class="card">   
          <div>
          <img src="images/ghungroo.jpg" class="song_img">
          </div>
        
          <div class="actions">
            <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs"></i>
            <a href="music/ghungroo.mp3" download="ghungroo">
              <img src="images/download_icon.jpg" class="download_icon">
            </a>
          </div>

          <div style="cursor: pointer" onclick="selectSong('ghungroo.mp3')">Ghungroo</div>
        </div>

        <div class="card">   
          <div>
          <img src="images/yaad.jpg" class="song_img">
          </div>
          
          <div class="actions">
            <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs"></i>
            <a href="music/yaad.mp3" download="yaad">
              <img src="images/download_icon.jpg" class="download_icon">
            </a>
          </div>

          <div style="cursor: pointer" onclick="selectSong('yaad.mp3')">Yaad</div>
        </div>

        <div class="card">   
          <div>
          <img src="images/kabira.jpg" class="song_img">
          </div>
        
          <div class="actions">
            <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs"></i>
            <a href="music/kabira.mp3" download="kabira">
              <img src="images/download_icon.jpg" class="download_icon">
            </a>
          </div>

          <div style="cursor: pointer" onclick="selectSong('kabira.mp3')">Kabira</div>
        </div>

        <div class="card">   
          <div>
          <img src="images/paniyosa.jpg" class="song_img">
          </div>
        
          <div class="actions">
            <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs"></i>
            <a href="music/paniyosa.mp3" download="paniyosa">
              <img src="images/download_icon.jpg" class="download_icon">
            </a>
          </div>

          <div style="cursor: pointer" onclick="selectSong('paniyosa.mp3')">Paniyosa</div>
        </div>
    
      </div>
    </div>

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