<?php
session_start();
require_once('config.php'); // Database connection
require('fpdf/fpdf.php'); // FPDF Library

if (!isset($_GET['invoice_id'])) {
    die("Error: Invoice ID is missing!");
}

$invoice_id = $_GET['invoice_id'];

// Fetch invoice details
$invoice_query = "SELECT * FROM invoices WHERE invoice_id = ?";
$stmt = mysqli_prepare($conn, $invoice_query);
mysqli_stmt_bind_param($stmt, "s", $invoice_id); // "s" for string
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 0) {
    die("Error: Invoice not found!");
}

$invoice_data = mysqli_fetch_assoc($result);
$user_id = $invoice_data['user_id'];

// Fetch user details
$user_query = "SELECT users_username, users_email FROM cake_shop_users_registrations WHERE users_id = ?";
$stmt = mysqli_prepare($conn, $user_query);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$user_result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($user_result) == 0) {
    die("Error: User not found for invoice ID $invoice_id!");
}

$user_data = mysqli_fetch_assoc($user_result);

// Fetch invoice items
$item_query = "SELECT product_name, product_price, quantity, total_price, name_on_cake FROM invoice_item WHERE invoice_id = ?";
$stmt = mysqli_prepare($conn, $item_query);
mysqli_stmt_bind_param($stmt, "s", $invoice_id);
mysqli_stmt_execute($stmt);
$item_result = mysqli_stmt_get_result($stmt);

// Fetch grand total from database
$total_query = "SELECT total_amount FROM invoices WHERE invoice_id = ?";
$stmt = mysqli_prepare($conn, $total_query);
mysqli_stmt_bind_param($stmt, "s", $invoice_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
$invoice_total = $row['total_amount']; // Fetch grand total

// Start PDF Generation
$pdf = new FPDF();
$pdf->AddPage();

// ✅ Arial font use karein (DejaVu hata diya)
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(190, 10, "CAKE KING", 0, 1, 'C');
$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(190, 10, "Invoice", 0, 1, 'C'); // Only "Invoice"
$pdf->Ln(5);

// User Details
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(190, 10, "User: " . $user_data['users_username'], 0, 1);
$pdf->Cell(190, 10, "Email: " . $user_data['users_email'], 0, 1);
$pdf->Cell(190, 10, "Invoice ID: " . $invoice_id, 0, 1); // Invoice ID shifted below Email
$pdf->Cell(190, 10, "Invoice Date: " . $invoice_data['created_at'], 0, 1);
$pdf->Ln(5);

$pdf->Cell(190, 10, "Payment Method: " . $invoice_data['payment_method'], 0, 1);
$pdf->Cell(190, 10, "Delivery Date: " . $invoice_data['delivery_date'], 0, 1);
$pdf->Ln(5);

// Table Header
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(100, 10, "Product", 1);
$pdf->Cell(30, 10, "Price", 1);
$pdf->Cell(30, 10, "Quantity", 1);
$pdf->Cell(30, 10, "Total", 1);
$pdf->Ln();

// Table Data
$pdf->SetFont('Arial', '', 12);
while ($item = mysqli_fetch_assoc($item_result)) {
    // Truncate text to prevent overlapping borders
    $prod_name = $item['product_name'];
    if (!empty($item['name_on_cake'])) {
        $prod_name .= " (Msg: " . $item['name_on_cake'] . ")";
    }
    if(strlen($prod_name) > 42) {
        $prod_name = substr($prod_name, 0, 39) . "...";
    }
    $pdf->Cell(100, 10, $prod_name, 1);
    $pdf->Cell(30, 10, number_format($item['product_price'], 2), 1);
    $pdf->Cell(30, 10, $item['quantity'], 1);
    $pdf->Cell(30, 10, number_format($item['total_price'], 2), 1);
    $pdf->Ln();
}

// Grand Total Row
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(160, 10, "Grand Total", 1, 0, 'R');
$pdf->Cell(30, 10, number_format($invoice_total, 2), 1, 1, 'C');
$pdf->Ln(5);

// Thank You Message
$pdf->SetFont('Arial', 'I', 12);
$pdf->Cell(190, 10, "Thank You for Shopping with CAKE KING!", 0, 1, 'C');

// Fix Output Buffering Issue
ob_clean();

// **Check if user wants to View or Download**
if (isset($_GET['view'])) {
    $pdf->Output("I", "Invoice_$invoice_id.pdf"); // Open in Browser
} else {
    $pdf->Output("D", "Invoice_$invoice_id.pdf"); // Force Download
}
?>
