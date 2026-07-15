<?php
session_start();
$_SESSION['user_users_id'] = 1;
$_SESSION['user_users_username'] = 'kaxeel';
$_GET['order_id'] = 1;
ob_start();
require('track_order.php');
$out = ob_get_clean();
echo "SUCCESS";
