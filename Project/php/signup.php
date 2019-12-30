<?php include "functions.php"; ?>

<?php

echo $_POST['submit'];

if(isset($_POST['submit'])) {    
    $result = createRow();
}     
?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Sign in/Sign up</title>
  <link rel="stylesheet" type="text/css" href="navstyle.css">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:600'>
      <link rel="stylesheet" type="text/css" href="signstyle.css">
  
</head>
<body>
    <header>
        <div class="logo">BOOK PLANET</div>
        
        
        <nav>
            
            <ul>
                
                <li><a href="navbar.html">Home</a></li>
                <li><a href="buy.html">Buy</a></li>
                <li><a href="test.html">Sell</a></li>
                <li><a href="cart.html">
                <img src="shopping-cart.png" style="width:22px;height:22px;position:relative;left:-10px;"></a>
              </li>
                <li><a href="logsign1.html" class="active">Signin/Signup</a></li>

            </ul>
        </nav>
        <div class="menu-toggle"><i class="fa fa-bars" aria-hidden="true"></i></div>
    </header>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        $('.menu-toggle').click(function(){
            $('nav').toggleClass('active')
        })
    })

    
    </script>
    <br><br><br><br>
  <div class="login-wrap" style="position:relative;">
        
  <div class="login-html" style="position:relative">
   <?php 
        if($result == -1)
        {
            echo "<p style='color:white;position:absolute;top:20px;left:20px;'>Passwords did not match.Please try again.</p>";
        }
        if($result == 1)
        {
            echo "<p style='color:white;position:absolute;top:20px;left:20px;'>You have succesfully signed up.Sign in to continue</p>";
        }
        
    ?>        
    <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
    <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
    <div class="login-form">
      <form class="sign-in-htm" action="./login.php" method="POST">
        <div class="group">
          <label for="user" class="label">Username</label>
          <input id="username" name="username" type="text" class="input" required>
        </div>
        <div class="group">
          <label for="pass" class="label">Password</label>
          <input id="password" name="password" type="password" class="input" data-type="password" required>
        </div>
        <div class="group">
          <input id="check" type="checkbox" class="check" checked>
          <label for="check"><span class="icon"></span> Keep me Signed in</label>
        </div>
        <div class="group">
          <input type="submit" name="submit" class="button" value="Sign In">
        </div>
        <div class="hr"></div>
        <div class="foot-lnk">
          <a href="#forgot">Forgot Password?</a>
        </div>
      </form>
      <form class="sign-up-htm" action="./signup.php" method="POST">
        <div class="group">
          <label for="user" class="label">Username</label>
          <input id="username" name="username" type="text" class="input" required>
        </div>
        <div class="group">
          <label for="pass" class="label">Password</label>
          <input id="password" name="password" type="password" class="input" data-type="password" required>
        </div>
        <div class="group">
          <label for="pass" class="label">Confirm Password</label>
          <input id="pass" type="password" name="cpassword" class="input" data-type="password" required>
        </div>
        <div class="custom-control custom-radio" style="margin: 25px 0 15px 0;color:papayawhip;">
          <input type="radio" class="custom-control-input" id="buyer" name="bs" value="0" checked>
          <label class="custom-control-label" for="buyer">Register as Buyer</label>
        </div>
        <div class="custom-control custom-radio" style="margin: 10px 0;color:papayawhip;">
          <input type="radio" class="custom-control-input" id="seller" name="bs" value="1">
          <label class="custom-control-label" for="seller">Register as seller</label>
        </div>
        <div class="group" style="margin-top: 25px">
          <input type="submit" class="button" value="Sign Up">
        </div>
        <div class="hr"></div>
        <div class="foot-lnk">
          <label for="tab-1">Already Member?</a>
        </div>
      </form>
    </div>
  </div>
</div>
  
  
</body>
</html>