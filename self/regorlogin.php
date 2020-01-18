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
    <title>Yo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>


* {box-sizing: border-box}
body 
{font-family: Verdana, sans-serif;
 margin:0;
 overflow: hidden;
 }
.mySlides {
  display: none;
  }


/* Slideshow container */
.slideshow-container {
  width: 100%;
  position: relative;
  margin: auto;
}

/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 40%;
  
  width: auto;
  padding: 16px;
  margin-top: -22px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
}

/* Caption text */
.text {
  color:  blue;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 300px;
  width: 100%;
  text-align: center;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .prev, .next,.text {font-size: 11px}
}
.btn
{

    border: none;
    height: 35px;
    width: 85px;
  color:white;
  background-color: black;
  margin: 15px 131px 10px;
  padding: 8px 27px 12px 15px;
  text-align: center;
  position:absolute;
     top:0;
     right:0;
  display: inline-block;
  border-radius: 1000000px;
  font-size: 17px;
  cursor: pointer;
}  
#line{
    position:absolute;
     top:0.05%;
     right:0;
     width:8px;
     height:5px;
     color: gray;
     transform: scale(1.75);
    margin: 15px 115px 10px;
} 
.btn1
{

    border: none;
    height: 35px;
    width: 85px;
  color:white;
  background-color: black;
  margin: 15px 25px 10px;
  padding: 8px 25px 12px 17px;
  text-align: center;
  position:absolute;
     top:0;
     right:0;
  display: inline-block;
  border-radius: 1000000px;
  font-size: 17px;
  cursor: pointer;
}
</style>
</head>
<body>
<!-- Slideshow container -->
<div class="slideshow-container">

  <!-- Full-width images with number and caption text -->
  <div class="mySlides fade">
    
    <img src="img1.jpeg" style="width:100%">
    <div class="text">Caption Text</div>
  </div>

  <div class="mySlides fade">
   
    <img src="img2.jpeg" style="width:100%">
    <div class="text">Caption Two</div>
  </div>

  <div class="mySlides fade">
    
    <img src="img1.jpeg" style="width:100%">
    <div class="text">Caption Three</div>
  </div>

  <!-- Next and previous buttons -->
  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
  <a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>
<br>


<form  method="POST">
		<div class="container">
		<div class="row">
			<div class="col-sm-3">
           
        <input class="btn" type="submit" id="register" name="reg" value="Sign up">
       <p id="line"><b>|</b> </p>
        <input class="btn1" type="submit" id="register" name="login" value="Sign in">
        </div>
        </div>
        </div>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

        <script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}
</script>


</body>
</html>
