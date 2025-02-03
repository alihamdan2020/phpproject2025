<?php
include "connection.php";
session_start();

$productId=$_GET['productId'];
$cartId=$_SESSION['cartId'];

$sql="delete from cartDetails where cartiD =$cartId and productId = $productId";
mysqli_query($con,$sql);
header("location:purchased.php");
?>