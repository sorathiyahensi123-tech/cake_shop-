<?php
session_start();
require_once('config.php');

$flash_msg = '';
$flash_type = 'info';

// Handle Contact Form Submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_message'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    
    $insert_query = "INSERT INTO cake_shop_messages (customer_name, customer_email, subject, message_body) VALUES ('$name', '$email', '$subject', '$message')";
    if (mysqli_query($conn, $insert_query)) {
        $flash_msg = "Your message has been sent successfully! Our team will get back to you soon.";
        $flash_type = "success";
    } else {
        $flash_msg = "Failed to send message. Please try again.";
        $flash_type = "danger";
    }
}

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

// Default avatar
$userAvatar = 'uploads/default-image.jpg';
if (!file_exists($userAvatar)) {
    $userAvatar = 'https://via.placeholder.com/150';
}
?>
<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CAKE KING - Contact Us</title>
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
                            // load categories for dropdown
                            $categoriesNav = [];
                            $cat_q = mysqli_query($conn, "SELECT category_id, category_name FROM cake_shop_category");
                            if ($cat_q) {
                                while ($row = mysqli_fetch_assoc($cat_q)) {
                                    $categoriesNav[] = $row;
                                }
                            }
                        ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="menuDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                            <li class="nav-item"><a class="nav-link active" href="contact.php">Contact</a></li>
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
        
        <?php if (!empty($flash_msg)): ?>
            <div id="flash" data-message="<?php echo htmlspecialchars($flash_msg); ?>" data-type="<?php echo htmlspecialchars($flash_type); ?>"></div>
        <?php endif; ?>
        
        <div class="container-fluid dashboard-content">    
             <div class="row mb-5">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center mt-5" data-aos="fade-down">
                    <h5 class="text-gold text-uppercase" style="font-size: 0.9rem; letter-spacing: 2px; font-weight: 700; color: #e6a836;">Contact Us</h5>
                    <h1 class="display-4 font-weight-bold mb-3" style="font-family: 'Playfair Display', serif; color: #5d4037;">Get in Touch</h1>
                    <p class="lead mx-auto mb-5" style="max-width: 700px; color: #777; font-family: 'Open Sans', sans-serif;">
                        Have a question, feedback, or custom cake request? We'd love to hear from you. Send us a message and our team will get back to you shortly.
                    </p>
                </div>
            </div>

            <div class="row mx-5 justify-content-center mb-5" data-aos="fade-up">
                <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12 col-12">
                    <div class="card shadow-lg border-0" style="border-radius: 20px; overflow: hidden;">
                        <div class="row no-gutters">
                            <!-- Left Info side -->
                            <div class="col-md-5 p-5 d-flex flex-column justify-content-center" style="background-color: #3b2f2f; color: #f8f9fa;">
                                <h3 class="font-weight-bold mb-4" style="color: #d4af37; font-family: 'Playfair Display', serif;">Contact Information</h3>
                                
                                <div class="mb-4">
                                    <h5 class="mb-2" style="color: #e0d5c1;"><i class="fas fa-map-marker-alt mr-2" style="color: #d4af37;"></i> Address</h5>
                                    <p class="ml-4" style="color: #aaa;">
                                         G-5, SHIV PALACE,<br>KATHODARA GAM, GADHPUR ROAD,<br>SURAT-394326
                                    </p>
                                </div>

                                <div class="mb-4">
                                    <h5 class="mb-2" style="color: #e0d5c1;"><i class="fas fa-envelope mr-2" style="color: #d4af37;"></i> Email</h5>
                                    <p class="ml-4" style="color: #aaa;">
                                         heerdairy@gmail.com
                                    </p>
                                </div>

                                <div class="mb-4">
                                    <h5 class="mb-2" style="color: #e0d5c1;"><i class="fas fa-phone mr-2" style="color: #d4af37;"></i> Call Us</h5>
                                    <p class="ml-4" style="color: #aaa;">
                                         (+91) 97235 26024<br>(+91) 79907 13799
                                    </p>
                                </div>
                            </div>
                            <!-- Right Form Side -->
                            <div class="col-md-7 bg-white p-5">
                                <h3 class="font-weight-bold mb-4" style="color: #5d4037; font-family: 'Playfair Display', serif;">Send us a Message</h3>
                                <form action="contact.php" method="POST">
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <input type="text" name="name" class="form-control" placeholder="Your Name" required style="border-radius: 50px; padding: 10px 20px; border: 1px solid #ddd;">
                                        </div>
                                        <div class="col-md-6 mt-3 mt-md-0">
                                            <input type="email" name="email" class="form-control" placeholder="Your Email" required style="border-radius: 50px; padding: 10px 20px; border: 1px solid #ddd;">
                                        </div>
                                    </div>
                                    <div class="form-group mt-3">
                                        <input type="text" name="subject" class="form-control" placeholder="Subject" required style="border-radius: 50px; padding: 10px 20px; border: 1px solid #ddd;">
                                    </div>
                                    <div class="form-group mt-3">
                                        <textarea name="message" class="form-control" rows="5" placeholder="Your Message" required style="border-radius: 20px; padding: 15px 20px; border: 1px solid #ddd; resize: none;"></textarea>
                                    </div>
                                    <button type="submit" name="submit_message" class="btn btn-primary mt-3 btn-block" style="border-radius: 50px; padding: 12px; font-weight: bold; background-color: #d4af37; border: none; color: #fff; box-shadow: 0 4px 10px rgba(212,175,55,0.3);">Send Message <i class="fas fa-paper-plane ml-2"></i></button>
                                </form>
                            </div>
                        </div>
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
    <script src="js/interactive.js"></script>
    <script src="js/main-js.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({duration: 800, once: true});</script>
</body>
 
</html>