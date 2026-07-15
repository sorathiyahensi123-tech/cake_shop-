<?php
require_once('c:\xampp\htdocs\cakeshopping-main\online-cake-shop-master\onlinecakeshop\config.php');

$query = "SHOW COLUMNS FROM `cake_shop_orders` LIKE 'order_status'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    echo "Adding column order_status...\n";
    $alter = "ALTER TABLE `cake_shop_orders` ADD COLUMN `order_status` VARCHAR(50) DEFAULT 'Pending'";
    if (mysqli_query($conn, $alter)) {
        echo "Successfully added order_status column.\n";
    } else {
        echo "Error: " . mysqli_error($conn) . "\n";
    }
} else {
    echo "Column order_status already exists.\n";
}
?>
