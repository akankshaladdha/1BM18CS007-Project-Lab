<?php
session_start();
require_once('config.php');
?>


<?php

  $db_host="localhost";
  $db_user="root";
   $db_pass="";
        $db_name="project_4";

        $con = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
        
        $sql = " select * from premium where premium_email='".$_SESSION['email']."' limit 1";

        $result= mysqli_query($con,$sql);
     $row=mysqli_fetch_array($result);
     $count=mysqli_num_rows($result);

     if($count!=1)
     {
      echo '<style type="text/css">
      .download_icon{ 
        display: none;
      }
      </style>';
     }
     

?>

<!DOCTYPE html>
<html>
<head>
  <title>HOME</title>
  <link  href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  
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
  
    var confirmbox = document.getElementById('premium');
    window.onclick = function(event){
      if(event.target==confirmbox){
        confirmbox.style.display='none';
      } 
    }
       
  </script>
    
    <script>
      function changeDisplay(albumId){
        
        var album = document.getElementById(albumId);
        var section = document.getElementById('section_content');
        section.style.display='none';
        album.style.display='flex';
      }
      </script>

      <script>
        function goBack(albumId){
          
        var album = document.getElementById(albumId);
        var section = document.getElementById('section_content');
        section.style.display='block';
        album.style.display='none';
        }
      </script>
   
        <script>
        
          function openDisplay(elem_id)
          {
            var tren = document.getElementById('trending');
            var like = document.getElementById('liked_songs');
            var section = document.getElementById('sections');
            var elem = document.getElementById(elem_id);

            section.classList.add('hide');
            elem.classList.remove('hide');

            if(elem_id=="trending")
            {
              if(!like.classList.contains(hide))
              {
                like.classList.add('hide');
              }
            }
            else if(elem_id=="liked_songs")
            {
              if(!tren.classList.contains(hide))
              {
                tren.classList.add('hide');
              }
            }
          }

          function closeDisplay(elem_id)
          {
            
            var tren = document.getElementById('trending');
            var like = document.getElementById('liked_songs');
            var section = document.getElementById('sections');
            var elem = document.getElementById(elem_id);

            section.classList.remove('hide');
            elem.classList.add('hide');

          }
        </script>



<script>
      function myFunction(x) {
        x.classList.toggle("new");
        if(x.title=="Add to liked songs")
          x.title="Song added to liked songs";
        else
          x.title="Add to liked songs";
          liked_songs(x.id);
      }
    </script>
    

    <script>

      function download_func(elem)
      {
        $(document).ready(function(){
         $.ajax({
          method: "post",
          url:"downloaded.php",
          data: 'a=' + elem,
          dataType: "text",
          success: function (result){
            alert(elem + " downloaded");
          }
        });
      });
      }

    </script>



    <script>

function liked_songs(elem)
{
  var x = document.getElementById(elem);
  if(x.classList.contains('new'))

    {    
      $(document).ready(function(){
         $.ajax({
          method: "post",
          url:"liked.php",
          data: 'a=' + elem +'&b='+ 'old',
          dataType: "text",
          success: function (result){
            alert("Song added to liked list");
          }
        });
      });
    }
   else if(x.classList.contains('old'))
    {
      $(document).ready(function(){
         $.ajax({
          method: "post",
          url:"liked.php",
          data: 'a=' + elem +'&b='+ 'new',
          dataType: "text",
          success: function (result){
            alert("Song removed from liked list");
          }
        });
      });
    }
    
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

    <div class="premium" id="premium">
      <form method="POST">
    <button style='font-size:22px' name ="premium"><i class='fas fa-crown'></i>Premium</button>
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

  <div id="member">
    <div class="message" style="color:black;"><b>Do you wish to become a premium member?</b></div> 
    <form method="POST">   
      <button class="yes" name="YES" id="hide">Yes</button>
      <button id="no1" class="no" onclick="document.getElementById('member').style.display='none'">Cancel</button>
    </form>
    </div>
  </div>
      
  <div id="display_details">
    <div class="message" style="color:black"><b>Membership no and related details have been sent to your registered email-id</b></div>    
      <button class="yes"  onclick="document.getElementById('display_details').style.display='none'">OK</button>
    </div>
  </div>

  <div id="already">
    <div class="message" style="color:black"><b>You are already a member</b></div>
    <hr class="mb-3">

    <div class="info-contents">
     
      <?php

            $db_host="localhost";
            $db_user="root";
            $db_pass="";
            $db_name="self";
                  
            $con = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
            $emailid=$_SESSION['email'];
            $sql = " select * from premium where premium_email='".$emailid."' limit 1";
            $result= mysqli_query($con,$sql);
            $row=mysqli_fetch_array($result);
          
      ?>
      <label><b>Membership No : </b>&nbsp;<?php echo " "; echo $row['membership_no']; ?></label><br>
      <label><b>Start Date :</b>&nbsp;<?php echo " "; echo $row['start_date']; ?></label><br>
      <label><b>Expiry Date &nbsp;&nbsp;: </b>&nbsp;<?php echo " "; echo $row['expiry_date']; ?></label>
  </div>

    <div>
      <button class="yes" onclick="document.getElementById('already').style.display='none'">OK</button>
    </div>

  </div>

  <?php

    if(isset($_POST['premium']))
    {
  
      $db_host="localhost";
      $db_user="root";
      $db_pass="";
      $db_name="project_4";

      $con = mysqli_connect($db_host,$db_user,$db_pass,$db_name);

      $sql = " select * from premium where premium_email='".$_SESSION['email']."' limit 1";
      $result= mysqli_query($con,$sql);
      $row=mysqli_fetch_array($result);
      $count=mysqli_num_rows($result);
      
      if($count==1)
      { 
        echo '<style type="text/css">
          #already{ 
            display: block;
          }
          </style>';
          
          $count=0;
        }
      else
      {
        echo "<script>";
        echo 'document.getElementById("member").style.display="block" ';
        echo "</script>" ;       
      }
    }
  ?>

  <?php
  
    if(isset($_POST['YES']))
    {
      $db_host="localhost";
      $db_user="root";
      $db_pass="";
      $db_name="self";

      $con = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
 
      /*
      echo "<script>";
      echo 'document.getElementById("member").style.display="none" ';
      echo 'document.getElementById("display_details").style.display="block" ';
      echo "</script>" ;
      */

      $date_clicked = date('Y-m-d');
      $date_expired = date('Y-m-d',strtotime('+1 years') );
            
      $user_activation_code = rand(1000000,9999999);
      $activation = $user_activation_code; 

      $sql = "INSERT INTO premium (membership_no,premium_email,start_date,expiry_date) values(?,?,?,?)";
      $stmtinsert = $db->prepare($sql);
      $result = $stmtinsert->execute([$activation, $_SESSION['email'], $date_clicked, $date_expired]);

      if($result)
      {
        $subject="Activating Membership";
        $to=$_SESSION['email'];
        $message =  "Welcome ".$_SESSION['firstname']. "" .$_SESSION['lastname']. "\nThis is your membership number.\n ".$activation. "" ;
        $from= 'akankshaladdha0625@gmail.com';
        mail($to, $subject, $message, 'From: akankshaladdha0625@gmail.com');
      } 
      else
        echo "Error"; 
    } 
  
  ?>

  <script>        
  
    $(document).ready(function(){
      $("#hide").click(function(){
        $("#member").hide();
      });

      $("#hide").click(function(){
        $("#display_details").show();
      });
    });
    
  </script>
  
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
              
      <label><b>Firstname : </b>&nbsp;<?php echo " "; echo $row['firstname']; ?></label><br>
      <label><b>Lastname :</b>&nbsp;<?php echo " "; echo $row['lastname']; ?></label><br>
      <label><b>Email-id &nbsp;&nbsp;: </b>&nbsp;<?php echo " "; echo $row['email']; ?></label>
      
      </div> 
      <div>     
      <button id="no1" class="no" onclick="document.getElementById('info').style.display='none'">Ok</button>
    </div>
  </div>

  <div class="content">
    
    <div class="sidenav">
      <div><a href="admin.php">Home</a></div><br>
      <div><a href="#liked_songs" onclick="openDisplay('liked_songs')">Liked Songs</a></div><br>
      <div><a href="#trending" onclick="openDisplay('trending')">Trending</a></div><br>
      <div><a href="editprofile.php">Edit Profile</a></div><br>
      <div><a href="changepassword.php">Change Password</a></div><br>
      <div><a href="#about">About Us</a></div><br>
      <div><input type="button" class="log" value="Logout" onclick="document.getElementById('logout').style.display = 'block'"></div>
    </div>

    <div class="main">

    <div class="trending hide" id="trending">

      <div class="album_name">
      <i class="fas fa-times-circle"></i>
      <input type="button" onclick="closeDisplay('trending')" value="close"></input>
      </div>

      <div class="album">
        <div class="card">   
          <div>
          <img src="images/bekhayali.jpg" class="song_img">
          </div>
          
         
          
          <div  style="cursor: pointer" onclick="selectSong('bekhayali.mp3')">Kabir Singh</div>
        </div>

        <div class="card">   
          
          
          <div class="actions">
            <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs"></i>
            <a href="music/bekhayali.mp3" download="Bekhayali">
              <img src="images/download_icon.jpg" class="download_icon">
            </a>
          </div>
          
          <div  style="cursor: pointer" onclick="selectSong('bekhayali.mp3')">Bekhayali</div>
        </div>

        <div class="card">   
          
          
          <div class="actions">
            <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs"></i>
            <a href="music/bekhayali.mp3" download="Bekhayali">
              <img src="images/download_icon.jpg" class="download_icon">
            </a>
          </div>
          
          <div  style="cursor: pointer" onclick="selectSong('bekhayali.mp3')">Tumhe Kitna Chahne Lage</div>
        </div>

        <div class="card">   
         
          
          <div class="actions">
            <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs"></i>
            <a href="music/bekhayali.mp3" download="Bekhayali">
              <img src="images/download_icon.jpg" class="download_icon">
            </a>
          </div>
          
          <div  style="cursor: pointer" onclick="selectSong('bekhayali.mp3')">Kaise Hua</div>
        </div>

        <div class="card">   
          
          
          <div class="actions">
            <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs"></i>
            <a href="music/bekhayali.mp3" download="Bekhayali">
              <img src="images/download_icon.jpg" class="download_icon">
            </a>
          </div>
          
          <div  style="cursor: pointer" onclick="selectSong('bekhayali.mp3')">Mere Sohneya</div>
        </div>


        <div class="card">   
          
          
          <div class="actions">
            <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs"></i>
            <a href="music/bekhayali.mp3" download="Bekhayali">
              <img src="images/download_icon.jpg" class="download_icon">
            </a>
          </div>
          
          <div  style="cursor: pointer" onclick="selectSong('bekhayali.mp3')">Tera ban Jauga</div>
        </div>

        <div class="card">   
          
          
          <div class="actions">
            <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs"></i>
            <a href="music/bekhayali.mp3" download="Bekhayali">
              <img src="images/download_icon.jpg" class="download_icon">
            </a>
          </div>
          
          <div  style="cursor: pointer" onclick="selectSong('bekhayali.mp3')">Pehla Pyaar</div>
        </div>

      </div>

    </div>

  <div id="liked_songs" class="liked hide">

  <div class="close">
        <i class="fas fa-times-circle"></i>
        <input type="button" onclick="closeDisplay('liked_songs')" value="close"></input>
        </div>

    <?php

      $db_host="localhost";
      $db_user="root";
      $db_pass="";
      $db_name="project_4";

      $con = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
      $result= mysqli_query($con,"select * from liked where liked_email = '".$_SESSION['email']."' ");
      while($row=mysqli_fetch_array($result))
      {
        $imagepath = "images/";
        echo "<img src='".$imagepath.$row['song_image']."' height='200' width='200'/>";        
        echo '</br>';
        

      }

    ?>

  
  </div>


    <div class="sections visible" id="sections">

    <div class="bekhayali not_visible" id="bekhayali">

