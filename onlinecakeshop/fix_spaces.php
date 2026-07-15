<?php
require_once('config.php');

$q = mysqli_query($conn, "SELECT product_id, product_image FROM cake_shop_product");
while($r = mysqli_fetch_assoc($q)) {
    if(strpos($r['product_image'], ' ') !== false) {
        $clean = str_replace(' ', '%20', $r['product_image']);
        mysqli_query($conn, "UPDATE cake_shop_product SET product_image='$clean' WHERE product_id={$r['product_id']}");
    }
}

$q2 = mysqli_query($conn, "SELECT category_id, category_image FROM cake_shop_category");
while($r = mysqli_fetch_assoc($q2)) {
    if(strpos($r['category_image'], ' ') !== false) {
        $clean = str_replace(' ', '%20', $r['category_image']);
        mysqli_query($conn, "UPDATE cake_shop_category SET category_image='$clean' WHERE category_id={$r['category_id']}");
    }
}
echo "Spaces replaced with %20 in database!";
?>
