
<style>
.oneProduct > div {
    text-align: center;
}
</style>
<?php

require "header.php";
require "connection.php";
$userId=$_SESSION['userId'];

$qry="select * from cart where clientId=$userId and done=0";
$result=$con->query($qry);
if($result->num_rows)
{
$cartId=$result->fetch_assoc()['cartId'];
$_SESSION['cartId']=$cartId;

$sql="select products.productId,description,productName,cover,qty,done from products,cartDetails,cart where done=0 and cartDetails.productId=products.productId and cart.clientId =  $userId and  cartDetails.cartId=$cartId";

$result=$con->query($sql);
$counts=$result->num_rows;
?>
<form action="checkout.php">
<div class="purchasedDiv" >
<div class="headerOneProduct">    
    <div> cover </div>
    <div style="flex-basis:70px;"><p> delete </p></div>
    <div style="flex-basis:120px;"><p>product name</p></div>
    <div style="flex-basis:70px;"><p>quantity</p></div>
    <div style="flex:1;"><p>description</p></div>
</div>    
<?php 
while($row=$result->fetch_assoc()){
?>
<form action="deleteFromBasket.php">
    <input type="hidden" name="productId" value="<?php echo $row['productId']?>">
<div class="oneProduct">

    <div>
    <?php if(empty($r["cover"]) || !file_exists("images/".$r["cover"])) { ?>
                        <img src="https://fakeimg.pl/1000x1000" alt="pic1" style="width:100%">
                        <?php } else {?>
                            <img src="images/<?php echo $r["cover"]?>" alt="pic1">

                        <?php 
                        
                        }?>
    </div>
    <div style="flex-basis:70px;text-align:center;cursor:pointer"><p><button><i class="fa-solid fa-trash"></i></button></p></div>
    <div style="flex-basis:100px;text-align:left"><p><?php echo $row['productName'] ?></p></div>
    <div style="flex-basis:70px;text-align:center"><p><?php echo $row['qty'] ?></p></div>
    <div style="flex:1;text-align:left"><p><?php echo $row['description'] ?></p></div>
    
</div>
                    </form>
<?PHP
}

?>


    <button style="background-color: rgb(0,60,120);width:100%;padding:10px;color:white;font-weight:900;text-transform:capitalise;font-size:20px"><i class="fas fa-shopping-cart"></i> check out</button>
</form>
</div>
<?php }  else echo "no item foud" ?>