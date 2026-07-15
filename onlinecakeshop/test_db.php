<?php
require_once('config.php');

$query = "DESCRIBE cake_shop_orders";
$result = mysqli_query($conn, $query);
if ($result) {
    while($row = mysqli_fetch_assoc($result)) {
        print_r($row);
    }
} else {
    echo "Error describing cake_shop_orders: " . mysqli_error($conn) . "\n";
}

$query = "DESCRIBE cake_shop_orders_detail";
$result = mysqli_query($conn, $query);
if ($result) {
    while($row = mysqli_fetch_assoc($result)) {
        print_r($row);
    }
} else {
    echo "Error describing cake_shop_orders_detail: " . mysqli_error($conn) . "\n";
}
?>
