<?php
session_start();

if (empty($_SESSION['user_users_id']) || empty($_SESSION['user_users_username'])) {
    header("Location: login_users.php");
    exit();
}

require_once('config.php');

$printCount = (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) ? count($_SESSION['cart']) : 0;
$printUsername = $_SESSION['user_users_username'];
$user_id = $_SESSION['user_users_id'];

if (!isset($_GET['invoice_id']) || empty($_GET['invoice_id'])) {
    echo "<script>alert('Invalid Invoice ID!'); window.location.assign('account_users.php');</script>";
    exit();
}

$invoice_id = $_GET['invoice_id'];

// Fetch invoice details
$invoice_query = "SELECT * FROM invoices WHERE invoice_id = ? AND user_id = ?";
$stmt = mysqli_prepare($conn, $invoice_query);
mysqli_stmt_bind_param($stmt, "si", $invoice_id, $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 0) {
    echo "<script>alert('Invoice not found!'); window.location.assign('account_users.php');</script>";
    exit();
}

$invoice = mysqli_fetch_assoc($result);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CAKE KING - Order Invoice</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/userpage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        .invoice-wrapper {
            background: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            margin-bottom: 30px;
        }
        .success-icon {
            color: #28a745;
            font-size: 60px;
            margin-bottom: 20px;
        }
        .invoice-meta {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
            border-left: 5px solid #f7a392;
        }
        .invoice-meta p {
            margin-bottom: 5px;
            font-size: 15px;
        }
        .action-btns .btn {
            margin: 5px;
        }
    </style>
</head>
<body>
    <div class="dashboard-main-wrapper">
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top shadow-sm navbar-elevated">
                <a class="navbar-brand" href="index.php">CAKE KING</a>
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
                    
                    <div class="invoice-wrapper text-center" data-aos="fade-up">
                        <i class="fas fa-check-circle success-icon"></i>
                        <h2 style="font-weight: 700; color: #3d405c;">Order Placed Successfully!</h2>
                        <p class="text-muted">Thank you for shopping with CAKE KING. Your order has been received.</p>
                        
                        <div class="invoice-meta text-left mt-4" data-aos="fade-up" data-aos-delay="100">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Invoice ID:</strong> <?php echo htmlspecialchars($invoice['invoice_id']); ?></p>
                                    <p><strong>Total Amount:</strong> Rs. <?php echo number_format($invoice['total_amount'], 2); ?></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Payment Method:</strong> <?php echo htmlspecialchars($invoice['payment_method']); ?></p>
                                    <?php 
                                        $delivery_time = strtotime($invoice['delivery_date']);
                                        $display_date = $delivery_time ? date("F j, Y, g:i a", $delivery_time) : $invoice['delivery_date'];
                                    ?>
                                    <p><strong>Expected Delivery:</strong> <?php echo htmlspecialchars($display_date); ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="card text-left" data-aos="fade-up" data-aos-delay="200">
                            <h5 class="card-header">Order Items</h5>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="bg-light">
                                            <tr class="border-0">
                                                <th class="border-0">Product Name</th>
                                                <th class="border-0 text-center">Price</th>
                                                <th class="border-0 text-center">Quantity</th>
                                                <th class="border-0 text-right">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $item_query = "SELECT * FROM invoice_item WHERE invoice_id = ?";
                                            $stmt_items = mysqli_prepare($conn, $item_query);
                                            mysqli_stmt_bind_param($stmt_items, "s", $invoice_id);
                                            mysqli_stmt_execute($stmt_items);
                                            $items_result = mysqli_stmt_get_result($stmt_items);
                                            
                                            while ($item = mysqli_fetch_assoc($items_result)) {
                                            ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                                                    <td class="text-center">Rs. <?php echo number_format($item['product_price'], 2); ?></td>
                                                    <td class="text-center"><?php echo htmlspecialchars($item['quantity']); ?></td>
                                                    <td class="text-right">Rs. <?php echo number_format($item['total_price'], 2); ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                        <div class="action-btns mt-4" data-aos="fade-up" data-aos-delay="300">
                            <a href="download_invoice.php?invoice_id=<?php echo htmlspecialchars($invoice_id); ?>&view=1" target="_blank" class="btn btn-primary"><i class="fas fa-file-pdf"></i> View PDF Invoice</a>
                            <a href="download_invoice.php?invoice_id=<?php echo htmlspecialchars($invoice_id); ?>" class="btn btn-success"><i class="fas fa-download"></i> Download PDF</a>
                            <a href="index.php" class="btn btn-secondary"><i class="fas fa-home"></i> Return to Home</a>
                            <?php 
                                // Get array from cake_shop_orders if track_order is needed
                                $order_fetch = "SELECT orders_id FROM cake_shop_orders WHERE invoice_id = ?";
                                $st = mysqli_prepare($conn, $order_fetch);
                                mysqli_stmt_bind_param($st, "s", $invoice_id);
                                mysqli_stmt_execute($st);
                                $res_o = mysqli_stmt_get_result($st);
                                if ($row_o = mysqli_fetch_assoc($res_o)) {
                            ?>
                            <a href="track_order.php?order_id=<?php echo $row_o['orders_id']; ?>" class="btn btn-info" style="background-color: #f7a392; border-color: #f7a392; color: #fff;"><i class="fas fa-truck"></i> Track Order</a>
                            <?php } ?>
                        </div>

                    </div>
                    
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
