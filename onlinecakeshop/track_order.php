<?php
session_start();

if (empty($_SESSION['user_users_id']) || empty($_SESSION['user_users_username'])) {
    header("Location: login_users.php");
    exit();
}

require_once('config.php');

$printCount = (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) ? count($_SESSION['cart']) : 0;
$printUsername = $_SESSION['user_users_username'];
$users_id = $_SESSION['user_users_id'];

$show_form = false;
$order_id = 0;
$step = 1;
$delivery_date_str = '';
$order = null;
$error_msg = '';

if (!isset($_GET['order_id']) || empty($_GET['order_id'])) {
    $show_form = true;
} else {
    $order_id = intval($_GET['order_id']);

    // Fetch order details
    $select_order = "SELECT * FROM cake_shop_orders WHERE orders_id = $order_id AND users_id = $users_id";
    $query_order = mysqli_query($conn, $select_order);

    if (mysqli_num_rows($query_order) == 0) {
        $show_form = true;
        $error_msg = "Order not found! Please check your Order ID.";
    } else {
        $order = mysqli_fetch_assoc($query_order);

        // Calculate delivery status logically based on current date vs delivery date
        $delivery_date = $order['delivery_date'] ?? '';
        $delivery_timestamp = !empty($delivery_date) ? strtotime($delivery_date) : 0;
        $current_timestamp = time();

        if ($delivery_timestamp === 0) {
            $step = 1;
        } elseif ($current_timestamp >= $delivery_timestamp) {
            $step = 4;
        } elseif ($delivery_timestamp - $current_timestamp <= 86400) { // Within 24 hours
            $step = 3;
        } elseif ($delivery_timestamp - $current_timestamp <= 172800) { // Within 48 hours
            $step = 2;
        } else {
            $step = 1;
        }

        $delivery_date_str = $delivery_timestamp > 0 ? date("F j, Y, g:i a", $delivery_timestamp) : 'Not specified';
    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CAKE KING - Track Order #<?php echo htmlspecialchars($order_id); ?></title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/userpage.css">
    <link rel="stylesheet" href="fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        .tracking-wrapper {
            background: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            margin-bottom: 30px;
        }
        .tracking-timeline {
            position: relative;
            padding-left: 50px;
            margin-top: 40px;
        }
        .tracking-timeline::before {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            left: 23px;
            width: 4px;
            background: #e9ecef;
            border-radius: 2px;
        }
        .track-step {
            position: relative;
            margin-bottom: 40px;
            opacity: 0.4;
            transition: all 0.4s ease;
            filter: grayscale(100%);
        }
        .track-step:last-child {
            margin-bottom: 0;
        }
        .track-step.active {
            opacity: 1;
            filter: grayscale(0%);
        }
        .track-step .icon {
            position: absolute;
            left: -50px;
            top: 0;
            width: 50px;
            height: 50px;
            background: #e9ecef;
            border-radius: 50%;
            text-align: center;
            line-height: 50px;
            font-size: 20px;
            color: #6c757d;
            z-index: 1;
            transition: all 0.4s ease;
            box-shadow: 0 0 0 5px #fff;
        }
        .track-step.active .icon {
            background: #f7a392;
            color: #fff;
            box-shadow: 0 0 0 8px rgba(247, 163, 146, 0.2);
            /* Add pulse animation for the current active step (highest active step) */
        }
        .track-step.current .icon {
            animation: pulse-ring 2s infinite;
        }
        @keyframes pulse-ring {
            0% { box-shadow: 0 0 0 0 rgba(247, 163, 146, 0.7); }
            70% { box-shadow: 0 0 0 15px rgba(247, 163, 146, 0); }
            100% { box-shadow: 0 0 0 0 rgba(247, 163, 146, 0); }
        }
        .track-step .content {
            padding-top: 10px;
        }
        .track-step h4 {
            font-size: 18px;
            font-weight: 700;
            color: #3d405c;
            margin-bottom: 5px;
        }
        .track-step p {
            color: #71748d;
            margin-bottom: 0;
            font-size: 14px;
        }
        .order-meta-info {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
            border-left: 5px solid #f7a392;
        }
        .order-meta-info p {
            margin-bottom: 5px;
            font-size: 15px;
        }
        .order-meta-info strong {
            color: #3d405c;
        }
        .back-btn {
            display: inline-block;
            margin-bottom: 20px;
            color: #f7a392;
            font-weight: 600;
        }
        .back-btn:hover {
            color: #e58d7c;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="dashboard-main-wrapper">
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top shadow-sm navbar-elevated">
                <a class="navbar-brand" href="#">CAKE KING</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span><i class="fas fa-bars mx-3"></i></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i> <span class="badge badge-pill badge-secondary"><?php echo $printCount; ?></span></a></li>
                        <li class="nav-item dropdown nav-user ml-3">
                            <a class="nav-link nav-user-img p-0" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="user-avatar-md rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background-color: #fdf5e6; color: #d4af37; border: 2px solid #d4af37; font-size: 1.2rem;">
                                        <i class="fas fa-user"></i>
                                    </div>
                                </a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name"><?php echo htmlspecialchars($printUsername); ?></h5>
                                </div>
                                <a class="dropdown-item" href="account_users.php"><i class="fas fa-user mr-2"></i>Account</a>
                                        <a class="dropdown-item" href="account_users.php#orders"><i class="fas fa-box-open mr-2"></i>Track Orders</a>
                                <a class="dropdown-item" href="logout_users.php"><i class="fas fa-power-off mr-2"></i>Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>

        <div class="container-fluid dashboard-content" style="padding-top: 100px;">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-10 col-md-12 col-sm-12 col-12">
                    <a href="account_users.php" class="back-btn"><i class="fas fa-arrow-left"></i> Back to My Account</a>

                    <?php if ($show_form): ?>
                    <div class="tracking-wrapper text-center" data-aos="fade-up">
                        <h2 style="font-weight: 700; color: #3d405c; margin-bottom: 20px;">Track Your Order</h2>
                        <i class="fas fa-search-location" style="font-size: 4rem; color: #f7a392; margin-bottom: 20px;"></i>
                        <p class="text-muted mb-4">Enter your Order ID to track its current status and view details.</p>
                        
                        <?php if(!empty($error_msg)): ?>
                            <div class="alert alert-danger mx-auto" style="max-width: 400px;"><?php echo htmlspecialchars($error_msg); ?></div>
                        <?php endif; ?>

                        <form action="track_order.php" method="GET" class="mx-auto" style="max-width: 400px;">
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" name="order_id" placeholder="Enter Order ID" required style="border-radius: 50px 0 0 50px; padding: 10px 20px;">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit" style="border-radius: 0 50px 50px 0; background-color: #f7a392; border-color: #f7a392;">Track</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php else: ?>
                    <div class="tracking-wrapper" data-aos="fade-up">
                        <div class="text-center mb-4">
                            <h2 style="font-weight: 700; color: #3d405c;">Track Your Order</h2>
                            <p class="text-muted">Order #<?php echo htmlspecialchars($order_id); ?></p>
                        </div>
                        
                        <div class="order-meta-info" data-aos="fade-up" data-aos-delay="100">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Invoice ID:</strong> <?php echo htmlspecialchars((string)($order['invoice_id'] ?? '')); ?></p>
                                    <p><strong>Total Amount:</strong> Rs. <?php echo htmlspecialchars((string)($order['total_amount'] ?? '')); ?></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Payment Method:</strong> <?php echo htmlspecialchars((string)($order['payment_method'] ?? '')); ?></p>
                                    <p><strong>Expected Delivery:</strong> <?php echo htmlspecialchars($delivery_date_str); ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="tracking-timeline">
                            <div class="track-step <?php echo $step >= 1 ? 'active' : ''; ?> <?php echo $step == 1 ? 'current' : ''; ?>" data-aos="fade-up" data-aos-delay="200">
                                <div class="icon"><i class="fas fa-clipboard-check"></i></div>
                                <div class="content">
                                    <h4>Order Placed</h4>
                                    <p>We have received your order and payment details.</p>
                                </div>
                            </div>
                            
                            <div class="track-step <?php echo $step >= 2 ? 'active' : ''; ?> <?php echo $step == 2 ? 'current' : ''; ?>" data-aos="fade-up" data-aos-delay="300">
                                <div class="icon"><i class="fas fa-birthday-cake"></i></div>
                                <div class="content">
                                    <h4>Preparing Order</h4>
                                    <p>Our expert bakers are preparing and decorating your cake.</p>
                                </div>
                            </div>
                            
                            <div class="track-step <?php echo $step >= 3 ? 'active' : ''; ?> <?php echo $step == 3 ? 'current' : ''; ?>" data-aos="fade-up" data-aos-delay="400">
                                <div class="icon"><i class="fas fa-shipping-fast"></i></div>
                                <div class="content">
                                    <h4>Out for Delivery</h4>
                                    <p>Your order has been dispatched and is on its way to you.</p>
                                </div>
                            </div>
                            
                            <div class="track-step <?php echo $step >= 4 ? 'active' : ''; ?> <?php echo $step == 4 ? 'current' : ''; ?>" data-aos="fade-up" data-aos-delay="500">
                                <div class="icon"><i class="fas fa-box-open"></i></div>
                                <div class="content">
                                    <h4>Delivered</h4>
                                    <p>Your cake has been delivered successfully. Enjoy!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card" data-aos="fade-up" data-aos-delay="600">
                        <h5 class="card-header">Order Items</h5>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="bg-light">
                                        <tr class="border-0">
                                            <th class="border-0">Product Name</th>
                                            <th class="border-0 text-center">Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $select_items = "SELECT * FROM cake_shop_orders_detail WHERE orders_id = $order_id";
                                        $query_items = mysqli_query($conn, $select_items);
                                        if ($query_items) {
                                            while ($item = mysqli_fetch_assoc($query_items)) {
                                        ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars((string)($item['product_name'] ?? '')); ?></td>
                                                    <td class="text-center"><?php echo htmlspecialchars((string)($item['quantity'] ?? '')); ?></td>
                                                </tr>
                                        <?php 
                                            }
                                        } 
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    
                </div>
            </div>
        </div>

        <div class="footer mt-auto">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 d-flex align-items-center justify-content-center justify-content-md-start">
                        <div class="footer-links">
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
    <script src="js/main-js.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({duration: 800, once: true});</script>
</body>
</html>