<div class="album_name">
<i class="fas fa-times-circle"></i>
<input type="button" onclick="goBack('bekhayali')" value="close"></input>
</div>

<div class="album">
  <div class="card">   
    <div>
    <img src="images/kabir.jpg" class="song_img">
    </div>
    
   
    
    <div  style="cursor: pointer" onclick="selectSong('bekhayali.mp3')">Kabir Singh</div>
  </div>

  <div class="card">   
    
    
    <div class="actions">
      <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs"  id="Bekhayali"></i>
      <a href="music/bekhayali.mp3" download="Bekhayali">
        <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Bekhayali')" >
      </a>
    </div>
    
    <div  style="cursor: pointer" onclick="selectSong('bekhayali.mp3')">Bekhayali</div>
  </div>

  <div class="card">   
    
    
    <div class="actions">
      <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="tujhe kitna chahne lage hum"></i>
      <a href="music/tumhechahne.mp3" download="Tumhe Kitna Chahne Lage">
        <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('tujhe kitna chahne lage hum')">
      </a>
    </div>
    
    <div  style="cursor: pointer" onclick="selectSong('tumhechahne.mp3')">Tujhe Kitna Chahne Lage</div>
  </div>

  <div class="card">   
   
    
    <div class="actions">
      <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="kaise hua"></i>
      <a href="music/kaisehua.mp3" download="Kaise Hua">
        <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('kaise hua')">
      </a>
    </div>
    
    <div  style="cursor: pointer" onclick="selectSong('kaisehua.mp3')">Kaise Hua</div>
  </div>

  <div class="card">   
    
    
    <div class="actions">
      <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="mere sohneya"></i>
      <a href="music/sohneya.mp3" download="Mere Sohneya">
        <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('mere sohneya')">
      </a>
    </div>
    
    <div  style="cursor: pointer" onclick="selectSong('sohneya.mp3')">Mere Sohneya</div>
  </div>


  <div class="card">   
    
    
    <div class="actions">
      <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="tera ban jaunga"></i>
      <a href="music/terabanjauga.mp3" download="Tera Ban Jaunga">
        <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('tera ban jaunga')">
      </a>
    </div>
    
    <div  style="cursor: pointer" onclick="selectSong('terabanjauga.mp3')">Tera ban Jaunga</div>
  </div>

  <div class="card">   
    
    
    <div class="actions">
      <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="pehla pyaar"></i>
      <a href="music/pyaar.mp3" download="Pehla Pyar">
        <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('pehla pyaar')">
      </a>
    </div>
    
    <div  style="cursor: pointer" onclick="selectSong('pyaar.mp3')">Pehla Pyaar</div>
  </div>

</div>

</div>


<div class="villain not_visible" id="villain">

<div class="album_name">
<i class="fas fa-times-circle"></i>
<input type="button" onclick="goBack('villain')" value="close"></input>
</div>

<div class="album">
<div class="card">   
<div>
<img src="images/villain.jpg" class="song_img">
</div>



<div  style="cursor: pointer" onclick="selectSong('galliyan.mp3')"></div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="galliyan"></i>
<a href="music/galliyan.mp3" download="Galliyan">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('galliyan')">
</a>
</div>

<div  style="cursor: pointer" onclick="selectSong('galliyan.mp3')">Galliyan</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="banjara"></i>
<a href="music/banjara.mp3" download="Banjara">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('banjara')">
</a>
</div>

<div  style="cursor: pointer" onclick="selectSong('banjara.mp3')">Banjara</div>
</div>


<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="ghungroo"></i>
<a href="music/ghungroo.mp3" download="Ghungroo">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('ghungroo')">
</a>
</div>

<div  style="cursor: pointer" onclick="selectSong('ghungroo.mp3')">Ghungroo</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="zaroorat"></i>
<a href="music/zaroorat.mp3" download="Zaroorat">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('zaroorat')">
</a>
</div>

<div  style="cursor: pointer" onclick="selectSong('zaroorat.mp3')">Zaroorat</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="awari"></i>
<a href="music/awari.mp3" download="Awari">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('awari')">
</a>
</div>

<div  style="cursor: pointer" onclick="selectSong('awari.mp3')">Awari</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="humdard"></i>
<a href="music/humdard.mp3" download="Humdard">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('humdard')">
</a>
</div>

<div  style="cursor: pointer" onclick="selectSong('humdard.mp3')">Humdard</div>
</div>


</div>
</div>



