<?php
require __DIR__."/vendor/autoload.php";
$secret_key="sk_test_51Ma7n2I8fRgdwLJd4g81RwGNuhKBjNzW1zI3DMVWXImseIJKS8b4B3zgjyEYC3DTAo9O0spT2qv3hscRs47yyBVY00EEPUstSy";

\Stripe\Stripe::setApiKey($secret_key);

//that is mean in each check out create a session
//note that each key is reserved we can not change



$checkout_session = \Stripe\Checkout\Session::create([
    "mode"          =>  "payment",
    "success_url"   =>  "http://localhost/phpproject/success.php",
    "line_items"    => [
        [
            "quantity"      => 1,
            "price_data"    => [
                "currency"  => "usd",
                "unit_amount" => 1300,
                "product_data" => ["name" => "Pepsi"]
            ]
        ]
    ]
]);

header("Location: " . $checkout_session->url);
exit();

                            
    //that is mean in each check out create a session //note that each key is reserved we can not change header("loaction".$checkout_session->url) what $checkout_session->url mean ?

http_response_code(303);
header("Location: " . $checkout_session->url);



?>