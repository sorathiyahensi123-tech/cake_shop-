<?php
session_start();
header('Content-Type: application/json');

$log_msg = date('Y-m-d H:i:s') . " - GET: " . json_encode($_GET) . " | SESSION Before: " . json_encode(isset($_SESSION['cart']) ? $_SESSION['cart'] : null);

if (!empty($_GET['id'])) {
    $id = intval($_GET['id']);
    if ($id > 0) {
        if(empty($_SESSION['cart']) || !is_array($_SESSION['cart'])){
            $_SESSION['cart'] = array();
            $_SESSION['cart'][] = $id;
        } else {
            if (!in_array($id, $_SESSION['cart'])) {
                $_SESSION['cart'][] = $id;
            }
        }
    }
}

$log_msg .= " | SESSION After: " . json_encode($_SESSION['cart']) . "\n";
@file_put_contents('cart_debug.log', $log_msg, FILE_APPEND);

if (isset($_GET['redirect'])) {
    header('Location: cart.php?msg=Item%20added%20to%20cart&type=success');
    exit;
}

echo json_encode(isset($_SESSION['cart']) ? $_SESSION['cart'] : []);
?>