<div class="baaghi not_visible" id="baaghi">

<div class="album_name">
<i class="fas fa-times-circle"></i>
<input type="button" onclick="goBack('baaghi')" value="close"></input>
</div>

<div class="album">
<div class="card">   
<div>
<img src="images/baaghi.jpg" class="song_img">
</div>



<div  style="cursor: pointer" onclick="selectSong('sabtera.mp3')">Baaghi</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="sab tera"></i>
<a href="music/sabtera.mp3" download="Sab Tera">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('sab tera')">
</a>
</div>

<div  style="cursor: pointer" onclick="selectSong('sabtera.mp3')"></div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="cham cham"></i>
<a href="music/chamcham.mp3" download="Cham Cham">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('cham cham')">
</a>
</div>

<div  style="cursor: pointer" onclick="selectSong('chamcham.mp3')">Cham Cham</div>
</div>



<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="o sathi'"></i>
<a href="music/saathi.mp3" download="O Saathi">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('o sathi')">
</a>
</div>

<div  style="cursor: pointer" onclick="selectSong('saathi.mp3')">O Saathi</div>
</div>


<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="tujhe rab mana"></i>
<a href="music/tujherabmana.mp3" download="Tujhe Rab Mana">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('tujhe rab mana')">
</a>
</div>

<div  style="cursor: pointer" onclick="selectSong('tujherabmana.mp3')">Tujhe Rab Mana</div>
</div>



<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="girl i need u"></i>
<a href="music/girlineed.mp3" download="Girl I Need You">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('girl i need u')">
</a>
</div>

<div  style="cursor: pointer" onclick="selectSong('girlineed.mp3')">Girl I Need You</div>
</div>


<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="agar tu hota"></i>
<a href="music/agartuhota.mp3" download="Agar Tu Hota">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('agar tu hota')">
</a>
</div>

<div  style="cursor: pointer" onclick="selectSong('agartuhota.mp3')">Agar Tu Hota</div>
</div>


<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="yaad piya ki"></i>
<a href="music/yaad.mp3" download="Yaad Piya Ki">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('yaad piya ki')">
</a>
</div>

<div  style="cursor: pointer" onclick="selectSong('yaad.mp3')">Yaad Piya Ki</div>
</div>

</div>
</div>


<div class="yejawani not_visible" id="yejawani">

<div class="album_name">
<i class="fas fa-times-circle"></i>
<input type="button" onclick="goBack('yejawani')" value="close"></input>
</div>

<div class="album">
<div class="card">   
<div>
<img src="images/kabira.jpg" class="song_img">
</div>



<div  style="cursor: pointer" onclick="selectSong('kabira.mp3')">Yeh Jawani Hai Diwani</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="badtameez dil"></i>
<a href="music/badtameezdil.mp3" download="Badtameez Dil">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('badtameez dil')">
</a>
</div>

<div  style="cursor: pointer" onclick="selectSong('badtameezdil.mp3')">Badtameez Dil</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="dilliwali girlfriend"></i>
<a href="music/dilliwaligf.mp3" download="Dilliwali Girlfriend">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('dilliwali girlfriend')">
</a>
</div>

<div  style="cursor: pointer" onclick="selectSong('dilliwaligf.mp3')">Dilliwali Girlfriend</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="balam pichkari"></i>
<a href="music/balampichkari.mp3" download="Balam Pichkari">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('balam pichkari')">
</a>
</div>

<div  style="cursor: pointer" onclick="selectSong('balampichkari.mp3')">Balam Pichkari</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="ghagra"></i>
<a href="music/ghagra.mp3" download="Ghagra">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('ghagra')">
</a>
</div>

<div  style="cursor: pointer" onclick="selectSong('ghagra.mp3')">Ghagra</div>
</div>


<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="kabira"></i>
<a href="music/kabira.mp3" download="Kabira">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('kabira')">
</a>
</div>

<div  style="cursor: pointer" onclick="selectSong('kabira.mp3')">Kabira</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="ilahi"></i>
<a href="music/ilahi.mp3" download="Ilahi">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('ilahi')">
</a>
</div>

<div  style="cursor: pointer" onclick="selectSong('ilahi.mp3')">Ilahi</div>
</div>

</div>

</div>


<div class="satyamev not_visible" id="satyamev">

<div class="album_name">
<i class="fas fa-times-circle"></i>
<input type="button" onclick="goBack('satyamev')" value="close"></input>
</div>

<div class="album">
<div class="card">   
<div>
<img src="images/paniyosa.jpg" class="song_img">
</div>



<div  style="cursor: pointer" onclick="selectSong('paniyosa.mp3')">Satyamev Jayate</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="paniyosa"></i>
<a href="music/paniyosa.mp3" download="Paniyosa">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('paniyosa')">
</a>
</div>

<div  style="cursor: pointer" onclick="selectSong('paniyosa.mp3')">Paniyosa</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="dilbar"></i>
<a href="music/dilbar.mp3" download="Dilbar">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('dilbar')">
</a>
</div>

<div  style="cursor: pointer" onclick="selectSong('dilbar.mp3')">Dilbar</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="tere jaisa"></i>
<a href="music/terejaisa.mp3" download="Tere Jaisa">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('tere jaisa')">
</a>
</div>

<div  style="cursor: pointer" onclick="selectSong('terejaisa.mp3')">Tere Jaisa</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="tajdar-e-haram"></i>
<a href="music/tajdar.mp3" download="Tajdar e Haram">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('tajdar-e-haram')">
</a>
</div>

<div  style="cursor: pointer" onclick="selectSong('tajdar.mp3')">Tajdar e Haram</div>
</div>

</div>

</div>


<div class="lukachuppi not_visible" id="lukachuppi">

<div class="album_name">
<i class="fas fa-times-circle"></i>
<input type="button" onclick="goBack('lukachuppi')" value="close"></input>
</div>

<div class="album">
<div class="card">   
<div>
<img src="images/duniya.jpeg" class="song_img">
</div>



<div  style="cursor: pointer" onclick="selectSong('duniya.mp3')">Luka Chuppi</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="duniya"></i>
<a href="music/duniya.mp3" download="Duniyaa">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('duniya')">
</a>
</div>

<div  style="cursor: pointer" onclick="selectSong('duniya.mp3')">Duniyaa</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="coca cola"></i>
<a href="music/cocacola.mp3" download="Coca Cola">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('coca cola')">
</a>
</div>

<div  style="cursor: pointer" onclick="selectSong('cocacola.mp3')">Coca Cola</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="poster lagwa do"></i>
<a href="music/poster.mp3" download="Poster Lagwa Do">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('poster lagwa do')">
</a>
</div>

<div  style="cursor: pointer" onclick="selectSong('poster.mp3')">Poster Lagwa Do</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="photo"></i>
<a href="music/photo.mp3" download="Photo">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('photo')">
</a>
</div>

<div  style="cursor: pointer" onclick="selectSong('photo.mp3')">Photo</div>
</div>


<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="tu laung main elaichi"></i>
<a href="music/tulaung.mp3" download="Tu Laung Main Elaichi">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('tu laung main elaichi')">
</a>
</div>

<div  style="cursor: pointer" onclick="selectSong('tulaung.mp3')">Tu Laung Main Elaichi</div>
</div>

</div>

</div> 


<div class="soty not_visible" id="soty">

<div class="album_name">
<i class="fas fa-times-circle"></i>
<input type="button" onclick="goBack('soty')" value="close"></input>
</div>

<div class="album">
<div class="card">   
<div>
<img src="images/soty.jpg" class="song_img">
</div>



<div  style="cursor: pointer" onclick="selectSong('disco.mp3')">Student of The Year</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="disco"></i>
<a href="music/disco.mp3" download="The Disco Song">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('disco')">
</a>
</div>

<div  style="cursor: pointer" onclick="selectSong('disco.mp3')">The Disco Song</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="ishq wala love"></i>
<a href="music/ishq.mp3" download="Ishq Wala Love">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('ishq wala love')">
</a>
</div>

<div  style="cursor: pointer" onclick="selectSong('ishq.mp3')">Ishq Wala Love</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="ratta maar"></i>
<a href="music/ratta.mp3" download="Ratta Maar">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('ratta maar')">
</a>
</div>

