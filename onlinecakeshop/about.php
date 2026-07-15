<?php
session_start();
if (!empty($_SESSION['cart'])) {
    $printCount = count($_SESSION['cart']);
}
else {
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
    <title>CAKE KING - Royal Delights</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/userpage.css?v=<?php echo time(); ?>">
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
                            // build category list for menu dropdown
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
                            <li class="nav-item"><a class="nav-link active" href="about.php">About</a></li>
                            <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                            <li class="nav-item"><a class="nav-link" href="custom_order.php">Custom Orders</a></li>
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
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="container-fluid dashboard-content">    
            
            <div class="row mb-5">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center mt-5">
                    <h5 class="text-gold text-uppercase" style="font-size: 0.9rem; letter-spacing: 2px; font-weight: 700; color: #e6a836;">Our Story</h5>
                    <h1 class="display-4 font-weight-bold mb-3" style="font-family: 'Playfair Display', serif; color: #5d4037;">Baking with Passion</h1>
                    <p class="lead mx-auto mb-5" style="max-width: 700px; color: #777; font-family: 'Open Sans', sans-serif;">
                        From Humble Beginnings to Royal Delights
                    </p>
                </div>
            </div>

            <div class="row mx-5 justify-content-center">
                <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12 col-12">
                    <div class="card shadow-sm border-0" style="border-radius: 20px;">
                        <div class="card-body p-5">
                            <div class="row align-items-center">
                                <div class="col-lg-6 mb-4 mb-lg-0">
                                    <img src="uploads/rajan_sharma.png" alt="Rajan Sharma, Founder" class="img-fluid rounded shadow-lg" style="object-fit: cover; height: 400px; width: 100%; object-position: top;">
                                </div>
                                <div class="col-lg-6 pl-lg-5">
                                    <h3 style="font-family: 'Playfair Display', serif; color: #5d4037; margin-bottom: 20px;">Handcrafted Perfection</h3>
                                    <div class="font-italic" style="color: #666; line-height: 1.8;">
                                        <p>
                                            The CAKE KING was founded by Rajan Sharma, a passionate and dedicated master baker committed to baking the most delicious cakes and pastries around. Using only the freshest ingredients we can find, you can be sure that you are served the absolute best quality cake you can ever have.
                                        </p>
                                        <p>
                                            Under his leadership, we have evolved to become one of the premium distributors and wholesalers for cakes and pastries to well-known restaurants, cafes, supermarkets, hotels, and bakeries.
                                        </p>
                                        <p>
                                            Our online store is a leading shop in Surat providing cake and gift deliveries across the city. We provide competitive prices, exceptional after-sales services, and strict on-time delivery.
                                        </p>
                                        <p class="mt-4 font-weight-bold" style="color: #d4af37; font-size: 1.2rem;">
                                            Mithaas Bhari Shubhkaamnayein! (Sweet Wishes)
                                        </p>
                                        <p class="text-secondary">
                                            - Rajan Sharma (Founder & Head Chef)
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                <div class="row m-5">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                        <h1>Our Categories</h1>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="owl-carousel owl-theme">
                            <?php
                            require_once('config.php');
                            $select = "SELECT * FROM cake_shop_category";
                            $query = mysqli_query($conn, $select);
                            while ($res = mysqli_fetch_assoc($query)) {
                            ?>
                            <div class="item">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h3 class="card-title"><?php echo $res['category_name'];?></h3>
                                        <a href="shop.php?category=<?php echo $res['category_id'];?>"><img class="card-img" src="uploads/<?php echo $res['category_image'];?>"></a>
                                    </div>
                                    
                                </div>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>

            </div>
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <div class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <!-- <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            Copyright © 2018 Concept. All rights reserved. Dashboard by <a href="https://colorlib.com/wp/">Colorlib</a>.
                        </div> -->
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
        <!-- </div> -->
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
        $(document).ready(function(){
            $('.owl-carousel').owlCarousel({
                loop: true, margin: 10, dots: 0, autoplay: 4000, autoplayHoverPause: true, responsive:{
                    0:{items:1}, 600:{items:2}, 1000:{items:4}
                }
            })
        });
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({duration: 800, once: true});</script>
</body>
 
</html>
