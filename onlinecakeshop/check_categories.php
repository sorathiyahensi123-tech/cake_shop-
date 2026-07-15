<?php
require_once('c:/xampp/htdocs/cakeshopping-main/online-cake-shop-master/onlinecakeshop/config.php');

$query = "SELECT product_category, COUNT(*) as count FROM cake_shop_product GROUP BY product_category";
$result = mysqli_query($conn, $query);
echo "Product Counts by Category:\n";
while ($row = mysqli_fetch_assoc($result)) {
    echo "Category ID " . $row['product_category'] . ": " . $row['count'] . " products\n";
}

$query2 = "SELECT category_id, category_name FROM cake_shop_category";
$result2 = mysqli_query($conn, $query2);
echo "\nCategory Names:\n";
while ($row = mysqli_fetch_assoc($result2)) {
    echo "ID " . $row['category_id'] . " - " . $row['category_name'] . "\n";
}
?>
