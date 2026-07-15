<?php
require_once('config.php');

$query = "SHOW COLUMNS FROM custom_cake_requests LIKE 'image_path'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    // Column doesn't exist, add it
    $alter_query = "ALTER TABLE custom_cake_requests ADD COLUMN image_path VARCHAR(255)";
    if (mysqli_query($conn, $alter_query)) {
        echo "Successfully added 'image_path' column to 'custom_cake_requests' table.<br>";
    } else {
        echo "Error adding column: " . mysqli_error($conn) . "<br>";
    }
} else {
    echo "Column 'image_path' already exists.<br>";
}
echo "Database update check complete.";
?>
