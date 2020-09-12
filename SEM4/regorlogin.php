<?php

if(isset($_POST['reg']))
{
    header("location: registration.php");
}
else if(isset($_POST['login']))
{
    header("location: login.php");
}


?>

<html>
<head>
  
  <title>Main Page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="regorlogin.css" rel="stylesheet">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>

<body>
<style>
  /* Make the image fully responsive */
  body 
  {
    overflow-x:hidden;
    width:100%;
  }
  .carousel-inner img {
    width: 100%;
    height: 100%;
  }

  .overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0, .6);
  }
  .column {
    display:flex;
    flex-direction:column;
  width: 33.3%;
  margin-bottom: 16px;
  padding: 50px 8px;
  margin-left:210px;
}

.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  margin: 8px;

}
.container1 {
  padding: 0 16px;
}

.container1::after, .row::after {
  content: "";
  clear: both;
  display: table;
}

.title {
  color: grey;
}

.button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
}
h1,h2
{
  font-size: 40px;
  text-decoration:underline;
  color:rgba(199, 141, 33, 0.973);
  font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
  text-transform:capitalize;
}
.about-section p 
{
  font-size:20px;
}
.button:hover {
  background-color: #555;
}
.about-section {
  padding: 50px;
  text-align: center;
  background-color:wheat;
  color: black;
  height: 400px;
}
.card img
{
  height: 400px;
  width : 200px;
}
@media screen and (max-width: 650px) {
  .column {
    width: 100%;
    display: block;
  }
}

  </style>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark mod">
  <!-- Brand/logo -->
  <a  class="web_title" href="#">E-Music</a>
  
  <!-- Links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a class="nav-link" href="registration.php">Sign Up</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="login.php">Sign In</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#aboutus">About</a>
    </li>
  </ul>
</nav>

<div id="demo" class="carousel slide" data-ride="carousel">
  <!--<ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
  </ul>-->
  <div class="carousel-inner" style="position:relative;">
    <div class="carousel-item active">
    <p style="position:absolute;top:35%;left:23%;font-size:22px">"Music is a higher revelation than all wisdom and philosophy."</p>  
    <img src="images/slider_1.jpg" alt="Los Angeles" width="1100" height="300">
        
    </div>
    <div class="carousel-item">
    <p  style="position:absolute;top:40%;left:30%;font-size:22px">“Music expresses that which cannot be put into words"</p>
        <p  style="position:absolute;top:44%;left:30%;font-size:22px">and that which cannot remain silent.”</p>
      <img  src="images/slider_2.jpg" alt="Chicago" width="1100" height="500">
     
    </div>
  </div>
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>

<div class="about-section" id="aboutus">
  <h1>ABOUT US</h1><br>
  <p>This website provides users the
huge range of songs at a single platform </p><p>and a smooth and easy
listening experience to sound tracks.</p>
<p>Users are given the access to download the songs according to their wish and can maintain their own playlist.</p>
<p>Sole purpose behind the designing of "MUSIC MANAGEMENT SYSTEM" is to share </p>
<p>fascinating music with the fans and audience.</p>
</div>
<br><br>
<h2 style="text-align:center">OUR TEAM</h2>

    <div class="row">
      <div class="column">
      <div class="card">
    <img  src="images/akanksha.png" alt="Card image" style="width:100%"><br>
    <div class="container1">
      <h3>Akanksha Laddha</h3>
      <h5>1BM18CS007</h5>
      <p class="title">Team Member</p>
      <p><b>E-mail</b> : akanksha.cs18@bmsce.ac.in</p>
      <p><button class="button">Contact</button></p>    
      </div>
  </div>
      </div>

      <div class="column">
      <div class="card">
    <img  src="images/atharv.jpg" alt="Card image" style="width:100%"><br>
    <div class="container1">
      <h3>Atharv Arya</h3>
      <h5>1BM18CS020</h5>
      <p class="title">Team Member</p>
      <p><b>E-mail</b> : atharv.cs18@bmsce.ac.in</p>
      <p><button class="button">Contact</button></p>    
      </div>
  </div>
      </div>

    </div>

    <div class="footer">
    
    <div class="icons">
      <div class="social"><a href="#"><i class="fa fa-dropbox" title="Dropbox"></i></a></div>
      <div class="social"><a href="#"><i class="fa fa-facebook-square" title="Facebook"></i></a></div>
      <div class="social"><a href="#"><i class="fa fa-instagram" title="Instagram"></i></a></div>
      <div class="social"><a href="#"><i class="fa fa-twitter-square" title="Twitter"></i></a></div>
    </div>
     <br>
    <!-- <br>
    <br>  -->
    <div class="copyright" title="Copyright">© Music Management System, Inc.</div>
  
  </div> 
</body>
</html>
