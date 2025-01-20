<?php
session_start();
include "connection.php";
$user=$_POST['user'];
$pass=$_POST['pass'];
$sql="select * from users where userName = '$user' and password = '$pass'";

$result=mysqli_query($con,$sql);
$count=mysqli_num_rows($result);
if ($count===1){
    $_SESSION['loggedin']=mysqli_fetch_assoc($result)['userName'];
    header('location:products.php');
    die();
}
else{
    $_SESSION['msg']="user name already exist";
    $_SESSION['user']=$user;
    header('location:login.php');
}
?>