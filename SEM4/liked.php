<?php

session_start();
require_once('config.php');

$db_host="localhost";
$db_user="root";
$db_pass="";
$db_name="project_4";

$con = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
      
$x = $_POST["a"];
$class_name = $_POST["b"];
$email = $_SESSION['email'];

echo $x;
echo $class_name;
echo $email;

if($class_name == "old")
{
    $sql = "select * from category where song_name = '".$x."' ";
    $result= mysqli_query($con,$sql);
    $row=mysqli_fetch_array($result);
    $count=mysqli_num_rows($result); 
    
    if($count==1)
    {
        $catid = $row['category_id'];
        $album = $row['album_name'];
        $artist = $row['artist_name'];
        $image = $row['song_image'];
    }


    $sql = "select * from premium where premium_email = '".$email."' ";
    $result= mysqli_query($con,$sql);
    $row=mysqli_fetch_array($result);
    $count=mysqli_num_rows($result); 
    if($count==1)
    {
        $premid = $row['premium_id'];
    }

    $sql = "select * from liked where category_id = '".$catid."' and liked_email = '".$email."' ";
    $result= mysqli_query($con,$sql);
    $row=mysqli_fetch_array($result);
    $count=mysqli_num_rows($result); 
    if($count== 1)
    {
        $sql = "UPDATE liked set song_name = '".$x."', album_name = '".$album."' , artist_name = '".$artist."' , song_image = '".$image."' where category_id = '".$catid."' and liked_email ='".$email."' ";
        if(mysqli_query($con,$sql))
        {
            echo 'Song added successfully';
        }
        
    }
    else
    {
        $sql ="INSERT into liked(song_name,album_name,artist_name,liked_email,song_image)values(?,?,?,?,?)";
        $stmtinsert = $db->prepare($sql);
        $result = $stmtinsert->execute([$x,$album,$artist, $email,$image]);
        if($result)
        {
            header('location:admin.php');
        }
    }
    
}
if($class_name == "new")
{
    $sql = "delete from liked where song_name = '".$x."' and liked_email ='".$email."' ";
    $result= mysqli_query($con,$sql);
    if($result)
        {
            header('location:admin.php');
           
        }
}

?>