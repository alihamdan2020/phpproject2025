<?php
session_start();
include "connection.php";
$userId=$_SESSION['userId'];
$productId=$_GET['productId'];
$qty=$_GET['qty'];

$sql="select * from cart where clientId = $userId and done=0";
//mean give me all of the client record where his basket still open or not check out yet
$result=mysqli_query($con,$sql);


//if no opene basket, all his basket are payed
if(mysqli_num_rows($result)==0){
$sql="insert into cart (clientId) values ($userId)";
mysqli_query($con,$sql);
//create for him a new record, or new purchase

$newsql="select * from cart where clientId=$userId and done=0";
$result=mysqli_query($con,$newsql);
$row=mysqli_fetch_assoc($result);
$cartId=$row['cartId'];
$_SESSION['cartId']=$cartId;

$sql="insert into cartDetails (cartId,productId,qty) values ($cartId,$productId,$qty)";
//in additional to create new record (purchase) i want to add the product that he purchase it with qty
mysqli_query($con,$sql);
header("location:products.php");
die();
}
else
{
    $newsql="select * from cart where clientId=$userId and done=0";
    $result=mysqli_query($con,$newsql);
    $row=mysqli_fetch_assoc($result);
    $cartId=$row['cartId'];
    $_SESSION['cartId']=$cartId;

    $checkProduct="select * from cartDetails where cartId=$cartId and ProductId =   $productId";
    $productExist=mysqli_num_rows(mysqli_query($con,$checkProduct));
    if($productExist==0)
    {
    $sql="insert into cartDetails (cartId,productId,qty) values ($cartId,$productId,$qty)";
    //in additional to create new record (purchase) i want to add the product that he purchase it with qty
    mysqli_query($con,$sql); 
    }
    else
    {
    $sql="update cartDetails set qty =$qty  where CartId=$cartId and productId = $productId";
    mysqli_query($con,$sql);
    }
    header("location:products.php");
    die();
}
header("location:index.php");


?>