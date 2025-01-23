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
    <form action="">
    <input type="text" name="search" id="" onkeyup="location='index.php?txt=' + this.value" 
    value=<?php if(isset($_SESSION['txt'])) echo $_SESSION['txt'] ?>>
    </form>
    <table width="100%" border="1" cellspacing="0" cellpadding="0">
    <tr>
        <th>ProductName</th>
        <th>ProductId</th>
        <th>ProductPrice</th>
        <th>UnitsinStock</th>
        <th>total</th>
    </tr>
        <?php
        $total=0;
        while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['ProductID'] ?></td>
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