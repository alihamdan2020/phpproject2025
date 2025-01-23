<?php
include "connection.php";
include "header.php";
$sql = "SELECT * FROM Categories";
$categories = mysqli_query($con, $sql);
if (!isset($_SESSION['loggedin'])) {
    header("location:index.php");
}

// Get category ID and page number from URL parameters
$catId = isset($_GET['catId']) ? intval($_GET['catId']) : null;
$num = isset($_GET['num']) ? intval($_GET['num']) : 0;
$counter = $num * 10;

// SQL query to fetch products based on category and pagination
$sql = "SELECT categoryName, products.*, CompanyName, UnitPrice * UnitsOnOrder AS total
        FROM products
        INNER JOIN categories ON products.CategoryID = categories.CategoryID
        INNER JOIN suppliers ON products.supplierID = suppliers.supplierID";

if ($catId !== null && $catId!=0) {
    $sql .= " WHERE products.CategoryID = " . $catId;
}
if($catId==0)
{   $sql .= " WHERE 1=1 ";}

$sql .= " LIMIT " . $counter . ", 10";

$result = mysqli_query($con, $sql);

// SQL query to get the count of products for pagination
$sqlCount = "SELECT COUNT(*) AS totalProducts FROM products";
if ($catId !== null && $catId!=0) {
    $sqlCount .= " WHERE CategoryID = " . $catId;
}

if ($catId == 0) 
{$sqlCount .= " WHERE 1 = 1 ";}

$countResult = mysqli_query($con, $sqlCount);
$rowCount = mysqli_fetch_assoc($countResult);
$totalProducts = $rowCount['totalProducts'];
$perPage = ceil($totalProducts / 10);
?>

<body>
    <select onchange="location='products.php?catId=' + this.value">
        <option value="0">--- all products --</option>
        <?php while ($row = mysqli_fetch_assoc($categories)) { ?>
            <option value="<?php echo $row['CategoryID']; ?>" <?php if ($catId == $row['CategoryID']) echo 'selected'; ?>>
                <?php echo $row['CategoryName']; ?>
            </option>
        <?php } ?>
    </select>
    <div class="container">
        <div class="cardHolder">
            <?php while ($r = mysqli_fetch_assoc($result)) { ?>
                <div class="card">
                    <p style="background-color: rgb(0,60,120)">
                        <a href="#">Product # <?php echo $r['ProductID']; ?></a>
                    </p>
                    <p><?php echo $r['ProductName']; ?></p>
                    <p><?php echo $r['UnitPrice']; ?></p>
                    <p><?php echo $r['categoryName']; ?></p>
                    <p><?php echo $r['CompanyName']; ?></p>
                    <p><?php echo number_format($r['total'], 2) . "<span style='color:red'> $</span> "; ?></p>
                </div>
            <?php } ?>
        </div>
        <div style="display:grid;place-items:center">
            <ul class="pages">
                <?php for ($i = 0; $i < $perPage; $i++) { ?>
                    <li>
                        <a href="products.php?num=<?php echo $i; if ($catId !== null) echo '&catId=' . $catId; ?>">
                            <?php echo $i + 1; ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</body>
</html>
