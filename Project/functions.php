<?php  include "database.php"; ?>

<?php 

function createRow() {
    global $connection;
    $username = $_POST['username'];
    $password = $_POST['password'] ;
    $cpassword = $_POST['cpassword'];
    $type = $_POST['bs'];
    
    if($password != $cpassword)
    {
        return -1;
    }
    
    $username = mysqli_real_escape_string($connection, $username);
    
    $password = mysqli_real_escape_string($connection, $password);   
    
    echo $password;
    
    if($type == '0')
    {
        echo "inserting";
        
        $query = "INSERT INTO users(username,password,type)";
        $query .= "VALUES ('$username','$password','buyer')";
    }
    else {
        $query = "INSERT INTO users(username,password,type)";
        $query .= "VALUES ('$username','$password','seller')";
    }
    
    $result = mysqli_query($connection, $query);
    
    if(!$result) {
        die('Query failed'. mysqli_error($connection));
    }
    
    return 1;
}

function login() {
    global $connection;
    
    $username = $_POST['username'];
    $password = $_POST['password'] ;
    
    $query = "SELECT * FROM users ";
    $query.= "WHERE username='$username' AND password='$password' ";
    
    
    $result = mysqli_query($connection, $query);
    
    $row_count = mysqli_num_rows($result);
    
    if($row_count == 0)
    {
        return -1;
    }
    else {
        $row = mysqli_fetch_assoc($result);
        $type = $row['type'];
        $user = array(
            "username" => $username,
            "type" => $type
        );
        setcookie("user", json_encode($user),time()+3600,'/');
        return $type; 
    }
}


function updateTable() {
    
     global $connection;
        
      $username = $_POST['username'];
      $password = $_POST['password'] ; 
      $id = $_POST['id'];  
  

$query = "UPDATE users SET ";
$query .= "username = '$username', ";
$query .= "password = '$password' ";
$query .= "WHERE id = '$id'";

 $result = mysqli_query($connection, $query);
 if(!$result) {
     die("query failed");
 }

}

  
function deleteRow() {
    global $connection;
         
    $id = $_POST['id'];  
  

$query = "DELETE FROM users ";
$query .= "WHERE id = $id ";

 $result = mysqli_query($connection, $query);
 if(!$result) {
     die("query failed");
 }
}
?>  