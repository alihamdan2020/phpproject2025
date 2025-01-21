<?php
include "connection.php";
include "header.php";
if (!isset($_SESSION['loggedin']))
header("location:index.php");
?>

<body>
    <div class="container">
        <div class="cardHolder">
            <?php
            if(isset($_GET['num'])){
                $counter=$_GET['num']*10;
                }
                else
                $counter=0;	

            $sql =  "select categoryName,products.*, CompanyName, UnitPrice*UnitsOnOrder as total
                     from products
                     inner join categories
                     on products.categoryID=categories.categoryID
                     inner join suppliers
                     on products.supplierID=suppliers.supplierID
                     limit $counter,10";
            $result = mysqli_query($con, $sql);

            $sqlAllProducts="select * from products";
            $CountOfRows=mysqli_num_rows(mysqli_query($con,$sqlAllProducts));

            $perPage=ceil($CountOfRows/10);
			
			// print_r(json_encode(mysqli_fetch_all(mysqli_query($con,$sqlAllProducts))));	
			
            while ($r = mysqli_fetch_assoc($result)) { ?>
                <div class="card">
                 <p style="background-color: rgb(0,60,120)"><a href="#">Product # <?php echo $r['ProductID'] ?></a></p>
                 <p><?php echo $r['ProductName'] ?></p>
                 <p><?php echo $r['UnitPrice'] ?></p>
                 <p><?php echo $r['categoryName'] ?></p>
                 <p><?php echo $r['CompanyName'] ?></p>
                 <p><?php echo number_format($r['total'],2) . "<span style='color:red'> $</span> " ?></p>
                </div>
            <?php } ?>
        </div>
        <div style="display:grid;place-items:center">
            <ul class="pages">
            <?php for($i=0;$i<$perPage;$i++) {?>
                <li><a href="products.php?num=<?php echo $i ?>"><?php echo $i+1 ?></a></li>
            <?php } ?>
            </UL>
        </div>
    </div>
</body>

</html>