<div  style="cursor: pointer" onclick="selectSong('ratta.mp3')">Ratta Maar</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="kukkad"></i>
<a href="music/kukkad.mp3" download="Kukkad">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('kukkad')">
</a>
</div>

<div  style="cursor: pointer" onclick="selectSong('kukkad.mp3')">Kukkad</div>
</div>


<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="radha"></i>
<a href="music/radha.mp3" download="Radha">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('radha')">
</a>
</div>

<div  style="cursor: pointer" onclick="selectSong('radha.mp3')">Radha</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="vele"></i>
<a href="music/vele.mp3" download="Vele">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('vele')">
</a>
</div>

<div  style="cursor: pointer" onclick="selectSong('vele.mp3')">Vele</div>
</div>

</div>

</div> 


<div class="tiger not_visible" id="tiger">

<div class="album_name">
<i class="fas fa-times-circle"></i>
<input type="button" onclick="goBack('tiger')" value="close"></input>
</div>

<div class="album">
<div class="card">   
<div>
<img src="images/tiger.jpg" class="song_img">
</div>



<div  style="cursor: pointer" onclick="selectSong('mashallah.mp3')">Ek Tha Tiger</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="mashallah"></i>
<a href="music/mashallah.mp3" download="Mashallah">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('mashallah')">
</a>
</div>

<div  style="cursor: pointer" onclick="selectSong('mashallah.mp3')">Mashallah</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="banjaara"></i>
<a href="music/banjaara.mp3" download="Banjaara">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('banjaara')">
</a>
</div>

<div  style="cursor: pointer" onclick="selectSong('banjaara.mp3')">Banjaara</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="saiyaara"></i>
<a href="music/saiyaara.mp3" download="Saiyaara">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('saiyaara')">
</a>
</div>

<div  style="cursor: pointer" onclick="selectSong('saiyaara.mp3')">Saiyaara</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="laapta"></i>
<a href="music/laapta.mp3" download="Laapta">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('laapta')">
</a>
</div>

<div  style="cursor: pointer" onclick="selectSong('laapta.mp3')">Laapta</div>
</div>

</div>

</div> 



<div class="ashiqui not_visible" id="ashiqui">

<div class="album_name">
<i class="fas fa-times-circle"></i>
<input type="button" onclick="goBack('ashiqui')" value="close"></input>
</div>

<div class="album">
<div class="card">   
<div>
<img src="images/ashiqui.jpg" class="song_img">
</div>



<div  style="cursor: pointer" onclick="selectSong('sunnraha.mp3')">Aashiqui 2</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="sun raha"></i>
<a href="music/sunnraha.mp3" download="Sunn Raha Hai">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('sun raha')">
</a>
</div>

<div  style="cursor: pointer" onclick="selectSong('sunnraha.mp3')">Sunn Raha Hai</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="bhula dena"></i>
<a href="music/bhuladena.mp3" download="Bhula Dena">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('bhula dena')">
</a>
</div>

<div  style="cursor: pointer" onclick="selectSong('bhuladena.mp3')">Bhula Dena</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="tum hi ho"></i>
<a href="music/meriashiqui.mp3" download="Tum hi ho">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('tum hi ho')">
</a>
</div>

<div  style="cursor: pointer" onclick="selectSong('meriashiqui.mp3')">Tum hi ho</div>
</div>


<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="hum mar jaege"></i>
<a href="music/hummarjaege.mp3" download="Hum Mar Jaege">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('hum mar jaege')">
</a>
</div>

<div  style="cursor: pointer" onclick="selectSong('hummarjaege.mp3')">Hum Mar Jaege</div>
</div>


<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="chahun main ya na"></i>
<a href="music/chahumeyana.mp3" download="Chahun Main Ya Naa">
 <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('chahun main ya na')">
</a>
</div>

<div  style="cursor: pointer" onclick="selectSong('chahumeyana.mp3')">Chahun Main Ya Naa</div>
</div>


</div>

</div> 


<div class="housefull not_visible" id="housefull">

<div class="album_name">
<i class="fas fa-times-circle"></i>
<input type="button" onclick="goBack('housefull')" value="close"></input>
</div>

<div class="album">
<div class="card">   
<div>
<img src="images/housefull.jpg" class="song_img">
</div>



<div  style="cursor: pointer" onclick="selectSong('youmine.mp3')">Housefull</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="oh girl you are mine"></i>
<a href="music/youmine.mp3" download="Oh Girl You're Mine">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('oh girl you are mine')">
</a>
</div>

<div  style="cursor: pointer" onclick="selectSong('youmine.mp3')">Oh Girl You're Mine</div>
</div>


<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="aapka kya hoga"></i>
<a href="music/aapkakyahoga.mp3" download="Aapka Kya Hoga">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('aapka kya hoga')">
</a>
</div>

<div  style="cursor: pointer" onclick="selectSong('aapkakyahoga.mp3')">Aapka Kya Hoga</div>
</div>



<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="papa jaag jaega"></i>
<a href="music/papa.mp3" download="Papa Jaag Jaega">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('papa jaag jaega')">
</a>
</div>

<div  style="cursor: pointer" onclick="selectSong('papa.mp3')">Papa Jaag Jaega</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="i dont know"></i>
<a href="music/idk.mp3" download="I don't Know What To do">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('i dont know')">
</a>
</div>

<div  style="cursor: pointer" onclick="selectSong('idk.mp3')">I don't Know What To do</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="loser"></i>
<a href="music/loser.mp3" download="Loser">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('loser')">
</a>
</div>

<div  style="cursor: pointer" onclick="selectSong('loser.mp3')">Loser</div>
</div>

</div>

</div> 




<div class="arijitSingh not_visible" id="arijitSingh">

<div class="album_name">
<i class="fas fa-times-circle"></i>
<input type="button" onclick="goBack('arijitSingh')" value="close"></input>
</div>

<div class="album">
<div class="card">   
<div>
<img src="images/arijit.jpg" class="song_img">
</div>



<div  style="cursor: pointer" onclick="selectSong('wohdin.mp3')">Arijit Singh</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Woh din"></i>
<a href="music/wohdin.mp3" download="Woh Din">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Woh din')">
</a>
</div>

<div  style="cursor: pointer" onclick="selectSong('wohdin.mp3')">Woh Din</div>
</div>


<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Hamari adhuri kahani"></i>
<a href="music/hamariaduri.mp3" download="Hamari Adhuri Kahani">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Hamari adhuri kahani')">
</a>
</div>

<div style="cursor: pointer" onclick="selectSong('hamariadhuri.mp3')">Hamari Adhuri Kahani</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Khairiyat"></i>
<a href="music/khairiyat.mp3" download="Khariyat">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Khairiyat')">
</a>
</div>

<div style="cursor: pointer" onclick="selectSong('khairiyat.mp3')">Khairiyat</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Thodi jagah"></i>
<a href="music/thodijagah.mp3" download="Thodi Jagah">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Thodi jagah')">
</a>
</div>

<div style="cursor: pointer" onclick="selectSong('thodijagah.mp3')">Thodi Jagah</div>
</div>


<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Pachtaoge"></i>
<a href="music/pachtaoge.mp3" download="Pachtaoge">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Pachtaoge')">
</a>
</div>

<div style="cursor: pointer" onclick="selectSong('pachtaoge.mp3')">Pachtaoge</div>
</div>

</div>
</div>




<div class="shreyaGhoshal not_visible" id="shreyaGhoshal">

<div class="album_name">
<i class="fas fa-times-circle"></i>
<input type="button" onclick="goBack('shreyaGhoshal')" value="close"></input>
</div>

<div class="album">
<div class="card">   
<div>
<img src="images/shreya.jpg" class="song_img">
</div>



<div  style="cursor: pointer" onclick="selectSong('gharmore.mp3')">Shreya Ghoshal</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Ghar more pardesiya"></i>
<a href="music/gharmore.mp3" download="Ghar more pardesiya">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Ghar more pardesiya')">
</a>
</div>

<div style="cursor: pointer" onclick="selectSong('gharmore.mp3')">Ghar more pardesiya</div>
</div>


<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Tabah ho gaye"></i>
<a href="music/tabaah.mp3" download="Tabaah ho gaye">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Tabah ho gaye')">
</a>
</div>

