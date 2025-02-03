<?php

include "header.php";
include "connection.php";

$sql = "select * from products";
if(isset($_GET['txt'])){

$_SESSION['txt']=$_GET['txt'];
   $sql.=" where ProductName like '%" .  $_GET['txt'] . "%'";
}
$result = mysqli_query($con, $sql);
$products = mysqli_fetch_assoc($result);
?>

<div class="container">
    <img src="https://fakeimg.pl/100x100" alt="pic1">
    <!-- just for test -->
    <form action="">
    <label 
    style=  "display: block;
            font-weight:bold;
            margin-bottom:10px;
            text-transform:capitalise">Enter your product name</label>
    <input  type="text" 
            name="search" 
            onkeyup="location='index.php?txt=' + this.value" 
            style="padding: 5px;font-size:20px;outline:0"
            value=<?php if(isset($_SESSION['txt'])) echo $_SESSION['txt'] ?>>
    </form>
    <h1 style="text-transform: capitalize;text-align:center">to make a purchase you must log in first</h1>
    <table width="100%" border="1" cellspacing="0" cellpadding="0">
        <?php if(!isset($_SESSION['loggedin'])) {?>
        <caption>list of products</caption>
        <?php } else { ?>
            <a href="products.php" style="color:red;"><h1 style="font-size:40px;text-align: center;">list of products</h1></a>
            <?php } ?>
    <tr>
        <th>ProductName</th>
        <th>ProductId</th>
        <th>ProductPrice</th>
        <th>UnitsinStock</th>
        <th>total</th>
    </tr>
        <?php
        $total=0;
        // while ($row = $result->fetch_assoc()) {
        while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td>
                    <?php echo $row['ProductID'] ?></td>
                <td><?php echo $row['ProductName'] ?></td>
                <td align="center"><?php echo number_format($row['UnitPrice'],2) . " $ " ?></td>
                <td align="center"><?php echo $row['UnitsInStock'] ?></td>
                <td align="center"><?php echo $row['UnitsInStock'] * $row['UnitPrice'] . " $ "  ?></td>

            </tr>
        <?php  
        $total+=$row['UnitsInStock'] * $row['UnitPrice'];
        }    ?>
            <tr>
                <td colspan="5" align="right">
                    <b>
                        <?php echo number_format($total,2). " $ " ?></b></td>
            </tr>


    </table>
</div>

</body>

</html>