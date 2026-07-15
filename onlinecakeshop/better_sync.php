<?php
require_once('config.php');

mysqli_query($conn, "SET foreign_key_checks = 0");
mysqli_query($conn, "TRUNCATE TABLE cake_shop_product");
mysqli_query($conn, "TRUNCATE TABLE cake_shop_category");
mysqli_query($conn, "SET foreign_key_checks = 1");

$base_dir = __DIR__ . '/uploads/';
$folders = glob($base_dir . '*', GLOB_ONLYDIR);

if (!$folders) {
    die("No folders found in uploads/");
}

$adjectives = ['Premium', 'Classic', 'Royal', 'Signature', 'Deluxe', 'Artisan', 'Exquisite', 'Decadent', 'Heavenly', 'Supreme'];
$flavors = ['Chocolate', 'Vanilla', 'Red Velvet', 'Black Forest', 'Strawberry', 'Butterscotch', 'Pineapple', 'Mango', 'Blueberry', 'Hazelnut', 'Caramel'];
$types = ['Truffle', 'Gateau', 'Sponge', 'Cheesecake', 'Fondant', 'Mousse', 'Cream', 'Delight'];
$prices = [499, 549, 599, 649, 699, 749, 799, 849, 899, 949, 999, 1099, 1199, 1299, 1499, 1899, 2199];

foreach ($folders as $folder_path) {
    $folder_name = basename($folder_path);
    $category_name = ucfirst(str_replace('_', ' ', $folder_name));
    
    echo "Processing Category: $category_name\n";

    $images = glob($folder_path . '/*.{jpg,jpeg,png,webp,gif}', GLOB_BRACE);
    
    if (empty($images)) {
        continue;
    }

    $first_image_full = $images[0];
    $first_image_rel = $folder_name . '/' . basename($first_image_full);

    $safe_cat_name = mysqli_real_escape_string($conn, $category_name);
    $safe_cat_img = mysqli_real_escape_string($conn, $first_image_rel);

    $sql_cat = "INSERT INTO cake_shop_category (category_name, category_image) VALUES ('$safe_cat_name', '$safe_cat_img')";
    
    if (mysqli_query($conn, $sql_cat)) {
        $cat_id = mysqli_insert_id($conn);
        echo "  - Created Category ID: $cat_id\n";
        
        foreach ($images as $img_path) {
            $img_name = basename($img_path);
            $img_rel_path = $folder_name . '/' . $img_name;
            
            $adj = $adjectives[array_rand($adjectives)];
            $flav = $flavors[array_rand($flavors)];
            $type = $types[array_rand($types)];
            
            $clean_cat = str_ireplace('cake', '', $category_name);
            $clean_cat = trim($clean_cat);
            
            $prod_name = "$adj $flav $type " . ($clean_cat ? $clean_cat . " Cake" : "Cake");
            
            $prod_desc = "Indulge in our $prod_name. Baked fresh with premium ingredients, this exquisite creation is perfect for making your celebrations memorable.";
            $price = $prices[array_rand($prices)];
            
            $safe_prod_name = mysqli_real_escape_string($conn, $prod_name);
            $safe_prod_desc = mysqli_real_escape_string($conn, $prod_desc);
            $safe_prod_img = mysqli_real_escape_string($conn, $img_rel_path);

            $sql_prod = "INSERT INTO cake_shop_product (product_name, product_category, product_price, product_description, product_image) 
                         VALUES ('$safe_prod_name', '$cat_id', '$price', '$safe_prod_desc', '$safe_prod_img')";
            
            if (mysqli_query($conn, $sql_prod)) {
                echo "    + Added Product: $prod_name (₹$price)\n";
            }
        }
    }
}
echo "Sync Completed!";
?>