<div style="cursor: pointer" onclick="selectSong('tabaah.mp3')">Tabaah ho gaye</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Teri meri"></i>
<a href="music/terimeri.mp3" download="Teri Meri">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Teri meri')">
</a>
</div>

<div style="cursor: pointer" onclick="selectSong('terimeri.mp3')">Teri Meri</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Chikni chameli"></i>
<a href="music/chikni.mp3" download="Chikni Chameli">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Chikni chameli')">
</a>
</div>

<div style="cursor: pointer" onclick="selectSong('chikni.mp3')">Chikni Chameli</div>
</div>


<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Ghoomar"></i>
<a href="music/ghoomar.mp3" download="Ghoomar">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Ghoomar')">
</a>
</div>

<div style="cursor: pointer" onclick="selectSong('ghoomar.mp3')">Ghoomar</div>
</div>

</div>
</div>





<div class="mohitChauhan not_visible" id="mohitChauhan">

<div class="album_name">
<i class="fas fa-times-circle"></i>
<input type="button" onclick="goBack('mohitChauhan')" value="close"></input>
</div>

<div class="album">
<div class="card">   
<div>
<img src="images/mohit.jpg" class="song_img">
</div>



<div  style="cursor: pointer" onclick="selectSong('dooriyan.mp3')">Mohit Chauhan</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Dooriyan"></i>
<a href="music/dooriyan.mp3" download="Dooriyan">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Dooriyan')">
</a>
</div>

<div style="cursor: pointer" onclick="selectSong('dooriyan.mp3')">Dooriyan</div>
</div>


<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Tum se hi"></i>
<a href="music/tumsehi.mp3" download="Tum se hi">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Tum se hi')">
</a>
</div>

<div style="cursor: pointer" onclick="selectSong('tumsehi.mp3')">Tum se hi</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Jo bhi main"></i>
<a href="music/jobhimain.mp3" download="Jo bhi main">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Jo bhi main')">
</a>
</div>

<div style="cursor: pointer" onclick="selectSong('jobhimain.mp3')">Jo bhi main</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Tum ho"></i>
<a href="music/tumho.mp3" download="Tum ho">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Tum ho')">
</a>
</div>

<div style="cursor: pointer" onclick="selectSong('tumho.mp3')">Tum ho</div>
</div>


<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Rabba"></i>
<a href="music/rabba.mp3" download="rabba">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Rabba')">
</a>
</div>

<div style="cursor: pointer" onclick="selectSong('rabba.mp3')">Rabba</div>
</div>

</div>
</div>





<div class="rahatKhan not_visible" id="rahatKhan">

<div class="album_name">
<i class="fas fa-times-circle"></i>
<input type="button" onclick="goBack('rahatKhan')" value="close"></input>
</div>

<div class="album">
<div class="card">   
<div>
<img src="images/rahat.jpg" class="song_img">
</div>



<div  style="cursor: pointer" onclick="selectSong('orepiya.mp3')">Rahat Fateh Ali Khan</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="O re piya"></i>
<a href="music/orepiya.mp3" download="O re piya">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('O re piya')">
</a>
</div>

<div style="cursor: pointer" onclick="selectSong('orepiya.mp3')">O re piya</div>
</div>


<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Jag soona soona lage"></i>
<a href="music/jagsoona.mp3" download="Jag Soona Soona Lage">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Jag soona soona lage')">
</a>
</div>

<div style="cursor: pointer" onclick="selectSong('jagsoona.mp3')">Jag soona soona lage</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Jag ghoomeya"></i>
<a href="music/jagghomeya.mp3" download="Jag ghoomeya">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Jag ghoomeya')">
</a>
</div>

<div style="cursor: pointer" onclick="selectSong('jagghoomeya.mp3')">Jag ghoomeya</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Dagabaaz re"></i>
<a href="music/dagabaaz.mp3" download="Dagabaaz re">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Dagabaaz re')">
</a>
</div>

<div style="cursor: pointer" onclick="selectSong('dagabaaz.mp3')">Dagabaaz re</div>
</div>


<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Ajj din chadeya"></i>
<a href="music/ajjdin.mp3" download="Ajj din chadeya">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Ajj din chadeya')">
</a>
</div>

<div style="cursor: pointer" onclick="selectSong('ajjdin.mp3')">Ajj din chadeya</div>
</div>

</div>
</div>



<div class="shaan  not_visible" id="shaan">

<div class="album_name">
<i class="fas fa-times-circle"></i>
<input type="button" onclick="goBack('shaan')" value="close"></input>
</div>

<div class="album">
<div class="card">   
<div>
<img src="images/shaan.jpg" class="song_img">
</div>



<div  style="cursor: pointer" onclick="selectSong('jabsetere.mp3')">Shaan</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Jab se tere naina"></i>
<a href="music/jabsetere.mp3" download="Jab se tere naina">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Jab se tere naina')">
</a>
</div>

<div style="cursor: pointer" onclick="selectSong('jabsetere.mp3')">Jab Se Tere Naina</div>
</div>


<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Deewangi deewangi"></i>
<a href="music/deewangi.mp3" download="Deewangi Deewangi">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Deewangi deewangi')">
</a>
</div>

<div style="cursor: pointer" onclick="selectSong('dewangi.mp3')">Deewangi Deewangi</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Behti hawa sa tha wo"></i>
<a href="music/behtihawa.mp3" download="Behti hawa sa tha wo">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Behti hawa sa tha wo')">
</a>
</div>

<div style="cursor: pointer" onclick="selectSong('behtihawa.mp3')">Behti hawa sa tha wo</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Chand sifarish"></i>
<a href="music/chandsifarish.mp3" download="Chand sifarish">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Chand sifarish')">
</a>
</div>

<div style="cursor: pointer" onclick="selectSong('chandsifarish.mp3')">Chand sifarish</div>
</div>


<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Bum bum bole"></i>
<a href="music/bumbum.mp3" download="Bum Bum bhole">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Bum bum bole')">
</a>
</div>

<div style="cursor: pointer" onclick="selectSong('bumbum.mp3')">Bum bum bhole</div>
</div>

</div>
</div>



<div class="sonuNigam not_visible" id="sonuNigam">

<div class="album_name">
<i class="fas fa-times-circle"></i>
<input type="button" onclick="goBack('sonuNigam')" value="close"></input>
</div>

<div class="album">
<div class="card">   
<div>
<img src="images/sonu.jpg" class="song_img">
</div>



<div  style="cursor: pointer" onclick="selectSong('tenuleke.mp3')">Sonu Nigam</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Tenu leke"></i>
<a href="music/tenuleke.mp3" download="Tenu leke">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Tenu leke')">
</a>
</div>

<div style="cursor: pointer" onclick="selectSong('tenuleke.mp3')">Tenu leke</div>
</div>


<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Suraj hua maddham"></i>
<a href="music/surajhua.mp3" download="Suraj hua maddham">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Suraj hua maddham')">
</a>
</div>

<div style="cursor: pointer" onclick="selectSong('surajhua.mp3')">Suraj hua maddham</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Jane nahi dege tujhe"></i>
<a href="music/jaanenahi.mp3" download="Jane nahi dege tujhe">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Jane nahi dege tujhe')">
</a>
</div>

<div style="cursor: pointer" onclick="selectSong('jaanenahi.mp3')">Jane nahi dege tujhe</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Do pal ruka"></i>
<a href="music/dopal.mp3" download="Do pal ruka">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Do pal ruka')">
</a>
</div>

<div style="cursor: pointer" onclick="selectSong('dopal.mp3')">Do pal ruka</div>
</div>


<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Abhi mujhme kahi"></i>
<a href="music/abhimujhme.mp3" download="Abhi mujhme kahi">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Abhi mujhme kahi')">
</a>
</div>

<div style="cursor: pointer" onclick="selectSong('abhimujhme.mp3')">Abhi mujhme kahi</div>
</div>

</div>
</div>




<div class="sunidhiChauhan not_visible" id="sunidhiChauhan">

<div class="album_name">
<i class="fas fa-times-circle"></i>
<input type="button" onclick="goBack('sunidhiChauhan')" value="close"></input>
</div>

<div class="album">
<div class="card">   
<div>
<img src="images/sunidhi.jpg" class="song_img">
</div>



