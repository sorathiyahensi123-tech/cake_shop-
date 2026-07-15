<?php
require_once('c:\xampp\htdocs\cakeshopping-main\online-cake-shop-master\onlinecakeshop\config.php');

$query = "CREATE TABLE IF NOT EXISTS `cake_shop_messages` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message_body` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

if (mysqli_query($conn, $query)) {
    echo "Successfully created cake_shop_messages table.\n";
} else {
    echo "Error: " . mysqli_error($conn) . "\n";
}
?>
