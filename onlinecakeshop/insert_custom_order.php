<?php
require_once('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = $_POST['user_name'];
    $user_phone = $_POST['user_phone'];
    $event_type = $_POST['event_type'];
    $event_date = $_POST['event_date'];
    $description = $_POST['description'];
    
    // Basic validation
    if (empty($user_name) || empty($user_phone) || empty($event_date)) {
        echo "<script>alert('Please fill in all required fields.'); window.history.back();</script>";
        exit;
    }

    // Insert into database
    // Insert into database
    $image_path = null;
    
    // Handle File Upload
    if (isset($_FILES['cake_image']) && $_FILES['cake_image']['error'] == 0) {
        $upload_dir = 'uploads/';
        $file_name = time() . '_' . basename($_FILES['cake_image']['name']);
        $target_file = $upload_dir . $file_name;
        $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES['cake_image']['tmp_name']);
        if($check !== false) {
            if (move_uploaded_file($_FILES['cake_image']['tmp_name'], $target_file)) {
                $image_path = $file_name;
            } else {
                echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
            }
        } else {
            echo "<script>alert('File is not an image.');</script>";
        }
    }

    $query = "INSERT INTO custom_cake_requests (user_name, user_phone, event_type, event_date, description, image_path) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssss", $user_name, $user_phone, $event_type, $event_date, $description, $image_path);
        
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Your custom cake inquiry has been submitted! We will contact you shortly.'); window.location.href = 'index.php';</script>";
        } else {
            echo "<script>alert('Error submitting inquiry. Please try again.'); window.history.back();</script>";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header("Location: custom_order.php");
}
?>
