<?php
session_start();
require_once('config.php'); // Database connection

// ✅ Check if user is logged in
if (empty($_SESSION['user_users_id'])) {
    echo "<script>
        alert('Error: User is not logged in! Please log in before checking out.');
        window.location.href = 'login_users.php';
    </script>";
    exit();
}

// ✅ Check if cart is empty before proceeding
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<script>alert('Cart is empty! Please add items before placing an order.'); window.location.href='cart.php';</script>";
    exit();
}

$user_id = $_SESSION['user_users_id'];
$total_amount = $_POST['hidden_total_amount'];
$payment_method = $_POST['payment_method'];
$delivery_date = $_POST['delivery_date'];

// ✅ Generate Unique Invoice ID
$invoice_id = "CK-" . date("Ymd") . strtoupper(substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 2)) . rand(01, 99);

// ✅ Check if invoice_id already exists
$check_invoice_query = "SELECT * FROM invoices WHERE invoice_id = ?";
$stmt_check = mysqli_prepare($conn, $check_invoice_query);
mysqli_stmt_bind_param($stmt_check, "s", $invoice_id);
mysqli_stmt_execute($stmt_check);
mysqli_stmt_store_result($stmt_check);

if (mysqli_stmt_num_rows($stmt_check) > 0) {
    die("Error: Duplicate invoice detected. Please try again.");
}
mysqli_stmt_close($stmt_check);

// ✅ Wrap the insertion in a try/catch logic to handle unexpected exceptions like deleted users or foreign key constraints
try {
    // ✅ Insert into invoices table
    $invoice_query = "INSERT INTO invoices (invoice_id, user_id, total_amount, payment_method, delivery_date) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $invoice_query);
    mysqli_stmt_bind_param($stmt, "sisss", $invoice_id, $user_id, $total_amount, $payment_method, $delivery_date);

    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception("Error inserting invoice: " . mysqli_error($conn));
    }

    // ✅ Insert into cake_shop_orders table (Only Once)
    $order_query = "INSERT INTO cake_shop_orders (users_id, invoice_id, total_amount, payment_method, delivery_date) VALUES (?, ?, ?, ?, ?)";
    $stmt2 = mysqli_prepare($conn, $order_query);
    mysqli_stmt_bind_param($stmt2, "isiss", $user_id, $invoice_id, $total_amount, $payment_method, $delivery_date);

    if (!mysqli_stmt_execute($stmt2)) {
        throw new Exception("Error inserting order: " . mysqli_error($conn));
    }

    // ✅ Get the last inserted order ID
    $order_id = mysqli_insert_id($conn);

    // ✅ Insert Ordered Items into invoice_item table
    $insert_items_query = "INSERT INTO invoice_item (invoice_id, product_name, product_price, quantity, total_price, name_on_cake) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $insert_items_query);

    if (!$stmt) {
        throw new Exception("Error preparing statement: " . mysqli_error($conn));
    }

    foreach ($_POST['hidden_product_name'] as $key => $product_name) {
        $product_price = $_POST['hidden_product_price'][$key];
        $quantity = $_POST['product_quantity'][$key];
        $total_price = $_POST['hidden_product_total'][$key];
        $name_on_cake = isset($_POST['name_on_cake'][$key]) ? trim($_POST['name_on_cake'][$key]) : '';

        mysqli_stmt_bind_param($stmt, "ssdids", $invoice_id, $product_name, $product_price, $quantity, $total_price, $name_on_cake);

        if (!mysqli_stmt_execute($stmt)) {
            throw new Exception("Error inserting invoice item: " . mysqli_stmt_error($stmt));
        }
    }
    mysqli_stmt_close($stmt);

    // ✅ Insert Ordered Items into cake_shop_orders_detail table
    $insert_items_query = "INSERT INTO cake_shop_orders_detail (orders_id, product_name, quantity, name_on_cake) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $insert_items_query);

    foreach ($_POST['hidden_product_name'] as $key => $product_name) {
        $quantity = $_POST['product_quantity'][$key];
        $name_on_cake = isset($_POST['name_on_cake'][$key]) ? trim($_POST['name_on_cake'][$key]) : '';

        mysqli_stmt_bind_param($stmt, "isis", $order_id, $product_name, $quantity, $name_on_cake);

        if (!mysqli_stmt_execute($stmt)) {
            throw new Exception("Error inserting order item: " . mysqli_error($conn));
        }
    }

    mysqli_stmt_close($stmt);

    // ✅ Clear Cart Session
    unset($_SESSION['cart']);
    unset($_SESSION['invoice_id']);
    unset($_SESSION['total_amount']);
    unset($_SESSION['payment_method']);
    unset($_SESSION['delivery_date']);

    // ✅ Redirect to invoice page to display the bill
    header("Location: invoice.php?invoice_id=$invoice_id");
    exit();

} catch (Exception $e) {
    $error_msg = $e->getMessage();
    if (strpos($error_msg, 'foreign key constraint fails') !== false && strpos($error_msg, 'user_id') !== false) {
        unset($_SESSION['user_users_id']);
        unset($_SESSION['user_users_username']);
        echo "<script>alert('Your account session is invalid or has been deleted. Please log in again.'); window.location.href='login_users.php';</script>";
        exit();
    } else {
        echo "<script>alert('Database Error: " . addslashes($error_msg) . "'); window.location.href='cart.php';</script>";
        exit();
    }
}

?>
