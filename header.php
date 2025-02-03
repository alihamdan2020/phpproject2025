<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index page</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <?php
    session_start();
    include "connection.php";
    $numOfItems = 0;
    if (isset($_SESSION['userId'])) {
        $sql = "SELECT cart.cartId,productId,qty,clientId,done from cart INNER JOIN cartdetails on cart.cartId=cartdetails.cartId where done=0 and  clientId=" . $_SESSION['userId'];
        $result = mysqli_query($con, $sql);
        $numOfItems = mysqli_num_rows($result);
    }

    ?>
</head>

<body>
    <header>
        <h1><a href="index.php">my company</a></h1>
        <div class="links">

            <?php
            if (isset($_SESSION['loggedin'])) { ?>
                <a href="logout.php">logout</a>
                <a href="customers.php">customers</a>
                <a href="teststripe.php">test stripe</a>
                <a href="https://buy.stripe.com/test_bIY8xW9ZK7Lx8uYcMM">test</a>

                <div class="basket">
                    <span><?php echo $numOfItems ?></span>
                    <a href="purchased.php" style="margin-left:0"><i class="fa-solid fa-basket-shopping"></i></a>
                </div>

                <p style="color:white;">Welcom <b><?php echo $_SESSION['loggedin'] ?></b></p>
            <?php
            } else { ?><a href="login.php">log in</a> <?php } ?>
        </div>

    </header>