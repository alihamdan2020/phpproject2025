<?php
session_start();
include "connection.php";
$user=$_POST['user'];
$pass=$_POST['pass'];
$hashed=hash("sha256",$pass);

$sql="select * from users where userName = '$user' and password = '$hashed'";

$result=mysqli_query($con,$sql);
$count=mysqli_num_rows($result);
if ($count===1){
    $_SESSION['loggedin']=mysqli_fetch_assoc($result)['userName'];
    header('location:products.php');
    die();
}
else{
    $_SESSION['msg']="user name or password is wrong";
    $_SESSION['user']=$user;
    header('location:login.php');
}
?>