<div  style="cursor: pointer" onclick="selectSong('thodathoda.mp3')">Sunidhi Chauhan</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Thoda thoda pyaar"></i>
<a href="music/thodathoda.mp3" download="Thoda thoda pyaar">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Thoda thoda pyaar')">
</a>
</div>

<div style="cursor: pointer" onclick="selectSong('thodathoda.mp3')">Thoda thoda pyaar</div>
</div>


<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Shava shava"></i>
<a href="music/shavashava.mp3" download="Say shava shava">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Shava shava')">
</a>
</div>

<div style="cursor: pointer" onclick="selectSong('shavashava.mp3')">Say shava shava</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Gun gun guna"></i>
<a href="music/gungun.mp3" download="Gun gun guna">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Gun gun guna')">
</a>
</div>

<div style="cursor: pointer" onclick="selectSong('gungun.mp3')">Gun gun guna</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Chor bazaari"></i>
<a href="music/chorbazaari.mp3" download="Chor bazaari">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Chor bazaari')">
</a>
</div>

<div style="cursor: pointer" onclick="selectSong('chorbazaari.mp3')">Chor bazaari</div>
</div>


<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Aaja nachle"></i>
<a href="music/aajanachle.mp3" download="Aaja Nachle">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Aaja nachle')">
</a>
</div>

<div style="cursor: pointer" onclick="selectSong('aajanachle.mp3')">Aaja nachle</div>
</div>

</div>
</div>



<div class="nehaKakkar not_visible" id="nehaKakkar">

<div class="album_name">
<i class="fas fa-times-circle"></i>
<input type="button" onclick="goBack('nehaKakkar')" value="close"></input>
</div>

<div class="album">
<div class="card">   
<div>
<img src="images/neha.jpg" class="song_img">
</div>



<div  style="cursor: pointer" onclick="selectSong('dheemedheeme.mp3')">Neha Kakkar</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Dheeme dheeme"></i>
<a href="music/dheemedheeme.mp3" download="Dheeme dheeme">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Dheeme dheeme')">
</a>
</div>

<div style="cursor: pointer" onclick="selectSong('dheemedheeme.mp3')">Dheeme dheeme</div>
</div>


<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Ek toh kam zindagani"></i>
<a href="music/ektohkam.mp3" download="Ek toh kam zindagani">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Ek toh kam zindagani')">
</a>
</div>

<div style="cursor: pointer" onclick="selectSong('ektohkam.mp3')">Ek toh kam zindagani</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Tu hi yaar mera"></i>
<a href="music/tuhiyaar.mp3" download="Tu hi yaar mera">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Tu hi yaar mera')">
</a>
</div>

<div style="cursor: pointer" onclick="selectSong('tuhiyaar.mp3')">Tu hi yaar mera</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id = "o saki saki"></i>
<a href="music/osakisaki.mp3" download="O Saki Saki">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('o saki saki')">
</a>
</div>

<div style="cursor: pointer" onclick="selectSong('osakisaki.mp3')">O Saki Saki</div>
</div>


<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Jinke liye"></i>
<a href="music/jinkeliye.mp3" download="Jinke liye">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Jinke liye')">
</a>
</div>

<div style="cursor: pointer" onclick="selectSong('jinkeliye.mp3')">Jinke liye</div>
</div>

</div>
</div>



<div class="kanikaKapoor not_visible" id="kanikaKapoor">

<div class="album_name">
<i class="fas fa-times-circle"></i>
<input type="button" onclick="goBack('kanikaKapoor')" value="close"></input>
</div>

<div class="album">
<div class="card">   
<div>
<img src="images/kanika.jpg" class="song_img">
</div>



<div  style="cursor: pointer" onclick="selectSong('tukurtukur.mp3')">Kanika Kapoor</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Tukur tukur"></i>
<a href="music/tukurtukur.mp3" download="Tukur tukur">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Tukur tukur')">
</a>
</div>

<div style="cursor: pointer" onclick="selectSong('tukurtukur.mp3')">Tukur tukur</div>
</div>


<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs"></i>
<a href="music/neendein.mp3" download="Neendein khul jati hai">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Neendein khul jati hai')">
</a>
</div>

<div style="cursor: pointer" onclick="selectSong('neendein.mp3')">Neendein khul jati hai</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Lovely"></i>
<a href="music/lovely.mp3" download="Lovely">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Lovely')">
</a>
</div>

<div style="cursor: pointer" onclick="selectSong('lovely.mp3')">Lovely</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Jawaani le doobi"></i>
<a href="music/jawaaniledoobi.mp3" download="Jawaani le doobi">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Jawaani le doobi')">
</a>
</div>

<div style="cursor: pointer" onclick="selectSong('jawaaniledoobi.mp3')">Jawaani le doobi</div>
</div>


<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Hug me"></i>
<a href="music/hugme.mp3" download="Hug me">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Hug me')">
</a>
</div>

<div style="cursor: pointer" onclick="selectSong('hugme.mp3')">Hug me</div>
</div>

</div>
</div>




<div class="arRahman  not_visible" id="arRahman">

<div class="album_name">
<i class="fas fa-times-circle"></i>
<input type="button" onclick="goBack('arRahman')" value="close"></input>
</div>

<div class="album">
<div class="card">   
<div>
<img src="images/arrahman.jpg" class="song_img">
</div>



<div  style="cursor: pointer" onclick="selectSong('rehnatu.mp3')">A R Rahman</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="rehna tu"></i>
<a href="music/rehnatu.mp3" download="Rehna tu">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Rehna tu')">
</a>
</div>

<div style="cursor: pointer" onclick="selectSong('rehnatu.mp3')">Rehna tu</div>
</div>


<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="nadaan parindey"></i>
<a href="music/nadaanparindey.mp3" download="Nadaan parindey">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Nadaan parindey')">
</a>
</div>

<div style="cursor: pointer" onclick="selectSong('nadaanparindey.mp3')">Nadaan parindey</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Kun faya kun"></i>
<a href="music/kunfaayakun.mp3" download="Kun faaya kun">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Kun faya kun')">
</a>
</div>

<div style="cursor: pointer" onclick="selectSong('kunfaayakun.mp3')">Kun faaya kun</div>
</div>

<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Khwaja mere khwaja"></i>
<a href="music/khwajamere.mp3" download="Khwaja mere khwaja">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Khwaja mere khwaja')">
</a>
</div>

<div style="cursor: pointer" onclick="selectSong('khwajamere.mp3')">Khwaja mere khwaja</div>
</div>


<div class="card">   


<div class="actions">
<i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id='Dil se re'></i>
<a href="music/dilsere.mp3" download="Dil se re">
  <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Dil se re')">
</a>
</div>

<div style="cursor: pointer" onclick="selectSong('dilsere.mp3')">Dil se re</div>
</div>

</div>
</div>

