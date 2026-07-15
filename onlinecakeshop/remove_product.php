<?php
$i = isset($_GET['val_i']) ? intval($_GET['val_i']) : null;
session_start();
if ($i !== null && isset($_SESSION['cart'][$i])) {
    unset($_SESSION['cart'][$i]);
    $_SESSION['cart'] = array_values($_SESSION['cart']);
}

// if AJAX request wants json response
if (!empty($_GET['ajax']) || (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')) {
    header('Content-Type: application/json');
    echo json_encode(isset($_SESSION['cart']) ? $_SESSION['cart'] : []);
    exit;
}

// fallback for normal link navigation
header("Location: cart.php?remove_success=1");
?>