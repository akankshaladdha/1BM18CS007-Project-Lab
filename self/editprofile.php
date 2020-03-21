
<?php
require_once("config.php");

?>

<html>
<head>
  <link rel="stylesheet" href="editprofile.css">
    <title>Edit Profile</title>
</head>

<body>
<div>
    <?php
    session_start();

    $db_host="localhost";
    $db_user="root";
    $db_pass="";
    $db_name="self";
    
    $con = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
    $email= $_SESSION['email'];
    $sql = " select * from login where email = '".$email."' limit 1";
    $result= mysqli_query($con,$sql);
    $row=mysqli_fetch_array($result);
    
    if(isset($_POST['save']))
    { 
        $fname1 = $_POST['fname'];
        $lname1 = $_POST['lname'];
        $email1 = $_POST['mail'];
        $phone1 = $_POST['phone'];
        $dob1 = $_POST['dob'];
       
        $sql = "UPDATE login SET lastname = '".$lname1."',firstname = '".$fname1."' ,phonenumber ='".$phone1."', datebirth = '".$dob1."' WHERE email= '".$email."' ";
        if(mysqli_query($con,$sql) == true)
        {
          $_SESSION['firstname']=$fname1;
          $_SESSION['lastname']=$lname1;
          $_SESSION['phonenumber']=$phone1;
          $_SESSION['datebirth']=$dob1;

          header('location:editprofile.php');
        
         
  }
  }
  
    ?>
   
      <div class="top">
        <h1>Hello <?php echo $_SESSION['firstname']; ?> <?php echo $_SESSION['lastname']; ?></h1>
      </div>

    <div class="modal">
             <form method="POST" class="modal-content">
          <div class="container">
     <label><b>Firstname  </b>
     <input type="text" name="fname" value="<?php echo $_SESSION['firstname']; ?>" placeholder="enter a new firstname" required>
</label>
<br>
<label><b>Lastname  </b>
     <input type="text" name="lname" value="<?php echo $_SESSION['lastname']; ?>" placeholder="enter a new lastname" required>
</label>
<br>


<label><b>Phone  </b>
     <input id="intTextBox" maxlength="10" name="phone" value="<?php if($row['phonenumber']){echo $row['phonenumber'];} ?>">
     <script>
function setInputFilter(textbox, inputFilter) {
  ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
    textbox.addEventListener(event, function() {
      if (inputFilter(this.value)) {
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      } else {
        this.value = "";
      }
    });
  });
}

setInputFilter(document.getElementById("intTextBox"), function(value) {
  return /^-?\d*$/.test(value); });
    </script>
</label>
<br>


<label><b>Date of birth  </b>
     <input name="dob" type="date" value="<?php echo $_SESSION['datebirth']; ?>" >
</label>
<br>
<button type="submit"  name="save"  onClick="window.location.href=window.location.href">Save</button>
<button type="reset" name="cancel" class="reset">Cancel</button>

</div>

<div class="bottom" style="background-color:#D0D0D0">
<p class="line"><a href="admin.php">Go back to listening music</a></p>
    </div>
</form>
</div>
</div>
</body>
</html>