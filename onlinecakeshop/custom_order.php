<?php 
session_start();
if (!empty($_SESSION['cart'])) {
    $printCount = count($_SESSION['cart']);
} else {
    $printCount = 0;
}
if (!empty($_SESSION['user_users_id']) && !empty($_SESSION['user_users_username'])) {
    $printUsername = $_SESSION['user_users_username'];
    $isLoggedIn = true;
} else {
    $printUsername = "Guest";
    $isLoggedIn = false;
}
$userAvatar = 'uploads/default-image.jpg';
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cake King - Custom Orders</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/userpage.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/interactive.css">
    <link rel="stylesheet" href="fonts/fontawesome/css/fontawesome-all.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body>
    <div class="dashboard-main-wrapper">
         <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg navbar-elevated bg-white fixed-top">
                <div class="container-fluid pl-5 pr-5">
                    <a class="navbar-brand p-0" href="index.php">
                        <div class="d-flex align-items-center">
                            <div class="brand-icon mr-3">
                                <i class="fas fa-crown fa-2x" style="color: #d4af37;"></i>
                            </div>
                            <div class="navbar-brand-wrapper d-flex flex-column">
                                <span class="brand-main">CAKE KING</span>
                                <span class="brand-subtext">ROYAL DELIGHTS</span>
                            </div>
                        </div>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="fas fa-bars"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
<?php
                            // build category dropdown for menu
                            $categoriesNav = [];
                            require_once('config.php');
                            $cat_q = mysqli_query($conn, "SELECT category_id, category_name FROM cake_shop_category");
                            if ($cat_q) {
                                while ($row = mysqli_fetch_assoc($cat_q)) {
                                    $categoriesNav[] = $row;
                                }
                            }
                        ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle<?php echo basename(
 $_SERVER['PHP_SELF']
 )=='shop.php' ? ' active' : ''; ?>" href="#" id="menuDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Menu
                                </a>
                                <div class="dropdown-menu" aria-labelledby="menuDropdown">
                                    <a class="dropdown-item" href="shop.php">All</a>
                                    <?php foreach (
                                        $categoriesNav as $cat
                                    ): ?>
                                        <a class="dropdown-item" href="shop.php?category=<?php echo $cat['category_id']; ?>"><?php echo htmlspecialchars($cat['category_name']); ?></a>
                                    <?php endforeach; ?>
                                </div>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                            <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                            <li class="nav-item"><a class="nav-link active" href="custom_order.php">Custom Orders</a></li>
                        </ul>
                        <ul class="navbar-nav align-items-center">
                            <li class="nav-item">
                                <a href="cart.php" class="cart-icon-btn">
                                    <i class="fas fa-shopping-cart"></i>
                                    <?php if ($printCount > 0): ?>
                                        <span class="cart-badge"><?php echo $printCount; ?></span>
                                    <?php endif; ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="shop.php" class="btn btn-order">Order Now</a>
                            </li>
                             <li class="nav-item dropdown nav-user ml-3">
                                <a class="nav-link nav-user-img p-0" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="user-avatar-md rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background-color: #fdf5e6; color: #d4af37; border: 2px solid #d4af37; font-size: 1.2rem;">
                                        <i class="fas fa-user"></i>
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink2">
                                    <div class="nav-user-info">
                                        <h5 class="mb-0 text-white nav-user-name"><?php echo $printUsername; ?></h5>
                                    </div>
                                    <?php if ($isLoggedIn): ?>
                                        <a class="dropdown-item" href="account_users.php"><i class="fas fa-user mr-2"></i>Account</a>
                                        <a class="dropdown-item" href="account_users.php#orders"><i class="fas fa-box-open mr-2"></i>Track Orders</a>
                                        <a class="dropdown-item" href="logout_users.php"><i class="fas fa-power-off mr-2"></i>Logout</a>
                                    <?php else: ?>
                                        <a class="dropdown-item" href="login_users.php"><i class="fas fa-sign-in-alt mr-2"></i>Login</a>
                                    <?php endif; ?>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>

        <div class="container-fluid dashboard-content">
            <div class="row m-5">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                    <h1>Custom Cake Orders</h1>
                    <p class="lead">Let us create the perfect cake for your special occasion. Weddings, Birthdays, Anniversaries, and more.</p>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="insert_custom_order.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="user_name">Your Name</label>
                                    <input type="text" class="form-control" id="user_name" name="user_name" required placeholder="Enter your full name">
                                </div>
                                <div class="form-group">
                                    <label for="user_phone">Phone Number</label>
                                    <input type="text" class="form-control" id="user_phone" name="user_phone" required placeholder="Enter your phone number">
                                </div>
                                <div class="form-group">
                                    <label for="event_type">Event Type</label>
                                    <select class="form-control" id="event_type" name="event_type">
                                        <option value="Birthday">Birthday</option>
                                        <option value="Wedding">Wedding</option>
                                        <option value="Anniversary">Anniversary</option>
                                        <option value="Corporate">Corporate Event</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="event_date">Date of Event</label>
                                    <input type="date" class="form-control" id="event_date" name="event_date" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Cake Description / Idea</label>
                                    <textarea class="form-control" id="description" name="description" rows="4" placeholder="Describe the flavor, design, size, or any specific requirements..."></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="cake_image">Upload Reference Image (Optional)</label>
                                    <input type="file" class="form-control-file" id="cake_image" name="cake_image" accept="image/*">
                                    <small class="form-text text-muted">Upload an image of the cake design you like (Max 5MB).</small>
                                </div>
                                <button type="submit" class="btn btn-brand btn-block">Submit Inquiry</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

        <div class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="text-md-right footer-links d-none d-sm-block">
                            <a href="about.php">About</a>
                            <a href="contact.php">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/interactive.js"></script>
    <script src="js/main-js.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({duration: 800, once: true});</script>
</body>
</html>
