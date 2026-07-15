<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
require_once('config.php');

try {
    $invoice_query = "INSERT INTO invoices (invoice_id, user_id, total_amount, payment_method, delivery_date) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $invoice_query);
    $invoice_id = 'test_inv_123';
    $user_id = 999999; // non-existent
    $total_amount = 100;
    $payment_method = 'Cash';
    $delivery_date = '2026-01-01 10:00:00';
    mysqli_stmt_bind_param($stmt, "sisss", $invoice_id, $user_id, $total_amount, $payment_method, $delivery_date);
    
    echo "Executing stmt...\n";
    mysqli_stmt_execute($stmt);
    echo "Execution finished.\n";
} catch (\Exception $e) {
    echo "CAUGHT EXCEPTION: " . get_class($e) . " - " . $e->getMessage() . "\n";
} catch (\Error $e) {
    echo "CAUGHT ERROR: " . get_class($e) . " - " . $e->getMessage() . "\n";
}
?>
