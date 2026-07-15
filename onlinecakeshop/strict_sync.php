<?php
require_once('config.php');

// TRUNCATE tables to start fresh as per request "remove existing"
// WARNING: This deletes all products and categories!
mysqli_query($conn, "SET foreign_key_checks = 0");
mysqli_query($conn, "TRUNCATE TABLE cake_shop_product");
mysqli_query($conn, "TRUNCATE TABLE cake_shop_category");
mysqli_query($conn, "SET foreign_key_checks = 1");

$base_dir = __DIR__ . '/uploads/';
$folders = glob($base_dir . '*', GLOB_ONLYDIR);

if (!$folders) {
    die("No folders found in uploads/");
}

foreach ($folders as $folder_path) {
    $folder_name = basename($folder_path);
    // Decode URL-encoded characters if any (though usually filesystem handles this)
    $category_name = ucfirst(str_replace('_', ' ', $folder_name));
    
    echo "Processing Category: $category_name\n";

    // 1. Find images in this folder
    $images = glob($folder_path . '/*.{jpg,jpeg,png,webp,gif}', GLOB_BRACE);
    
    if (empty($images)) {
        echo "  - No images found, skipping.\n";
        continue;
    }

    // 2. Pick first image as Category Image/Banner
    // We need relative path for DB: e.g. "Birthday cake/1.jpg"
    $first_image_full = $images[0];
    $first_image_rel = $folder_name . '/' . basename($first_image_full);

    // 3. Insert Category
    // Escape strings for safety
    $safe_cat_name = mysqli_real_escape_string($conn, $category_name);
    $safe_cat_img = mysqli_real_escape_string($conn, $first_image_rel);

    $sql_cat = "INSERT INTO cake_shop_category (category_name, category_image) VALUES ('$safe_cat_name', '$safe_cat_img')";
    
    if (mysqli_query($conn, $sql_cat)) {
        $cat_id = mysqli_insert_id($conn);
        echo "  - Created Category ID: $cat_id\n";
        
        // 4. Insert Products
        foreach ($images as $img_path) {
            $img_name = basename($img_path);
            $img_rel_path = $folder_name . '/' . $img_name;
            
            // Generate some dummy data based on filename or defaults
            $prod_name = $category_name . ' - ' . pathinfo($img_name, PATHINFO_FILENAME);
            $prod_desc = "Delicious $category_name made with love.";
            $price = rand(300, 1500); // Random price between 300 and 1500
            
            $safe_prod_name = mysqli_real_escape_string($conn, $prod_name);
            $safe_prod_desc = mysqli_real_escape_string($conn, $prod_desc);
            $safe_prod_img = mysqli_real_escape_string($conn, $img_rel_path);

            $sql_prod = "INSERT INTO cake_shop_product (product_name, product_category, product_price, product_description, product_image) 
                         VALUES ('$safe_prod_name', '$cat_id', '$price', '$safe_prod_desc', '$safe_prod_img')";
            
            if (mysqli_query($conn, $sql_prod)) {
                echo "    + Added Product: $prod_name\n";
            } else {
                echo "    ! Error adding product: " . mysqli_error($conn) . "\n";
            }
        }
    } else {
        echo "  ! Error creating category: " . mysqli_error($conn) . "\n";
    }
}
echo "Sync Completed!";
?>
