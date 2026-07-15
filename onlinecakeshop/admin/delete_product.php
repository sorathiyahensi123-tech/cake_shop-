<?php
require_once('../config.php');

$prod_id = $_GET['prod_id'];
$messages = [];

// Retrieve the image file path
$query = "SELECT product_image FROM cake_shop_product WHERE product_id = $prod_id";
$result = mysqli_query($conn, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    if ($row) {
        $image_path = '../uploads/' . $row['product_image']; // Adjust path if needed

        // Check if file exists and delete it
        if (file_exists($image_path)) {
            if (unlink($image_path)) {
                $messages[] = "Image deleted successfully.";
            } else {
                $messages[] = "Failed to delete image.";
            }
        } else {
            $messages[] = "Image file does not exist.";
        }
    } else {
        $messages[] = "No product found with ID: $prod_id";
    }
} else {
    $messages[] = "Error fetching product: " . mysqli_error($conn);
}

// Delete the product from the database
$delete = "DELETE FROM cake_shop_product WHERE product_id = $prod_id";
if (mysqli_query($conn, $delete)) {
    $messages[] = "Product deleted successfully.";
} else {
    $messages[] = "Error deleting product: " . mysqli_error($conn);
}

// Show all messages in a JavaScript alert and redirect
echo "<script>
    alert('" . implode("\\n", $messages) . "');
    window.location.href = 'view_product.php';
</script>";
?>
