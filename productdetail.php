<?php 
include "header.php";
include "connection.php";

$pid=$_GET['productId'];
$sql="select * from products where productID = $pid";
$result=mysqli_query($con,$sql);
?>
<div class="container">
<?php
while($r=mysqli_fetch_assoc($result)){ ?>
<form action="createCard.php?">
<input type="hidden" value="<?php echo $r["ProductID"]?>" name="productId">
<div class="productCard"  style="display: flex;height: 600px;">
    <div class="image" style="flex-basis:350px;display:flex;align-items:center">
    <?php if(empty($r["cover"]) || !file_exists("images/".$r["cover"])) { ?>
                        <img src="https://fakeimg.pl/1000x1000" alt="pic1" style="width:100%">
                        <?php } else {?>
                            <img src="images/<?php echo $r["cover"]?>" alt="pic1">

                        <?php 
                        
                        }?>
    </div>
    <div class="detail" style="display:flex;align-items:flex-start;flex-direction:column; justify-content:center;gap : 20px;padding-left:50px">
        <h1><?php echo $r["ProductName"] ?></h1>
        <p><?php echo $r["description"] ?></p>
        <p style="font-size:20px;color:red"><?php echo number_format($r["UnitPrice"],2) . " $" ?></p>
        <div style="display:flex;justify-content:space-between;border:0px solid green;">
            <button type="submit">add to cart</button>
            <input type="number" name="qty" id="" value=1 min="1" max="10" style="margin-left: 20px;">
        </div>
        <a href="products.php">return</a>
    </div>
</div>
</form>
<?php } ?>
</div>