<div id="section_content">
      <h1>Albums</h1>

      <div class="album">
        <div class="card " >   
          <div>
          <img src="images/kabir.jpg" class="song_img" onclick="changeDisplay('bekhayali')">
          </div>
          
         
          
          <div class="album_name" style="cursor: pointer">Kabir Singh</div>
        </div>

        <div class="card">   
          <div>
          <img src="images/villain.jpg" class="song_img" onclick="changeDisplay('villain')">
          </div>
        
         
          <div class="album_name" style="cursor: pointer" >Ek Villain</div>
        </div>

        <div class="card">   
          <div>
          <img src="images/baaghi.jpg" class="song_img" onclick="changeDisplay('baaghi')">
          </div>
         
          <div class="album_name" style="cursor: pointer">Baaghi</div>
        </div>

        <div class="card">   
          <div>
          <img src="images/kabira.jpg" class="song_img" onclick="changeDisplay('yejawani')">
          </div>
 
          <div class="album_name" style="cursor: pointer">Ye Jawani Hai Deewani</div>
        </div>

        <div class="card">   
          <div>
          <img src="images/paniyosa.jpg" class="song_img" onclick="changeDisplay('satyamev')">
          </div>

          <div class="album_name" style="cursor: pointer">Satyamev Jayate</div>
        </div>

        <div class="card">   
          <div>
          <img src="images/duniya.jpeg" class="song_img" onclick="changeDisplay('lukachuppi')">
          </div>
          
          <div class="album_name" style="cursor: pointer">Luka Chuppi</div>
        </div>

        <div class="card">   
          <div>
          <img src="images/soty.jpg" class="song_img" onclick="changeDisplay('soty')">
          </div>

          <div class="album_name" style="cursor: pointer">Student of The Year</div>
        </div>

        <div class="card">   
          <div>
          <img src="images/tiger.jpg" class="song_img" onclick="changeDisplay('tiger')">
          </div>
 
          <div class="album_name" style="cursor: pointer">Ek Tha Tiger</div>
        </div>

        <div class="card">   
          <div>
          <img src="images/ashiqui.jpg" class="song_img" onclick="changeDisplay('ashiqui')">
          </div>
        
          <div class="album_name" style="cursor: pointer">Aashiqui 2</div>
        </div>

        <div class="card">   
          <div>
          <img src="images/housefull.jpg" class="song_img" onclick="changeDisplay('housefull')">
          </div>
 
          <div class="album_name" style="cursor: pointer">Housefull</div>
        </div>
    
      </div>

      <h1>Artists</h1>

      <div class="album">

        <div class="card ">   
          <div>
          <img src="images/arijit.jpg" class="song_img"  onclick="changeDisplay('arijitSingh')">
          </div>
          
          <div class="artist_name" style="cursor: pointer">Arijit Singh</div>
        </div>


        <div class="card">   
          <div>
          <img src="images/shreya.jpg" class="song_img"  onclick="changeDisplay('shreyaGhoshal')">
          </div>
 
          <div class="artist_name" style="cursor: pointer">Shreya Ghoshal</div>
        </div>

        <div class="card">   
          <div>
          <img src="images/mohit.jpg" class="song_img" onclick="changeDisplay('mohitChauhan')">
          </div>
 
          <div class="artist_name" style="cursor: pointer">Mohit Chauhan</div>
        </div>

        <div class="card">   
          <div>
          <img src="images/rahat.jpg" class="song_img" onclick="changeDisplay('rahatKhan')">
          </div>
 
          <div class="artist_name" style="cursor: pointer">Rahat Fateh Ali Khan</div>
        </div>

        <div class="card">   
          <div>
          <img src="images/shaan.jpg" class="song_img" onclick="changeDisplay('shaan')">
          </div>
 
          <div class="artist_name" style="cursor: pointer">Shaan</div>
        </div>

        <div class="card">   
          <div>
          <img src="images/sonu.jpg" class="song_img" onclick="changeDisplay('sonuNigam')">
          </div>
          
         
          
          <div class="artist_name" style="cursor: pointer">Sonu Nigam</div>
        </div>

        <div class="card">   
          <div>
          <img src="images/sunidhi.jpg" class="song_img" onclick="changeDisplay('sunidhiChauhan')">
          </div>
        
          

          <div class="artist_name" style="cursor: pointer">Sunidhi Chauhan</div>
        </div>

        <div class="card">   
          <div>
          <img src="images/neha.jpg" class="song_img" onclick="changeDisplay('nehaKakkar')">
          </div>
          
          
          <div class="artist_name" style="cursor: pointer">Neha Kakkar</div>
        </div>

        <div class="card">   
          <div>
          <img src="images/kanika.jpg" class="song_img" onclick="changeDisplay('kanikaKapoor')">
          </div>
        
          
          <div class="artist_name" style="cursor: pointer">Kanika Kapoor</div>
        </div>

        <div class="card">   
          <div>
          <img src="images/arrahman.jpg" class="song_img" onclick="changeDisplay('arRahman')">
          </div>
        
          

          <div class="artist_name" style="cursor: pointer">A R Rahman</div>
        </div>
    
      </div>

     

      
      
<h1>Hollywood</h1>

<div class="hollywood">

  <div class="card">   
    <div>
    <img src="images/allofme.jpg" class="song_img">
    </div>
    
    <div class="actions">
      <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="All of me"></i>
      <a href="music/allofme.mp3" download="All of me">
        <img src="images/download_icon.jpg"  class="download_icon" onclick="download_func('All of me')">
      </a>
    </div>
    
    
    <div style="cursor: pointer" onclick="selectSong('allofme.mp3')">All of me</div>
  </div>

  <div class="card">   
    <div>
    <img src="images/hello.jpg" class="song_img">
    </div>
  
    <div class="actions">
      <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Hello"></i>
      <a href="music/hello.mp3" download="Hello">
        <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Hello')">
      </a>
    </div>

    <div style="cursor: pointer" onclick="selectSong('hello.mp3')">Hello</div>
  </div>

  <div class="card">   
    <div>
    <img src="images/cheapthrills.jpg" class="song_img">
    </div>
    
    <div class="actions">
      <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Cheap thrills"></i>
      <a href="music/cheapthrills.mp3" download="Cheap thrills">
        <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Cheap thrills')">
      </a>
    </div>

    <div style="cursor: pointer" onclick="selectSong('cheapthrills.mp3')">Cheap thrills</div>
  </div>

  <div class="card">   
    <div>
    <img src="images/perfect.jpg" class="song_img">
    </div>
  
    <div class="actions">
      <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Perfect'"></i>
      <a href="music/perfect.mp3" download="Perfect">
        <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Perfcet')">
      </a>
    </div>

    <div style="cursor: pointer" onclick="selectSong('perfect.mp3')">Perfect</div>
  </div>

  <div class="card">   
    <div>
    <img src="images/closer.jpg" class="song_img">
    </div>
  
    <div class="actions">
      <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Closer"></i>
      <a href="music/closer.mp3" download="Closer">
        <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Closer')">
      </a>
    </div>

    <div style="cursor: pointer" onclick="selectSong('closer.mp3')">Closer</div>
  </div>

  <div class="card">   
    <div>
    <img src="images/roses.jpg" class="song_img">
    </div>
    
    <div class="actions">
      <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Roses"></i>
      <a href="music/roses.mp3" download="Roses">
        <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Roses')">
      </a>
    </div>
    
    <div style="cursor: pointer" onclick="selectSong('roses.mp3')">Roses</div>
  </div>

  <div class="card">   
    <div>
    <img src="images/staywithme.jpg" class="song_img">
    </div>
  
    <div class="actions">
      <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Stay with me"></i>
      <a href="music/staywithme.mp3" download="Stay with me">
        <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Stay with me')">
      </a>
    </div>

    <div style="cursor: pointer" onclick="selectSong('staywithme.mp3')">Stay with me</div>
  </div>

  <div class="card">   
    <div>
    <img src="images/countingstars.jpeg" class="song_img">
    </div>
    
    <div class="actions">
      <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Counting stars"></i>
      <a href="music/countingstars.mp3" download="Counting stars">
        <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Counting stars')">
      </a>
    </div>

    <div style="cursor: pointer" onclick="selectSong('countingstars.mp3')">Counting stars</div>
  </div>

  <div class="card">   
    <div>
    <img src="images/uptownfunk.jpg" class="song_img">
    </div>
  
    <div class="actions">
      <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Uptown funk"></i>
      <a href="music/uptownfunk.mp3" download="Uptown funk">
        <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Uptown funk')">
      </a>
    </div>

    <div style="cursor: pointer" onclick="selectSong('uptownfunk.mp3')">Uptown funk</div>
  </div>

  <div class="card">   
    <div>
    <img src="images/stitches.jpg" class="song_img">
    </div>
  
    <div class="actions">
      <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Stitches"></i>
      <a href="music/stitches.mp3" download="Stitches">
        <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Stitches')">
      </a>
    </div>

    <div style="cursor: pointer" onclick="selectSong('stitches.mp3')">Stitches</div>
  </div>
  

</div>
 
      <h1>Bollywood</h1>

