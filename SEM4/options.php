<?php

session_start();

require_once("config.php");

?>

<html>
<head>
  <link href="loggedin.css" rel="stylesheet">
  <link href="alert.css" rel="stylesheet">
  <link href="editprofile.css" rel="stylesheet">


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

  <?php
    
    $db_host="localhost";
    $db_user="root";
    $db_pass="";
    $db_name="project_4";
    
    $con = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
    $email= $_SESSION['email'];
   
    
    if(isset($_POST['add']))
    { 
        $song = $_POST['song'];
        $album = $_POST['album'];
        $artist = $_POST['artist'];
        $image = $_POST['image'];
        $category = $_POST['category'];
       
        $sql = "select * from category where song_name = '".$song."' ";
        $result= mysqli_query($con,$sql);
        $row=mysqli_fetch_array($result);
        $count=mysqli_num_rows($result); 
        if($count==1)
        {
            echo '<script>';
            echo "alert('Song already exist in the table')";
            echo '</script>';
        }
       
                
                if($category=="Albums")
                {
                    if(!$album){
                        echo '<script>';
                        echo "alert('Enter Album Name')";
                        echo '</script>';
                }
                else
                    {
                        
                        $sql="INSERT into admin(song_name,song_added,song_category,admin_email,artist_name,song_image)values(?,?,?,?,?,?)";
                        $stmtinsert = $db->prepare($sql);
                        $result = $stmtinsert->execute([ $song, "yes", $category, $email,$artist,$image]);
                        if($result)
                        {
                            
                            $sql = "select * from admin where admin_email = '".$email."' and song_name = '".$song."' ";
                            $result= mysqli_query($con,$sql);
                            $row=mysqli_fetch_array($result);
                            if($result)
                            {
                                $adminid = $row['admin_id'];
                            }
                            $sql = "INSERT into category(admin_id,song_name,album_name,artist_name,bollywood,hollywood,spanish,song_image)values(?,?,?,?,?,?,?,?)";
                            $stmtinsert = $db->prepare($sql);
                            $result = $stmtinsert->execute([$adminid, $song,  $album, $artist,"no","no","no",$image]);
                            if($result)
                            {  
                                echo '<script>';
                                echo "alert('Song added successfully')";
                                echo '</script>';
                            }
                        }
                       
                    }
                }
            
                
            else if($category !="Albums")
            {
                if(!$album){
                $sql="INSERT into admin(song_name,song_added,song_category,admin_email,artist_name,song_image)values(?,?,?,?,?,?)";
                $stmtinsert = $db->prepare($sql);
                $result = $stmtinsert->execute([ $song, "yes", $category, $email,$artist,$image]);
                if($result)
                {
                
                        $sql = "select * from admin where admin_email = '".$email."' and song_name = '".$song."' ";
                        $result= mysqli_query($con,$sql);
                        $row=mysqli_fetch_array($result);
                        if($result)
                        {
                            $adminid = $row['admin_id'];
                        }
                        if($category=="Bollywood")
                        {
                                    $sql = "INSERT into category(admin_id,song_name,artist_name,bollywood,hollywood,spanish,song_image)values(?,?,?,?,?,?,?)";
                                    $stmtinsert = $db->prepare($sql);
                                    $result = $stmtinsert->execute([$adminid, $song, $artist,"yes","no","no",$image]);
                                    if($result)
                                    {  
                                        echo '<script>';
                                        echo "alert('Song added successfully')";
                                        echo '</script>';
                                    }
                        }
                        else if($category=="Hollywood")
                        {
                                    $sql = "INSERT into category(admin_id,song_name,artist_name,bollywood,hollywood,spanish,song_image)values(?,?,?,?,?,?,?)";
                                    $stmtinsert = $db->prepare($sql);
                                    $result = $stmtinsert->execute([$adminid, $song, $artist,"no","yes","no",$image]);
                                    if($result)
                                    {  
                                        echo '<script>';
                                        echo "alert('Song added successfully')";
                                        echo '</script>';
                                    }
                        }
                        else if($category=="Spanish")
                        {
                                    $sql = "INSERT into category(admin_id,song_name,artist_name,bollywood,hollywood,spanish,song_image)values(?,?,?,?,?,?,?)";
                                    $stmtinsert = $db->prepare($sql);
                                    $result = $stmtinsert->execute([$adminid, $song, $artist,"no","no","yes",$image]);
                                    if($result)
                                    {  
                                        echo '<script>';
                                        echo "alert('Song added successfully')";
                                        echo '</script>';
                                    }
                        }
                        else
                        {
                                    $sql = "INSERT into category(admin_id,song_name,artist_name,bollywood,hollywood,spanish,song_image)values(?,?,?,?,?,?,?)";
                                    $stmtinsert = $db->prepare($sql);
                                    $result = $stmtinsert->execute([$adminid, $song, $artist,"no","no","no",$image]);
                                    if($result)
                                    {  
                                        echo '<script>';
                                        echo "alert('Song added successfully')";
                                        echo '</script>';
                                    }
                        }
                }
                else
                {
                    echo '<script>';
                    echo "alert('Error')";
                    echo '</script>';
                }
            }
                else
                {
                    echo '<script>';
                        echo "alert('Choose category as album')";
                        echo '</script>';   
                }
            }
            
        }       
  
  ?>


    <?php

        $db_host="localhost";
        $db_user="root";
        $db_pass="";
        $db_name="project_4";

        $con = mysqli_connect($db_host,$db_user,$db_pass,$db_name);

       
    if(isset($_POST['delete']))
    {
        

        $email= $_SESSION['email'];
        $song = $_POST['song'];
        $album = $_POST['album'];
        $artist = $_POST['artist'];
        $image = $_POST['image'];
        $category = $_POST['category'];

        $sql = "select * from category where song_name = '".$song."' ";
        $result= mysqli_query($con,$sql);
        $row=mysqli_fetch_array($result);
        $count=mysqli_num_rows($result); 
        if($count==1)
        {
            $flag=0;
            if($category=="Bollywood")
            {
                if($row['bollywood'] !="yes")
                    {
                      echo '<script>';
                      echo "alert('Song not in Bollywood')";
                      echo '</script>';   
                    }
                else
                   $flag =1;
            }
            else if($category=="Hollywood")
            {
                if($row['hollywood']!="yes")
                  {                       
                     echo '<script>';
                    echo "alert('Song not in Hollywood')";
                    echo '</script>';   
                  }
                else
                    /*delete_song("hollywood");*/ $flag =1;
            }
            else if($category=="Spanish")
            {
                if($row['spanish']!="yes")
                  {
                    echo '<script>';
                   echo "alert('Song not in Spanish')";
                    echo '</script>';   
                  }
                else
                    /*delete_song("spanish");*/ $flag =1;
            }
            else if($category=="Albums")
            {
                if($album)
                {
                    if(!$row['album_name'])
                    {
                      echo '<script>';
                        echo "alert('Song not in album')";
                        echo '</script>';   
                    }
                    else
                        /*delete_song("album_name");*/ $flag = 1;
                }
                else
                {
                  echo '<script>';
                    echo "alert('Enter album name')";
                    echo '</script>';   

                }
            }
            else if($album)
            {
                if($category=="Albums")
                {
                    if($row['album_name']!="yes")
                      {
                        echo '<script>';
                        echo "alert('Song not in album')";
                        echo '</script>';   
                      }
                    else
                        /*delete_song("album");*/ $flag =1;
                }
                else
                {
                  echo '<script>';
                    echo "alert('Choose album as category in form')";
                    echo '</script>';   

                }
            }
            else
            {
                
                if($row['bollywood']=="no" && $row['hollywood']=="no" && $row['spanish'] =="no")
                {
                    /*if($row['hollywood']=="no")
                    {
                        if($row['spanish']=="no")*/
                           $flag =1;}
                        else
                        {
                          echo '<script>';
                            echo "alert('Song not in Artist')";  
                            echo '</script>';   
                        }
                    
                    
            }
        
            if($flag==1)
            {
                $sql="INSERT into admin(song_name,song_deleted,song_category,admin_email,artist_name,song_image)values(?,?,?,?,?,?)";
                $stmtinsert = $db->prepare($sql);
                $result = $stmtinsert->execute([ $song,"yes",$category,$email,$artist,$image]);
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
                        echo '<script>';
                        echo "alert('Song deleted succesfully')";
                        echo '</script>';   
                    }
                }
    
            }
        }
        else
        {
          echo '<script>';
            echo "alert('Song doesnot exist in the table')";
            echo '</script>';   

        }
       
    }

    

    ?>
   
   <div class="header">
    
    <div class="logo">
      <img src="menu.png" width="60px" height="70px">
    </div>


    <div class="premium">
    <button style='font-size:24px; cursor:pointer; outline:none;padding:10px; color:#d8d8d8;font-weight:bold;background:#282828; border:none;' name ="admin">Admin</button>
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
      <div class="side_style"><a href="regorlogin.php">About Us</a></div><br>
      <div class="side_style"><input type="button" class="log" value="Logout" onclick="document.getElementById('logout').style.display = 'block'"></div>
    </div>

    <div class="main">
      
      <form method="POST" class="modal-content">
          
      <div class="container">
        <label><b>Song Name </b><br>
        <input class="details" type="text" name="song"  placeholder="enter song name" autocomplete="off" required>
        </label>
        <br>
        <label><b>Album Name(if selected category is Album) </b><br>
        <input class="details" type="text" name="album"  placeholder="enter album name" autocomplete="off" >
        </label>  
        <br>

        <label><b>Artist Name</b><br>
          <input class="details" type="text" name="artist" placeholder="enter album name" autocomplete="off" required>
        </label>
        <br>

        <label><b>Song Image</b><br>
            <input class="details" name="image" type="text" placeholder="enter image name" autocomplete="off" required>
        </label>
        <br>
        
        <label><b>Category :</b>
			<input type="radio" name="category" value="Albums">Albums
			<input type="radio" name="category" value="Artists">Artists
            <input type="radio" name="category" value="Bollywood">Bollywood
            <input type="radio" name="category" value="Hollywood">Hollywood
			<input type="radio" name="category" value="Spanish">Spanish
      </label>
      <br>
      <br>
      
        <button type="submit" class="save"  name="add"  onClick="window.location.href=window.location.href">Add</button>
        <!--<button type="submit" class="cancel" name="delete">Delete</button>-->

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