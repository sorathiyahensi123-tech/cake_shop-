<?php
// generic flash handling for this page
$flash_msg = '';
$flash_type = 'info';
if (isset($_GET['msg'])) {
    $flash_msg = htmlspecialchars($_GET['msg']);
    $flash_type = isset($_GET['type']) ? htmlspecialchars($_GET['type']) : 'info';
}

session_start();
require_once('config.php');
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
    <title>CAKE KING - Shopping</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/userpage.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/interactive.css">
    <link rel="stylesheet" href="fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" type="text/css" href="css/category_slider.css?v=<?php echo time(); ?>">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <?php if (!empty($flash_msg)): ?>
            <div id="flash" data-message="<?php echo htmlspecialchars($flash_msg); ?>" data-type="<?php echo htmlspecialchars($flash_type); ?>"></div>
        <?php endif; ?>
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
                            // category list for dropdown
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
                                <a class="nav-link dropdown-toggle active" href="#" id="menuDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
        <!-- <div class="dashboard-wrapper"> -->
        <div class="container-fluid dashboard-content">

            <div class="row mb-5">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center mt-5">
                    <?php
                    $pageTitle = "Delicious Creations";
                    $pageDesc = "Each cake is handcrafted with love, using the finest ingredients to create moments of pure joy";
                    $heroImage = ""; // Default no hero image
                    
                    if (isset($_GET['category'])) {
                        $cat_id = intval($_GET['category']);
                        $cat_name_query = mysqli_query($conn, "SELECT category_name, category_image FROM cake_shop_category WHERE category_id = $cat_id");
                        if ($cat_row = mysqli_fetch_assoc($cat_name_query)) {
                            $pageTitle = $cat_row['category_name'];
                            $pageDesc = "Explore our exquisite collection of " . strtolower($cat_row['category_name']);
                            if (!empty($cat_row['category_image'])) {
                                $heroImage = 'uploads/' . $cat_row['category_image'];
                            }
                        }
                    }
                    ?>
                    
                    <?php if (!empty($heroImage)): ?>
                    <div class="row mb-4">
                        <div class="col-12">
                            <div style="width: 100%; height: 300px; border-radius: 20px; overflow: hidden; position: relative; box-shadow: 0 15px 30px rgba(0,0,0,0.1);">
                                <img src="<?php echo $heroImage; ?>" alt="<?php echo $pageTitle; ?>" style="width: 100%; height: 100%; object-fit: cover;">
                                <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center;">
                                    <h1 class="display-3 font-weight-bold text-white" style="font-family: 'Playfair Display', serif; text-shadow: 2px 2px 4px rgba(0,0,0,0.5);"><?php echo $pageTitle; ?></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                        <h5 class="text-gold text-uppercase" style="font-size: 0.9rem; letter-spacing: 2px; font-weight: 700; color: #e6a836;">Our Menu</h5>
                        <h1 class="display-4 font-weight-bold mb-3" style="font-family: 'Playfair Display', serif; color: #5d4037;"><?php echo $pageTitle; ?></h1>
                        <p class="lead mx-auto mb-3" style="max-width: 700px; color: #777; font-family: 'Open Sans', sans-serif;">
                            <?php echo $pageDesc; ?>
                        </p>
                        <!-- Live Search Bar -->
                        <div style="max-width: 500px; margin: 0 auto 2rem;">
                            <input type="text" id="searchInput" placeholder="Search cakes..." class="form-control" style="border-radius: 50px; padding: 12px 20px; font-size: 16px; border: 2px solid #d4af37;">
                        </div>
                    <?php endif; ?>

                    <!-- Category Pills -->
                    <!-- Category Slider -->
                    <div class="category-scroll-container mb-5" data-aos="fade-up">
                        <a href="shop.php" class="cat-item-link <?php echo !isset($_GET['category']) ? 'active' : ''; ?>" data-aos="fade-left">
                            <div class="cat-img-wrapper" style="background: #f8f9fa; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-th-large" style="font-size: 1.5rem; color: #5d4037;"></i>
                            </div>
                            <span class="cat-name-label">All</span>
                        </a>
                        <?php
                        $cat_select = "SELECT * FROM cake_shop_category";
                        $cat_query = mysqli_query($conn, $cat_select);
                        $cat_delay = 0;
                        while ($cat_res = mysqli_fetch_assoc($cat_query)) {
                            $isActive = (isset($_GET['category']) && $_GET['category'] == $cat_res['category_id']) ? 'active' : '';
                            $cat_delay_class = 'animate-delay-' . (($cat_delay % 5) + 1);
                            // Fallback image if empty or file doesn't exist
                            $cat_img_path = 'uploads/default-image.jpg';
                            if (!empty($cat_res['category_image']) && file_exists('uploads/' . $cat_res['category_image'])) {
                                $cat_img_path = 'uploads/' . $cat_res['category_image'];
                            } elseif (!empty($cat_res['category_image'])) {
                                // If db has image but file missing, use it anyway (browser might cache or strict check failed)
                                // or better, revert to default. Let's use image from DB but if empty use default.
                                $cat_img_path = 'uploads/' . $cat_res['category_image'];
                            }
                        ?>
                            <a href="shop.php?category=<?php echo $cat_res['category_id']; ?>" class="cat-item-link <?php echo $isActive; ?> <?php echo $cat_delay_class; ?>" data-aos="fade-left">
                                <div class="cat-img-wrapper">
                                    <img src="<?php echo $cat_img_path; ?>" alt="<?php echo $cat_res['category_name']; ?>">
                                </div>
                                <span class="cat-name-label"><?php echo $cat_res['category_name']; ?></span>
                            </a>
                        <?php 
                            $cat_delay++;
                        } ?>
                        <a href="custom_order.php" class="cat-item-link" data-aos="fade-left" data-aos-delay="500">
                            <div class="cat-img-wrapper" style="background: #f8f9fa; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-magic" style="font-size: 1.5rem; color: #5d4037;"></i>
                            </div>
                            <span class="cat-name-label">Custom</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row mx-5">

                <?php
                // Intercept Surprise Me
                if (isset($_GET['surprise']) && $_GET['surprise'] == 1) {
                    $surp_q = mysqli_query($conn, "SELECT product_id FROM cake_shop_product ORDER BY RAND() LIMIT 1");
                    if ($surp_r = mysqli_fetch_assoc($surp_q)) {
                        echo "<script>window.location.href='single_product.php?product_id=" . $surp_r['product_id'] . "';</script>";
                        exit;
                    }
                }

                if (isset($_GET['occasion'])) {
                    $occ = mysqli_real_escape_string($conn, $_GET['occasion']);
                    $page_title = ucfirst($occ) . " Cakes";
                    $select = "SELECT * FROM cake_shop_product WHERE product_name LIKE '%$occ%' OR product_description LIKE '%$occ%'";
                } elseif (isset($_GET['category'])) {
                    $category = intval($_GET['category']);
                    $select = "SELECT * FROM cake_shop_product where product_category = $category";
                } else {
                    $select = "SELECT * FROM cake_shop_product";
                }

                // Debug overlay: append &debug_cat=1 to the URL to show selected category and SQL
                if (isset($_GET['debug_cat'])) {
                    $dbg_cat = isset($category) ? $category : '(none)';
                    echo '<div style="position:fixed;bottom:10px;left:10px;padding:12px;background:rgba(255,255,255,0.97);border:1px solid #ccc;border-radius:8px;z-index:9999;box-shadow:0 6px 18px rgba(0,0,0,0.12);font-family:Arial,Helvetica,sans-serif;font-size:13px;color:#333;">';
                    echo '<strong>DEBUG</strong><br>'; 
                    echo 'category = ' . htmlspecialchars($dbg_cat) . '<br>';
                    echo 'SQL = ' . htmlspecialchars($select);
                    echo '</div>';
                }
                $query = mysqli_query($conn, $select);
                
                if (mysqli_num_rows($query) == 0) {
                    echo '<div class="col-12 text-center py-5" data-aos="fade-up">
                            <i class="far fa-folder-open mb-3" data-aos="zoom-in" style="font-size: 3rem; color: #e0e0e0;"></i>
                            <h3 style="color: #999; font-family: \'Playfair Display\', serif;">No products found in this category yet.</h3>
                            <p class="text-muted">Check back soon for delicious new additions!</p>
                            <a href="shop.php" class="btn btn-outline-custom mt-3" data-aos="fade-up" data-aos-delay="100">View All Products</a>
                          </div>';
                }
                
                $delay = 0;
                while ($res = mysqli_fetch_assoc($query)) {
                    $delayClass = 'animate-delay-' . (($delay % 5) + 1);
                ?>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mb-4 d-flex align-items-stretch">
                        <div class="product-thumbnail d-flex flex-column w-100 <?php echo $delayClass; ?>" data-aos="fade-up">
                            <a href="single_product.php?product_id=<?php echo $res['product_id']; ?>">
                                <div class="product-img-head">
                                    <div class="product-img">
                                        <?php
                                        $file_array = explode(', ', $res['product_image']);
                                        ?>
                                        <img src="uploads/<?php echo $file_array[0]; ?>" class="img-fluid" alt="<?php echo $res['product_name']; ?>" loading="lazy">
                                    </div>
                                    <!-- Badges (Randomly assigned for demo visual) -->
                                    <?php if ($res['product_id'] % 3 == 0): ?>
                                        <span class="badge-custom badge-bestseller" data-aos="zoom-in">Bestseller</span>
                                    <?php elseif ($res['product_id'] % 4 == 0): ?>
                                        <span class="badge-custom badge-new" data-aos="zoom-in">New</span>
                                    <?php endif; ?>
                                    
                                    <!-- Heart Icon -->
                                    <div class="wishlist-icon" data-aos="fade-right">
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
                                    <a href="fetch_cart.php?id=<?php echo $res['product_id']; ?>&redirect=1" class="btn btn-primary" data-aos="fade-up" data-aos-delay="200">
                                        Add to Cart
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php 
                    $delay++;
                } ?>

            </div>

            <div class="row m-5">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center" data-aos="fade-up">
                    <h1>Our Categories</h1>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="owl-carousel owl-theme" data-aos="fade-up" data-aos-delay="100">
                        <?php
                        require_once('config.php');
                        $select = "SELECT * FROM cake_shop_category";
                        $query = mysqli_query($conn, $select);
                        while ($res = mysqli_fetch_assoc($query)) {
                        ?>
                            <div class="item">
                                <div class="card h-100" data-aos="zoom-in">
                                    <div class="card-body">
                                        <h3 class="card-title"><?php echo $res['category_name']; ?></h3>
                                        <a href="shop.php?category=<?php echo $res['category_id']; ?>"><img class="card-img" src="uploads/<?php echo $res['category_image']; ?>" loading="lazy"></a>
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
    <script src="js/interactive.js?v=2"></script>
    <script type="text/javascript" src="js/owl.carousel.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                dots: 0,
                autoplay: 4000,
                autoplayHoverPause: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 4
                    }
                }
            })
        });

        function add_cart(product_id) { window.add_cart(product_id); }
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({duration: 800, once: true});</script>
</body>

</html>