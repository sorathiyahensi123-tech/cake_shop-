<?php
require 'config.php';

// Add name_on_cake to invoice_item
$sql = "ALTER TABLE invoice_item ADD COLUMN name_on_cake VARCHAR(255) NULL DEFAULT ''";
if (mysqli_query($conn, $sql)) {
    echo "Added name_on_cake to invoice_item\n";
} else {
    echo "Error or already exists: " . mysqli_error($conn) . "\n";
}

// Add name_on_cake to cake_shop_orders_detail
$sql2 = "ALTER TABLE cake_shop_orders_detail ADD COLUMN name_on_cake VARCHAR(255) NULL DEFAULT ''";
if (mysqli_query($conn, $sql2)) {
    echo "Added name_on_cake to cake_shop_orders_detail\n";
} else {
    echo "Error or already exists: " . mysqli_error($conn) . "\n";
}

echo "Done.";
?>
