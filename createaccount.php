<?php
session_start();
include "connection.php";
$user=$_POST['user'];
$pass=$_POST['pass'];
$country=$_POST['country'];
//note that there is another way to make hashing for password, but sha is better than md5
$hashed=hash("sha256",$pass);

$sql="select * from users where userName = '$user'";

$result=mysqli_query($con,$sql);
$count=mysqli_num_rows($result);
if ($count===1){
    $_SESSION['msg']="user name already exist";
    $_SESSION['user']=$user;
    header('location:signup.php');
    die();
}
else{
    $sql="insert into users (userName,password,countryId) values ('$user','$hashed',$country)";
    if(mysqli_query($con,$sql))
    {
    $_SESSION['loggedin']=0;
    header('location:index.php');
    }
}
?>