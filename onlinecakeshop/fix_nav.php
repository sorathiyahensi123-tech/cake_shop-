<?php
$files = [
    'about.php',
    'build_cake.php',
    'cart.php',
    'contact.php',
    'custom_order.php',
    'invoice.php',
    'offers.php',
    'shop.php',
    'single_product.php',
    'track_order.php',
    'account_users.php'
];

$goldenCircle = <<<EOT
<a class="nav-link nav-user-img p-0" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="user-avatar-md rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background-color: #fdf5e6; color: #d4af37; border: 2px solid #d4af37; font-size: 1.2rem;">
                                        <i class="fas fa-user"></i>
                                    </div>
                                </a>
EOT;

$trackOrdersLink = '<a class="dropdown-item" href="account_users.php"><i class="fas fa-user mr-2"></i>Account</a>
                                        <a class="dropdown-item" href="account_users.php#orders"><i class="fas fa-box-open mr-2"></i>Track Orders</a>';

foreach ($files as $file) {
    if (!file_exists($file)) continue;
    
    $content = file_get_contents($file);
    
    // Replace the opening <a> tag for the user dropdown up to the closing </a>
    $pattern1 = '/<a class="nav-link nav-user-img[^"]*" href="#" id="navbarDropdownMenuLink2"[^>]*>.*?<\/a>/is';
    $content = preg_replace($pattern1, $goldenCircle, $content);
    
    // Replace the "Account" item with "Account" + "Track Orders"
    // Also handling variants with or without `isLoggedIn` check
    $pattern2 = '/<a class="dropdown-item" href="account_users\.php"><i class="fas fa-user mr-2"><\/i>Account<\/a>/s';
    if (strpos($content, 'href="account_users.php#orders"') === false) {
        $content = preg_replace($pattern2, $trackOrdersLink, $content);
    }
    
    // Ensure the parent <li> has `ml-3` for spacing consistency like in index.php
    $pattern3 = '/<li class="nav-item dropdown nav-user">/';
    $content = preg_replace($pattern3, '<li class="nav-item dropdown nav-user ml-3">', $content);
    
    file_put_contents($file, $content);
    echo "Updated $file\n";
}
echo "Done.\n";
?>
