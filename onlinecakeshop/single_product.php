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
    <title>CAKE KING - Product Details</title>
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
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span><i class="fas fa-bars mx-3
"></i></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link active" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Shop</a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink1">
                                <?php
                                require_once('config.php');
                                $select = "SELECT * FROM cake_shop_category";
                                $query = mysqli_query($conn, $select);
                                while ($res = mysqli_fetch_assoc($query)) {
                                ?>
                                    <a class="dropdown-item" href="shop.php?category=<?php echo $res['category_id']; ?>">
                                        <?php echo $res['category_name']; ?>
                                    </a>
                                <?php
                                }
                                ?>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="offers.php">Offers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i> <span class="badge badge-pill badge-secondary"><?php echo $printCount; ?></span></a>
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
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name"><?php echo $printUsername; ?></h5>
                                    <span class="status"></span><span class="ml-2">Available</span>
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

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title">Product</h2>
                        <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php" class="breadcrumb-link">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Product details</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mx-5">
                <?php
                require_once('config.php');
                $product_id = $_GET['product_id'];
                $select = "SELECT * FROM cake_shop_product WHERE product_id = $product_id";
                $query = mysqli_query($conn, $select);
                $res = mysqli_fetch_assoc($query);
                $originalPrice = $res['product_price'];
                $discount = isset($res['product_discount']) ? $res['product_discount'] : 0;
                $discountedPrice = $originalPrice - ($originalPrice * ($discount / 100));
                ?>

                <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="row">
                        <!-- Product Image Carousel -->
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 pr-xl-0 pr-lg-0 pr-md-0 m-b-30">
                            <div class="product-slider p-4">
                                <div id="carouselExampleIndicators" class="product-carousel carousel slide" data-ride="carousel">
                                    <?php
                                    $file_array = explode(', ', $res['product_image']);
                                    ?>
                                    <div class="carousel-inner">
                                        <?php
                                        for ($i = 0; $i < count($file_array); $i++) {
                                        ?>
                                            <div class="carousel-item <?php if ($i == 0) echo 'active'; ?> position-relative img-magnifier-container">
                                                <img class="d-block w-100 cake-preview-img" src="uploads/<?php echo $file_array[$i]; ?>" alt="slide<?php echo $i; ?>" style="object-fit: cover; aspect-ratio: 1/1;">
                                                <div class="live-message-overlay cake-msg-preview"></div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Product Details -->
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 pl-xl-0 pl-lg-0 pl-md-0 border-left m-b-30 d-flex">
                            <div class="product-details p-4 w-100">
                                <div class="border-bottom pb-3 mb-3">
                                    <h2 class="mb-3"><?php echo $res['product_name']; ?></h2>
                                    <?php if ($discount > 0) { ?>
                                        <h3 class="mb-0 text-primary">
                                            <?php
                                            $discount = $res['product_discount'];
                                            $price = $res['product_price'];

                                            if ($discount > 0) {
                                                $discounted_price = $price - ($price * $discount / 100);
                                                echo "₹ " . number_format($discounted_price, 2);
                                                echo " <span style='color: red; text-decoration: line-through; font-size: 0.8em;'>₹ " . number_format($price, 2) . "</span>";
                                            } else {
                                                echo "₹ " . number_format($price, 2);
                                            }
                                            ?>
                                        </h3>

                                    <?php } else { ?>
                                        <h3 class="mb-0 text-primary">Rs. <?php echo number_format($originalPrice, 2); ?></h3>
                                    <?php } ?>
                                </div>
                                <div class="product-description">
                                    <h4 class="mb-1">Descriptions</h4>
                                    <p><?php echo $res['product_description']; ?></p>
                                    
                                    <div class="form-group mt-4 p-3 bg-light rounded" data-aos="fade-up">
                                        <label for="cakeMessage" class="font-weight-bold text-dark"><i class="fas fa-pen-fancy mr-2"></i>Live Message Preview</label>
                                        <p class="text-muted small mb-2">Type your message and see it instantly appear on the cake!</p>
                                        <input type="text" id="cakeMessage" class="form-control border-warning shadow-sm" placeholder="e.g. Happy Anniversary John ❤️" maxlength="30" oninput="updateCakeMessage(this.value)">
                                    </div>
                                    
                                    <a href="fetch_cart.php?id=<?php echo $res['product_id']; ?>&redirect=1" class="btn btn-primary btn-block btn-lg mt-4 shadow-lg btn-add-cart-bounce">Add to Cart</a>
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
                                        <h3 class="card-title"><?php echo $res['category_name']; ?></h3>
                                        <a href="shop.php?category=<?php echo $res['category_id']; ?>"><img class="card-img" src="uploads/<?php echo $res['category_image']; ?>"></a>
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