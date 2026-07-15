<?php
require_once('c:/xampp/htdocs/cakeshopping-main/online-cake-shop-master/onlinecakeshop/config.php');

// Define the new categories
$categories = [
    7, // Birthday
    8, // Wedding
    9, // Party
    10, // Premium
    11, // Chocolate
    5 // Pastries (existing)
];

// Get all product IDs
$query = "SELECT product_id FROM cake_shop_product";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    // Randomly pick a category
    $random_cat = $categories[array_rand($categories)];
    $pid = $row['product_id'];
    
    // Update the product
    $update = "UPDATE cake_shop_product SET product_category = $random_cat WHERE product_id = $pid";
    mysqli_query($conn, $update);
    echo "Updated Product $pid to Category $random_cat\n";
}
echo "All products updated with random new categories.\n";
?>
