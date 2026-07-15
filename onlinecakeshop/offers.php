<?php
session_start();
if (!empty($_SESSION['cart'])) {
    $printCount = count($_SESSION['cart']);
} else {
    $printCount = 0;
}

// Check if user is logged in
if (!empty($_SESSION['user_users_id']) && !empty($_SESSION['user_users_username'])) {
    $printUsername = $_SESSION['user_users_username'];
    $isLoggedIn = true;
} else {
    $printUsername = "Guest";
    $isLoggedIn = false;
}

// Default avatar path (check if the file exists)
$userAvatar = 'uploads/default-image.jpg';
if (!file_exists($userAvatar)) {
    $userAvatar = 'https://via.placeholder.com/150'; // Temporary placeholder if path fails
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CAKE KING - Special Offers</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/userpage.css">
    <link rel="stylesheet" href="css/interactive.css">
    <link rel="stylesheet" href="fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="css/owl.theme.default.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top shadow-sm navbar-elevated">
                <a class="navbar-brand" href="#">CAKE KING</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span><i class="fas fa-bars mx-3"></i></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">Shop</a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink1">
                                <?php
                                require_once('config.php');
                                $select = "SELECT * FROM cake_shop_category";
                                $query = mysqli_query($conn, $select);
                                while ($res = mysqli_fetch_assoc($query)) {
                                ?>
                                    <a class="dropdown-item"
                                        href="shop.php?category=<?php echo $res['category_id']; ?>">
                                        <?php echo $res['category_name']; ?>
                                    </a>
                                <?php
                                }
                                ?>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="offers.php">Offers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i> <span
                                    class="badge badge-pill badge-secondary"><?php echo $printCount; ?></span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">About us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">Contact</a>
                        </li>
                        <li class="nav-item dropdown nav-user ml-3">
                            <a class="nav-link nav-user-img p-0" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="user-avatar-md rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background-color: #fdf5e6; color: #d4af37; border: 2px solid #d4af37; font-size: 1.2rem;">
                                        <i class="fas fa-user"></i>
                                    </div>
                                </a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown"
                                aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name"><?php echo $printUsername; ?></h5>
                                    <span class="status"></span><span class="ml-2">Available</span>
                                </div>
                                <?php if ($isLoggedIn): ?>
                                    <a class="dropdown-item" href="account_users.php"><i
                                            class="fas fa-user mr-2"></i>Account</a>
                                    <a class="dropdown-item" href="logout_users.php"><i
                                            class="fas fa-power-off mr-2"></i>Logout</a>
                                <?php else: ?>
                                    <a class="dropdown-item" href="login_users.php"><i
                                            class="fas fa-sign-in-alt mr-2"></i>Login</a>
                                <?php endif; ?>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->

        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="container-fluid dashboard-content">

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title">Special Offers</h2>
                        <p class="pageheader-text">
                            Handpicked cakes with delicious discounts and festive pricing. Treat yourself today.
                        </p>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php" class="breadcrumb-link">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Offers</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mx-5">
                <?php
                require_once('config.php');

                // Prefer explicit discount field if present, otherwise fall back to high-value cakes
                $offerQuery = "
                    SELECT *, 
                           COALESCE(product_discount, 0) AS discount_value 
                    FROM cake_shop_product 
                    WHERE COALESCE(product_discount, 0) > 0 
                       OR product_price > 800
                    ORDER BY discount_value DESC, product_price DESC
                ";

                $query = mysqli_query($conn, $offerQuery);

                if ($query && mysqli_num_rows($query) > 0) {
                    while ($res = mysqli_fetch_assoc($query)) {
                        $price = (float) $res['product_price'];
                        $discount = isset($res['product_discount']) ? (float) $res['product_discount'] : 0;

                        if ($discount > 0) {
                            $discounted_price = $price - ($price * $discount / 100);
                        } elseif ($price > 800) {
                            // Fallback discount for premium cakes
                            $discount = 20;
                            $discounted_price = $price - ($price * $discount / 100);
                        } else {
                            $discounted_price = $price;
                        }

                        $file_array = explode(', ', $res['product_image']);
                ?>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mb-4 d-flex align-items-stretch">
                            <div class="product-thumbnail rounded d-flex flex-column w-100">
                                <a href="single_product.php?product_id=<?php echo $res['product_id']; ?>">
                                    <div class="product-img-head">
                                        <div class="product-img">
                                            <img src="uploads/<?php echo $file_array[0]; ?>" class="img-fluid" alt="Cake image">
                                        </div>
                                        <?php if ($discount > 0): ?>
                                            <span class="badge badge-danger"
                                                style="position:absolute;top:12px;left:12px;border-radius:999px;padding:.35rem .9rem;font-size:.75rem;background:linear-gradient(135deg,#ff7ab5,#ff4b8b);">
                                                <?php echo (int) $discount; ?>% OFF
                                            </span>
                                        <?php elseif ($price > 800): ?>
                                            <span class="badge badge-danger"
                                                style="position:absolute;top:12px;left:12px;border-radius:999px;padding:.35rem .9rem;font-size:.75rem;background:linear-gradient(135deg,#ff7ab5,#ff4b8b);">
                                                Special Price
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </a>
                                <div class="product-content">
                                    <div class="product-content-head">
                                        <h3 class="product-title"><?php echo $res['product_name']; ?></h3>
                                        <div class="product-price"
                                            style="display:flex;flex-direction:column;align-items:flex-start;gap:2px;">
                                            <div style="color:#19a66c;">
                                                <span
                                                    style="font-size:1.1em;font-weight:bold;">₹</span> <?php echo number_format($discounted_price, 2); ?>
                                            </div>
                                            <?php if ($discounted_price < $price): ?>
                                                <div
                                                    style="text-decoration:line-through;color:#e55353;font-size:0.9em;">
                                                    <span
                                                        style="font-size:1.1em;font-weight:bold;">₹</span> <?php echo number_format($price, 2); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="product_btn mt-2">
                                        <a href="fetch_cart.php?id=<?php echo $res['product_id']; ?>&redirect=1" class="btn btn-primary btn-block">
                                            Add to Cart
                                        </a>
                                        <a href="single_product.php?product_id=<?php echo $res['product_id']; ?>"
                                            class="btn btn-outline-light btn-block mt-2">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } else {
                ?>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body text-center py-5">
                                <h3 class="mb-3">No offers available right now</h3>
                                <p class="text-muted mb-4">
                                    Check back soon or explore all our delicious cakes in the shop.
                                </p>
                                <a href="index.php" class="btn btn-primary">Back to Home</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

        </div>
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <div class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="text-md-right footer-links d-none d-sm-block">
                            <a href="about.php">About</a>
                            <a href="contact.php">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/main-js.js"></script>
    <script src="js/interactive.js"></script>
    <script type="text/javascript" src="js/owl.carousel.min.js"></script>
    <script>
        function add_cart(product_id) { window.add_cart(product_id); }
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({duration: 800, once: true});</script>
</body>

</html>
