
<?php
require_once("config.php");
session_start();

?>

<html>
<head>
    <title>Edit Profile</title>
</head>

<body>
<div>
    <?php
    $db_host="localhost";
    $db_user="root";
    $db_pass="";
    $db_name="self";
    
    $con = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
    $first=$_SESSION['firstname'];
    $sql = " select * from login where firstname = '".$first."' limit 1";
    $result= mysqli_query($con,$sql);
    $row=mysqli_fetch_array($result);
    
   
    
    if(isset($_POST['save']))
    { 
        $fname1 = $_POST['fname'];
        $lname1 = $_POST['lname'];
        $email1 = $_POST['mail'];
        $phone1 = $_POST['phone'];
        $dob1 = $_POST['dob'];
       
       if(isset($_POST['phone'])) {
        {
                $sql = "UPDATE login SET phonenumber ='".$phone1."' WHERE firstname= '". $first."' ";
                
        
        }
        
    }
        /*if(isset($_POST['dob'])){
        
                $dob2 = TO_DATE('$dob1','DD/MM/YYYY') ;   
                $sql = "UPDATE login SET datebirth ='".$dob2."' WHERE firstname= '". $first."' ";
        }*/
        $sql = "UPDATE login SET lastname = '".$lname1."', email = '".$email1."' , firstname = '".$fname1."' WHERE firstname= '". $first."' ";
        if(mysqli_query($con,$sql) == true){

        echo 'Details are updated';
        header('location: editprofile.php');

        }
    }
    
    ?>
    <h1>Hello <?php echo $row['firstname']; ?> <?php echo $row['lastname']; ?></h1>
    <br><br><br>
    <div class="profile">
        <form method="POST">
     <label><b>Firstname : </b>
     <input type="text" name="fname" value="<?php echo $row['firstname']; ?>" placeholder="enter a new firstname" required>
</label>
<br><br>
<label><b>Lastname : </b>
     <input type="text" name="lname" value="<?php echo $row['lastname']; ?>" placeholder="enter a new lastname" required>
</label>
<br><br>
<label><b>Email : </b>
     <input type="email" name="mail" value="<?php echo $row['email']; ?>" placeholder="enter a new email id" required>
</label>
<br><br>


<label><b>Phone : </b>
     <input id="intTextBox" maxlength="10" name="phone" value="<?php echo $row['phonenumber']; ?>">
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
<br><br>


<label><b>Date of birth : </b>
     <input name="dob" type="date">
</label>
<br><br>

<button type="submit"  name="save"  onClick="window.location.href=window.location.href">Save</button>
<input type="reset" value="Cancel" name="cancel">
<a href="admin.php">Go back to listening music</a>
</form>
</div>
</div>
</body>
</html>