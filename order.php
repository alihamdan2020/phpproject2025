<?php
include "connection.php";
include "header.php";

// $sql="select * from orders where CustomerID ='" .  $_GET['custID'] . "'";
// $rsOrders=mysqli_query($con,$sql);

$sql = "SELECT CustomerId,orders.OrderID, orders.OrderDate,  SUM(UnitPrice * Quantity) AS TotalAmount
            FROM orders
            JOIN orderdetails ON orders.OrderID = orderdetails.OrderID
            GROUP BY orders.OrderID, CustomerID, OrderDate having CustomerID ='" . $_GET['custID'] . "'";

$rsOrders = mysqli_query($con, $sql);

?>

<div class="container">
    <table border="1" cellspacing="0" cellpadding="0" width="100%">
        <tr>
            <th>order Id</th>
            <th>order date</th>
            <th>total</th>
        </tr>

        <?php
        $tot = 0;
        while ($row = mysqli_fetch_assoc($rsOrders)) {
            $myDate = new DateTime($row['OrderDate']);
        ?>
            <tr>
                <td align="center" style="background-color: orange;"><a href="orderdetails.php?odetail=<?php echo $row['OrderID'] ?>"><?php echo $row['OrderID'] ?></a></td>
                <td align="center"><?php echo date_format($myDate, "D-M-Y"); ?></td>
                <!-- not like access d return digit of day , D three letter of day  -->
                <!-- not like access m return digit of month , M three letter of day  -->
                <!-- not like access y return 2 digit of yeaeer , Y 4 digit of year  -->
                <td align="center"> <?php echo number_format($row['TotalAmount'], 2) . " $ " ?></td>
            </tr>
        <?php
            $tot += $row['TotalAmount'];
        } ?>
    <tr>
        <td colspan="2" align="center"><b>Total</td>
        <td  align="center"><b><?php echo number_format($tot, 2) . " $ " ?></td></b>
    </tr>
    </table>
</div>