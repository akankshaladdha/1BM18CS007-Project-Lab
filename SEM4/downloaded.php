<?php

session_start();
require_once('config.php');

$db_host="localhost";
$db_user="root";
$db_pass="";
$db_name="project_4";

$con = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
      
$x = $_POST["a"];
$email = $_SESSION['email'];

$sql = "select * from category where song_name = '".$x."' ";
$result= mysqli_query($con,$sql);
$row=mysqli_fetch_array($result);
$count=mysqli_num_rows($result); 
    
$catid = $row['category_id'];

$sql = "select * from premium where premium_email = '".$email."' ";
$result= mysqli_query($con,$sql);
$row=mysqli_fetch_array($result);
$count=mysqli_num_rows($result); 
if($count==1)
{
    $premid = $row['premium_id'];
}

$sql = "select * from liked where song_name = '".$x."' and liked_email = '".$email."' ";
$result= mysqli_query($con,$sql);
$row=mysqli_fetch_array($result);
$count=mysqli_num_rows($result); 

if($count ==1)
{
    $downcount = $row['downloaded'];
    $down_count = $downcount + 1;
     
    $sql = "UPDATE liked set downloaded = '".$down_count."', premium_id = '".$premid."' , category_id = '".$catid."' where song_name = '".$x."' and liked_email = '".$email."' ";
    if(mysqli_query($con,$sql))
        {
            header('location:admin.php');
        }
}
else
{
    
    $sql = "INSERT into liked(liked_email,premium_id,category_id)values(?,?,?)";
    $stmtinsert = $db->prepare($sql);
    $result = $stmtinsert->execute([ $email,$premid,$catid]);
    if($result)
    {
        header('location:admin.php');
    }
}

?>