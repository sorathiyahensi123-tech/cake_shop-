<?php
require_once('config.php');

// Function to get all images from a folder
function getImagesFromFolder($folder) {
    $images = [];
    if (is_dir('uploads/' . $folder)) {
        $files = scandir('uploads/' . $folder);
        foreach ($files as $file) {
            if ($file != '.' && $file != '..' && preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $file)) {
                $images[] = $folder . '/' . $file;
            }
        }
    }
    return $images;
}

// Category mapping
$categories = [
    'Birthday cake' => 1, // Cakes
    'anniversary cake' => 1, // Cakes
    'wedding cake' => 1, // Cakes
    'cupcake' => 3, // Desserts
    'premium' => 1, // Cakes (premium cakes)
    'cookies' => 4, // Cookies
    'pestries' => 5, // pastries
];

// Product data templates
$productTemplates = [
    'Birthday cake' => [
        'name' => 'Birthday Cake',
        'price' => '599',
        'description' => 'Delicious birthday cake perfect for celebrations. Made with fresh ingredients and premium quality. Qty(500 gm.)',
        'discount' => 0
    ],
    'anniversary cake' => [
        'name' => 'Anniversary Cake',
        'price' => '699',
        'description' => 'Romantic anniversary cake specially designed for your special day. Made with love and finest ingredients. Qty(600 gm.)',
        'discount' => 10
    ],
    'wedding cake' => [
        'name' => 'Wedding Cake',
        'price' => '1499',
        'description' => 'Elegant wedding cake for your dream wedding. Multi-tier design with exquisite decoration. Qty(2 kg.)',
        'discount' => 15
    ],
    'cupcake' => [
        'name' => 'Cupcake',
        'price' => '89',
        'description' => 'Freshly baked cupcake with creamy frosting. Perfect for any occasion. Qty(1 piece)',
        'discount' => 0
    ],
    'premium' => [
        'name' => 'Premium Cake',
        'price' => '899',
        'description' => 'Luxury premium cake made with the finest ingredients. A true indulgence for special moments. Qty(700 gm.)',
        'discount' => 20
    ],
    'cookies' => [
        'name' => 'Cookie',
        'price' => '49',
        'description' => 'Freshly baked cookies with rich flavors. Perfect snack for any time. Qty(2 pieces)',
        'discount' => 0
    ],
    'pestries' => [
        'name' => 'Pastry',
        'price' => '79',
        'description' => 'Delicious pastry with flaky crust and rich filling. Freshly baked daily. Qty(1 piece)',
        'discount' => 5
    ]
];

// Get existing products to avoid duplicates
$existingProducts = [];
$result = mysqli_query($conn, "SELECT product_image FROM cake_shop_product");
while ($row = mysqli_fetch_assoc($result)) {
    $images = explode(', ', $row['product_image']);
    foreach ($images as $img) {
        $existingProducts[] = $img;
    }
}

$folders = ['Birthday cake', 'anniversary cake', 'wedding cake', 'cupcake', 'premium', 'cookies', 'pestries'];
$inserted = 0;
$errors = [];

echo "<h1>Populating New Products from Uploaded Images</h1>";
echo "<style>body{font-family:Arial,sans-serif;margin:20px;} .success{color:green;} .error{color:red;} .product{ margin:5px 0;}</style>";

foreach ($folders as $folder) {
    if (!isset($categories[$folder]) || !isset($productTemplates[$folder])) {
        continue;
    }

    $images = getImagesFromFolder($folder);
    $categoryId = $categories[$folder];
    $template = $productTemplates[$folder];

    echo "<h3>Processing $folder folder (" . count($images) . " images)</h3>";

    foreach ($images as $index => $image) {
        // Skip if image already exists in database
        if (in_array($image, $existingProducts)) {
            echo "<div class='product'>⚠️ Skipping: $image (already exists)</div>";
            continue;
        }

        $productName = $template['name'] . ' ' . ($index + 1);
        $productImage = $image; // Single image for simplicity

        $sql = "INSERT INTO cake_shop_product (product_name, product_category, product_price, product_description, product_image, product_discount) VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'sisssi', $productName, $categoryId, $template['price'], $template['description'], $productImage, $template['discount']);

        if (mysqli_stmt_execute($stmt)) {
            $inserted++;
            echo "<div class='product success'>✅ Inserted: $productName</div>";
        } else {
            $error = mysqli_error($conn);
            $errors[] = "Error inserting $productName: $error";
            echo "<div class='product error'>❌ Error: $productName - $error</div>";
        }

        mysqli_stmt_close($stmt);
    }
}

echo "<hr>";
echo "<h2>Summary</h2>";
echo "<div class='success'>✅ Total products inserted: $inserted</div>";

if (!empty($errors)) {
    echo "<div class='error'>❌ Errors encountered: " . count($errors) . "</div>";
    echo "<details><summary>View Errors</summary><ul>";
    foreach ($errors as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul></details>";
}

echo "<br><br>";
echo "<a href='shop.php' style='background:#d4af37;color:white;padding:10px 20px;text-decoration:none;border-radius:5px;'>View Shop</a>";
echo " <a href='index.php' style='background:#6c757d;color:white;padding:10px 20px;text-decoration:none;border-radius:5px;'>Back to Home</a>";
?>