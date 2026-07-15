<?php
require_once('config.php');

$query = "CREATE TABLE IF NOT EXISTS custom_cake_requests (
    request_id INT AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(100) NOT NULL,
    user_phone VARCHAR(20) NOT NULL,
    event_type VARCHAR(50),
    event_date DATE,
    description TEXT,
    image_path VARCHAR(255),
    status VARCHAR(20) DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (mysqli_query($conn, $query)) {
    echo "Table 'custom_cake_requests' created successfully.";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}
?>
