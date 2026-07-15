<?php
// set up simple flash message variables that interactive.js will display
$flash_msg = '';
$flash_type = 'info';
if (isset($_GET['login_success']) && $_GET['login_success'] == 1) {
    $flash_msg = 'Logged in!';
    $flash_type = 'success';
}
if (isset($_GET['logout_success']) && $_GET['logout_success'] == 1) {
    $flash_msg = 'Logged out!';
    $flash_type = 'info';
}

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
?>
<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cake King - Royal Delights</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/userpage.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/interactive.css">
    <link rel="stylesheet" href="fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="css/owl.theme.default.min.css">
    <!-- Inline override to ensure hero text appears golden (higher priority than external CSS) -->
    <style>
        .hero-wrapper, .hero-wrapper .hero-title, .hero-wrapper .hero-subtitle, .hero-wrapper .stat-number, .hero-wrapper .stat-label, .hero-wrapper .premium-badge { color: #d4af37 !important; }
        .hero-wrapper .hero-subtitle { color: rgba(212,175,55,0.95) !important; }
    </style>
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
                            // prepare categories for navbar dropdown
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
                            <li class="nav-item">
                                <a href="shop.php" class="btn btn-order">Order Now</a>
                            </li>
                            <!-- User Dropdown (Simplified icon) -->
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
        <!-- Hero Section -->
        <!-- ============================================================== -->
        <div class="hero-wrapper mt-5 pt-5">
            <div class="row align-items-center">
                <!-- Text Content Column -->
                <div class="col-lg-6 pl-lg-5" data-aos="fade-left">
                    <div class="hero-text-content pl-4">
                        <div class="premium-badge mb-3" data-aos="zoom-in">
                            <i class="fas fa-star mr-2"></i> Premium Quality Since 2010
                        </div>
                        <h1 class="display-3 hero-title mb-3" data-aos="fade-up">
                            Every Bite is a <br>
                            <span class="text-gold">Royal Celebration</span>
                        </h1>
                        <p class="lead mb-5 hero-subtitle" data-aos="fade-up" data-aos-delay="100">
                            Experience the finest handcrafted cakes made with premium ingredients. From birthdays to weddings, we make every occasion special.
                        </p>
                        
                        <div class="hero-buttons mb-5" data-aos="fade-up" data-aos-delay="200">
                            <a href="shop.php" class="btn btn-brand btn-lg btn-rounded mr-2 px-4 mb-2">Explore Menu <i class="fas fa-arrow-right ml-2"></i></a>
                            <a href="build_cake.php" class="btn btn-outline-custom btn-lg btn-rounded mr-2 px-4 mb-2"><i class="fas fa-magic mr-2"></i>Build Custom</a>
                            <button onclick="surpriseMe(this)" class="btn btn-warning btn-lg btn-rounded px-4 mb-2 shadow-sm text-dark font-weight-bold"><i class="fas fa-dice mr-2"></i> Surprise Me</button>
                        </div>
                        
                        <div class="row hero-stats" data-aos="fade-up" data-aos-delay="300">
                            <div class="col-auto mr-5">
                                <h2 class="stat-number">15+</h2>
                                <p class="stat-label">Years Experience</p>
                            </div>
                            <div class="col-auto mr-5">
                                <h2 class="stat-number">50K+</h2>
                                <p class="stat-label">Happy Customers</p>
                            </div>
                            <div class="col-auto">
                                <h2 class="stat-number">100+</h2>
                                <p class="stat-label">Cake Varieties</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Image Card Column -->
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="hero-card" data-aos="zoom-in">
                        <!-- Crisp hero image (use a high-res wedding cake) -->
                        <img src="uploads/wedding cake/12.jpg" alt="Wedding Cake" class="hero-bg-img">
                        <!-- Inner Nav (Visual only as per screenshot) -->
                        <div class="hero-top-nav">
                            <div class="hero-brand">PREMIUM BAKERY</div>
                        </div>

                        <!-- Price Tag Overlay -->
                        <div class="price-tag" data-aos="fade-up">
                            <span class="small-text">Starting from</span>
                            <span class="price">₹499</span>
                        </div>

                        <!-- Review Badge Overlay -->
                        <div class="review-badge" data-aos="fade-up" data-aos-delay="100">
                            <div class="d-flex align-items-center">
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <span class="rating-num">4.9</span>
                            </div>
                            <span class="review-text">2000+ Reviews</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid dashboard-content">

                <!-- Occasions Section -->
                <div class="container-fluid mt-4 pt-4">
                    <div class="row mb-5">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center" data-aos="fade-up">
                            <h5 class="text-gold text-uppercase mb-2" style="letter-spacing: 2px;">Smart Suggestions</h5>
                            <h2 class="hero-title text-center" style="font-size: 3rem;">What's the Occasion?</h2>
                            <p class="text-muted">Let us recommend the perfect cake for your special moment.</p>
                        </div>
                    </div>
                    
                    <div class="row mx-5 px-xl-5 mb-5 justify-content-center">
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 mb-4" data-aos="fade-up" data-aos-delay="100">
                            <a href="shop.php?occasion=birthday" class="text-decoration-none">
                                <div class="card border-0 shadow-sm occasion-card text-center py-4" style="border-radius: 20px; transition: transform 0.3s; cursor: pointer;" onmouseover="this.style.transform='translateY(-10px)'" onmouseout="this.style.transform='translateY(0)'">
                                    <h1 class="display-4 text-primary mb-3">🎂</h1>
                                    <h4 class="font-weight-bold text-dark">Birthday</h4>
                                </div>
                            </a>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 mb-4" data-aos="fade-up" data-aos-delay="200">
                            <a href="shop.php?occasion=wedding" class="text-decoration-none">
                                <div class="card border-0 shadow-sm occasion-card text-center py-4" style="border-radius: 20px; transition: transform 0.3s; cursor: pointer;" onmouseover="this.style.transform='translateY(-10px)'" onmouseout="this.style.transform='translateY(0)'">
                                    <h1 class="display-4 text-danger mb-3">❤️</h1>
                                    <h4 class="font-weight-bold text-dark">Anniversary & Wedding</h4>
                                </div>
                            </a>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 mb-4" data-aos="fade-up" data-aos-delay="300">
                            <a href="shop.php?occasion=party" class="text-decoration-none">
                                <div class="card border-0 shadow-sm occasion-card text-center py-4" style="border-radius: 20px; transition: transform 0.3s; cursor: pointer;" onmouseover="this.style.transform='translateY(-10px)'" onmouseout="this.style.transform='translateY(0)'">
                                    <h1 class="display-4 text-info mb-3">🎉</h1>
                                    <h4 class="font-weight-bold text-dark">Party Celebration</h4>
                                </div>
                            </a>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 mb-4" data-aos="fade-up" data-aos-delay="400">
                            <button onclick="surpriseMe(this)" class="btn btn-link text-decoration-none w-100 p-0">
                                <div class="card border-0 shadow-sm occasion-card text-center py-4 bg-warning" style="border-radius: 20px; transition: transform 0.3s; cursor: pointer;" onmouseover="this.style.transform='translateY(-10px)'" onmouseout="this.style.transform='translateY(0)'">
                                    <h1 class="display-4 text-dark mb-3">🎲</h1>
                                    <h4 class="font-weight-bold text-dark">Just a Surprise</h4>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- New Categories Section -->
                <div class="container-fluid mb-5 mt-5 pb-5">
                    <div class="row mb-5">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center" data-aos="fade-up">
                            <h2 class="hero-title text-center" style="font-size: 3.5rem;">Our Categories</h2>
                        </div>
                    </div>
                    
                    <div class="row mx-5 px-xl-5 justify-content-center">
                        <!-- Card 1: Birthday -->
                        <div class="col-xl-2 col-lg-4 col-md-6 col-sm-12 mb-4" data-aos="fade-up">
                            <div class="category-clean-card" data-aos="zoom-in">
                                <div class="cat-icon-circle bg-pink-light">
                                    <i class="fas fa-birthday-cake"></i>
                                </div>
                                <h3 class="cat-title">Birthday Cakes</h3>
                                <p class="cat-desc">Make birthdays special</p>
                                <span class="cat-badge">50+ varieties</span>
                            </div>
                        </div>

                        <!-- Card 2: Wedding -->
                        <div class="col-xl-2 col-lg-4 col-md-6 col-sm-12 mb-4" data-aos="fade-up" data-aos-delay="100">
                            <div class="category-clean-card" data-aos="zoom-in" data-aos-delay="100">
                                <div class="cat-icon-circle bg-yellow-light">
                                    <i class="far fa-heart"></i>
                                </div>
                                <h3 class="cat-title">Wedding Cakes</h3>
                                <p class="cat-desc">Elegant & memorable</p>
                                <span class="cat-badge">30+ varieties</span>
                            </div>
                        </div>

                        <!-- Card 3: Party -->
                        <div class="col-xl-2 col-lg-4 col-md-6 col-sm-12 mb-4" data-aos="fade-up" data-aos-delay="200">
                            <div class="category-clean-card" data-aos="zoom-in" data-aos-delay="200" style="height: 100%;">
                                <div class="cat-icon-circle bg-orange-light">
                                    <i class="fas fa-glass-martini"></i>
                                </div>
                                <h3 class="cat-title">Party Cakes</h3>
                                <p class="cat-desc">Fun celebrations</p>
                                <span class="cat-badge">40+ varieties</span>
                            </div>
                        </div>

                        <!-- Card 4: Custom -->
                        <div class="col-xl-2 col-lg-4 col-md-6 col-sm-12 mb-4" data-aos="fade-up" data-aos-delay="300">
                            <a href="custom_order.php" style="text-decoration: none; width: 100%; display: block; height: 100%;">
                                <div class="category-clean-card" data-aos="zoom-in" data-aos-delay="300" style="height: 100%;">
                                    <div class="cat-icon-circle bg-brown-light">
                                        <i class="fas fa-gift"></i>
                                    </div>
                                    <h3 class="cat-title">Custom Cakes</h3>
                                    <p class="cat-desc">Your imagination</p>
                                    <span class="cat-badge">∞ varieties</span>
                                </div>
                            </a>
                        </div>

                        <!-- Card 5: Premium -->
                        <div class="col-xl-2 col-lg-4 col-md-6 col-sm-12 mb-4" data-aos="fade-up" data-aos-delay="400">
                            <div class="category-clean-card" data-aos="zoom-in" data-aos-delay="400">
                                <div class="cat-icon-circle bg-purple-light">
                                    <i class="far fa-star"></i>
                                </div>
                                <h3 class="cat-title">Premium Cakes</h3>
                                <p class="cat-desc">Luxury collection</p>
                                <span class="cat-badge">25+ varieties</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Our Menu Section -->
                <div class="row mb-5">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center mt-5">
                        <h5 class="text-gold text-uppercase" style="font-size: 0.9rem; letter-spacing: 2px; font-weight: 700; color: #e6a836;">Our Menu</h5>
                        <h1 class="display-4 font-weight-bold mb-3" style="font-family: 'Playfair Display', serif; color: #5d4037;">Delicious Creations</h1>
                        <p class="lead mx-auto mb-5" style="max-width: 700px; color: #777; font-family: 'Open Sans', sans-serif;">
                            Each cake is handcrafted with love, using the finest ingredients to create moments of pure joy
                        </p>

                        <!-- Category filter removed per user request -->
                    </div>
                </div>

                <div class="row mx-5">
                    <?php
                    require_once('config.php');
                    // Fetch 8 random products for the homepage showcase
                    $select = "SELECT * FROM cake_shop_product ORDER BY RAND() LIMIT 8";
                    $query = mysqli_query($conn, $select);
                    while ($res = mysqli_fetch_assoc($query)) {
                    ?>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mb-4 d-flex align-items-stretch">
                            <div class="product-thumbnail d-flex flex-column w-100">
                                <a href="single_product.php?product_id=<?php echo $res['product_id']; ?>">
                                    <div class="product-img-head">
                                        <div class="product-img">
                                            <?php
                                            $file_array = explode(', ', $res['product_image']);
                                            ?>
                                            <img src="uploads/<?php echo $file_array[0]; ?>" class="img-fluid" alt="<?php echo $res['product_name']; ?>" loading="lazy">
                                        </div>
                                        <!-- Badges -->
                                        <?php if ($res['product_id'] % 3 == 0): ?>
                                            <span class="badge-custom badge-bestseller">Bestseller</span>
                                        <?php elseif ($res['product_id'] % 4 == 0): ?>
                                            <span class="badge-custom badge-new">New</span>
                                        <?php endif; ?>
                                        
                                        <!-- Heart Icon -->
                                        <div class="wishlist-icon">
                                            <i class="far fa-heart"></i>
                                        </div>
                                    </div>
                                </a>
                                
                                <div class="product-content">
                                    <div class="product-content-head">
                                        <h3 class="product-title"><?php echo $res['product_name']; ?></h3>
                                        <div class="product-price">
                                            <?php
                                            $original_price = $res['product_price'];
                                            if ($original_price > 800) {
                                                $discounted_price = $original_price - ($original_price * 0.20);
                                                echo "<span style='text-decoration: line-through; color: #999; font-size: 0.9em; margin-right: 8px;'>₹" . $original_price . "</span>";
                                                echo "<span style='color: #d4af37;'>₹" . number_format($discounted_price, 2) . "</span>";
                                            } else {
                                                echo "<span>₹" . $original_price . "</span>";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="product_btn">
                                        <a href="fetch_cart.php?id=<?php echo $res['product_id']; ?>&redirect=1" class="btn btn-primary">
                                            Add to Cart
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <div class="row m-5 hero-image2 rounded">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-3 hero-text">
                        <h1 class="text-dark">Who We Are</h1>
                        <p class="text-dark px-5">We are bakers, we bake the piece of joy. We believe cake and baked goods are an expression of love.</p>
                        <p class="text-dark px-5">We bake from scratch daily using traditional methods and quality ingredients. There are some things in life you just can't fake, and dang good cake? That's one of them. We use organic whole milk, cage-free eggs, loads of real fruit, pure extracts, amazingly delicious chocolate, and lots and lots of real butter to create simply delicious treats the old-fashioned way.</p>
                        <a href="about.php" class="btn btn-rounded btn-success">Read More</a>
                    </div>
                </div>

                <div class="row mx-5 hero-image rounded">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-3 hero-text">
                        <h1 style="color: #d4af37; font-weight: 700; text-shadow: 1px 1px 2px rgba(0,0,0,0.1);">Always happy to hear from you.</h1>
                        <a href="contact.php" class="btn btn-rounded btn-brand mt-2">Contact Us</a>
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
    <script type="text/javascript" src="js/owl.carousel.min.js"></script>
    <script src="js/interactive.js?v=2"></script>
    <script>
        $(document).ready(function(){
            $('.owl-carousel').owlCarousel({
                loop: true, margin: 10, dots: 0, autoplay: 4000, autoplayHoverPause: true, responsive:{
                    0:{items:1}, 600:{items:2}, 1000:{items:4}
                }
            })
        });
        function add_cart(product_id) { window.add_cart(product_id); }
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({duration: 800, once: true});</script>
</body>
 
</html>