<?php
require_once('config.php');
$res = mysqli_query($conn, 'SELECT * FROM cake_shop_users_registrations LIMIT 1');
$user = mysqli_fetch_assoc($res);
echo "User: " . $user['users_username'] . " Pass: " . $user['users_password'] . "\n";
