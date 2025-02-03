<?php
session_start();
require __DIR__."/vendor/autoload.php";
$secret_key="sk_test_51Ma7n2I8fRgdwLJd4g81RwGNuhKBjNzW1zI3DMVWXImseIJKS8b4B3zgjyEYC3DTAo9O0spT2qv3hscRs47yyBVY00EEPUstSy";

\Stripe\Stripe::setApiKey($secret_key);

//that is mean in each check out create a session
//note that each key is reserved we can not change


include "connection.php";
$cartId=$_SESSION['cartId'];
$userId=$_SESSION['userId'];

$sql="select cart.cartId,productName,qty,UnitPrice from cart,cartdetails, products where cartdetails.productId=products.productId and cart.cartId=cartdetails.cartId and cart.cartId=$cartId and clientId = $userId";

$result=mysqli_query($con,$sql);
$line=[];
while($row=mysqli_fetch_assoc($result))
{
    $line[]    =
    
        [
            "quantity"      => (int) $row['qty'],
            "price_data"    => [
                "currency"  => "usd",
                "unit_amount" => ((int)$row['UnitPrice'])*100,
                "product_data" => ["name" => $row['productName']]
            ]
        ];
}

$checkout_session = \Stripe\Checkout\Session::create([
    "mode"          =>  "payment",
    "success_url"   =>  "http://localhost/phpproject/success.php",
    "line_items"    => $line,

]);



$cartId= $_SESSION['cartId'];
$sql="update cart set done=1 where cartId = $cartId";
if(mysqli_query($con,$sql))


header("Location: " . $checkout_session->url);
exit();

                            
//     // that is mean in each check out create a session //note that each key is reserved we can not change header("loaction".$checkout_session->url) what $checkout_session->url mean ?

http_response_code(303);
header("Location: " . $checkout_session->url);



?>