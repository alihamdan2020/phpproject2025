<?php
include "connection.php";
include "header.php";

$sql="select * from customers";
$reCustomers=mysqli_query($con,$sql);
?>

<div class="container">
    <table border="1" cellspacing="0" cellpadding="0" width="100%">
        <tr>
            <th>customer Id</th>
            <th>customer Name</th>
            <th>contact Name</th>
            <th>phone</th>
        </tr>

        <?php while($row=mysqli_fetch_assoc($reCustomers)) { ?>
        <tr>
        <td><a style="color:orange" href="order.php?custID=<?php echo $row['CustomerID'] ?>"><?php echo $row['CustomerID'] ?></a></td>
        <td><?php echo $row['CompanyName'] ?></a></td>
        <td><?php echo $row['ContactName'] ?></a></td>
        <td><?php echo $row['Phone'] ?></a></td>
        </tr>
        <?php } ?>

    </table>
</div>