<div class="bollywood">

  <div class="card">   
    <div>
    <img src="images/whistle.jpg" class="song_img">
    </div>
    
    <div class="actions">
      <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="whistle baja"></i>
      <a href="music/whistle.mp3" id="whistle" download="Whistle Baja">
        <img src="images/download_icon.jpg"  class="download_icon" onclick="download_func('whistle baja')">
      </a>
    </div>
    
    
    <div style="cursor: pointer" onclick="selectSong('whistle.mp3')">Whistle Baja</div>
  </div>

  <div class="card">   
    <div>
    <img src="images/lattlaggayee.jpg" class="song_img">
    </div>
  
    <div class="actions">
      <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="latt lag gayee"></i>
      <a href="music/latt.mp3" download="Latt Lag Gayi">
        <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('latt lag gayee')">
      </a>
    </div>

    <div style="cursor: pointer" onclick="selectSong('latt.mp3')">Latt Lag Gayee</div>
  </div>

  <div class="card">   
    <div>
    <img src="images/filhal.jpg" class="song_img">
    </div>
    
    <div class="actions">
      <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="filhal"></i>
      <a href="music/filhal.mp3" download="Filhaal">
        <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('filhal')">
      </a>
    </div>

    <div style="cursor: pointer" onclick="selectSong('filhal.mp3')">Filhal</div>
  </div>

  <div class="card">   
    <div>
    <img src="images/saturday.jpg" class="song_img">
    </div>
  
    <div class="actions">
      <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="saturday"></i>
      <a href="music/saturday.mp3" download="Saturday">
        <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('saturday')">
      </a>
    </div>

    <div style="cursor: pointer" onclick="selectSong('saturday.mp3')">Saturday Saturday</div>
  </div>

  <div class="card">   
    <div>
    <img src="images/tumhiana.jpg" class="song_img">
    </div>
  
    <div class="actions">
      <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="tum hi ana"></i>
      <a href="music/tumhiana.mp3" download="Tum Hi Ana">
        <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('tum hi ana')">
      </a>
    </div>

    <div style="cursor: pointer" onclick="selectSong('tumhiana.mp3')">Tum Hi Ana</div>
  </div>

  <div class="card">   
    <div>
    <img src="images/wajah.jpg" class="song_img">
    </div>
    
    <div class="actions">
      <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="wajah tum ho"></i>
      <a href="music/wajah.mp3" download="Wajah">
        <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('wajah tum ho')">
      </a>
    </div>
    
    <div style="cursor: pointer" onclick="selectSong('wajah.mp3')">Wajah Tum Ho</div>
  </div>

  <div class="card">   
    <div>
    <img src="images/terimitti.jpg" class="song_img">
    </div>
  
    <div class="actions">
      <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="teri mitti"></i>
      <a href="music/terimitti.mp3" download="Teri Mitti">
        <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('teri mitti')">
      </a>
    </div>

    <div style="cursor: pointer" onclick="selectSong('terimitti.mp3')">Teri Mitti</div>
  </div>

  <div class="card">   
    <div>
    <img src="images/kaisemujhe.jpg" class="song_img">
    </div>
    
    <div class="actions">
      <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="kaise mujhe tum mil gayi"></i>
      <a href="music/kaisemujhe.mp3" download="Kaise Mujhe Tum Mil Gayi">
        <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('kaise mujhe tum mil gayi')">
      </a>
    </div>

    <div style="cursor: pointer" onclick="selectSong('kaisemujhe.mp3')">Kaise Mujhe Tum Mil Gayi</div>
  </div>

  <div class="card">   
    <div>
    <img src="images/kauntujhe.jpg" class="song_img">
    </div>
  
    <div class="actions">
      <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="kaun tujhe"></i>
      <a href="music/kauntujhe.mp3" download="Kaun Tujhe">
        <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('kaun tujhe')">
      </a>
    </div>

    <div style="cursor: pointer" onclick="selectSong('kauntujhe.mp3')">Kaun Tujhe</div>
  </div>

  <div class="card">   
    <div>
    <img src="images/dilmeho.jpg" class="song_img">
    </div>
  
    <div class="actions">
      <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="dil me ho tum"></i>
      <a href="music/dilmeho.mp3" download="Dil Me Ho Tum">
        <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('dil me ho tum')">
      </a>
    </div>

    <div style="cursor: pointer" onclick="selectSong('dilmeho.mp3')">Dil Me Ho Tum</div>
  </div>
  

</div>

<h1>Spanish</h1>

<div class="spanish">

  <div class="card">   
    <div>
    <img src="images/concalma.jpg" class="song_img">
    </div>
    
    <div class="actions">
      <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Con calma"></i>
      <a href="music/concalma.mp3" download="Con Calma">
        <img src="images/download_icon.jpg"  class="download_icon" onclick="download_func('Con calma')">
      </a>
    </div>
    
    
    <div style="cursor: pointer" onclick="selectSong('concalma.mp3')">Con calma</div>
  </div>

  <div class="card">   
    <div>
    <img src="images/takitaki.jpeg" class="song_img">
    </div>
  
    <div class="actions">
      <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Taki taki"></i>
      <a href="music/takitaki.mp3" download="Taki taki">
        <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Taki taki')">
      </a>
    </div>

    <div style="cursor: pointer" onclick="selectSong('takitaki.mp3')">Taki taki</div>
  </div>

  <div class="card">   
    <div>
    <img src="images/despacito.jpeg" class="song_img">
    </div>
    
    <div class="actions">
      <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Despacito"></i>
      <a href="music/despacito.mp3" download="Despacito">
        <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Despacito')">
      </a>
    </div>

    <div style="cursor: pointer" onclick="selectSong('despacito.mp3')">Despacito</div>
  </div>

  <div class="card">   
    <div>
    <img src="images/bailando.jpg" class="song_img">
    </div>
  
    <div class="actions">
      <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Bailando"></i>
      <a href="music/bailando.mp3" download="Bailando">
        <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Bailando')">
      </a>
    </div>

    <div style="cursor: pointer" onclick="selectSong('bailando.mp3')">Bailando</div>
  </div>

  <div class="card">   
    <div>
    <img src="images/echamelaculpa.jpg" class="song_img">
    </div>
  
    <div class="actions">
      <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Echame la culpa"></i>
      <a href="music/echamelaculpa.mp3" download="Echame la culpa">
        <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Echame la culpa')">
      </a>
    </div>

    <div style="cursor: pointer" onclick="selectSong('echamelaculpa.mp3')">Echame la culpa</div>
  </div>

  <div class="card">   
    <div>
    <img src="images/chantaje.jpg" class="song_img">
    </div>
    
    <div class="actions">
      <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Chantaje"></i>
      <a href="music/chantaje.mp3" download="chantaje">
        <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Chantaje')">
      </a>
    </div>
    
    <div style="cursor: pointer" onclick="selectSong('chantaje.mp3')">Chantaje</div>
  </div>

  <div class="card">   
    <div>
    <img src="images/gasolina.jpg" class="song_img">
    </div>
  
    <div class="actions">
      <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Gasolina"></i>
      <a href="music/gasolina.mp3" download="Gasolina">
        <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Gasolina')">
      </a>
    </div>

    <div style="cursor: pointer" onclick="selectSong('gasolina.mp3')">Gasolina</div>
  </div>

  <div class="card">   
    <div>
    <img src="images/lococontigo.jpg" class="song_img">
    </div>
    
    <div class="actions">
      <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Loco contigo"></i>
      <a href="music/lococontigo.mp3" download="Loco contigo">
        <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Loco contigo')">
      </a>
    </div>

    <div style="cursor: pointer" onclick="selectSong('lococontigo.mp3')">Loco contigo</div>
  </div>

  <div class="card">   
    <div>
    <img src="images/migente.jpg" class="song_img">
    </div>
  
    <div class="actions">
      <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Mi gente"></i>
      <a href="music/migente.mp3" download="Mi gente">
        <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Mi gente')">
      </a>
    </div>

    <div style="cursor: pointer" onclick="selectSong('migente.mp3')">Mi gente</div>
  </div>

  <div class="card">   
    <div>
    <img src="images/tebote.jpg" class="song_img">
    </div>
  
    <div class="actions">
      <i onclick="myFunction(this)" class="fa fa-heart old" title="Add to liked songs" id="Te bote"></i>
      <a href="music/tebote.mp3" download="Te bote">
        <img src="images/download_icon.jpg" class="download_icon" onclick="download_func('Te bote')">
      </a>
    </div>

    <div style="cursor: pointer" onclick="selectSong('tebote.mp3')">Te bote</div>
  </div>
  

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

  <script>
    if(window.history.replaceState){
      window.history.replaceState(null,null,window.location.href);
    }
    </script>




</body>
</html>