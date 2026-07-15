<?php
require_once('../config.php');
session_start();

if (!isset($_SESSION['user_admin_id']) || $_SESSION['user_admin_id'] == null) {
    header("Location: index.php");
    exit();
}

$admin_username = $_SESSION['user_admin_username'];

// Fetch overall stats
$total_revenue_query = mysqli_query($conn, "SELECT SUM(total_amount) as total FROM cake_shop_orders WHERE order_status = 'Delivered'");
$total_revenue = mysqli_fetch_assoc($total_revenue_query)['total'];
$total_revenue = $total_revenue ? $total_revenue : 0;

$total_orders_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM cake_shop_orders");
$total_orders = mysqli_fetch_assoc($total_orders_query)['total'];

$pending_orders_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM cake_shop_orders WHERE order_status = 'Pending'");
$pending_orders = mysqli_fetch_assoc($pending_orders_query)['total'];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CAKE KING - Sales & Reports</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link href="../fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="../css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="css/admin-custom.css?v=1775031340">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body>
    <div class="dashboard-main-wrapper">
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top shadow-sm navbar-elevated">
                <a class="navbar-brand" href="dashboard.php">CAKE KING</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
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
        <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">Menu</li>
                            <li class="nav-item"><a class="nav-link" href="dashboard.php"><i class="fa fa-fw fa-rocket"></i>Dashboard</a></li>
                            <li class="nav-item"><a class="nav-link" href="view_users.php"><i class="fa fa-fw fa-user-circle"></i>Users</a></li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" data-target="#submenu-3"><i class="fas fa-fw fa-chart-pie"></i>Menu Categories</a>
                                <div id="submenu-3" class="collapse submenu">
                                    <ul class="nav flex-column">
                                        <li class="nav-item"><a class="nav-link" href="view_category.php">View Categories</a></li>
                                        <li class="nav-item"><a class="nav-link" href="add_category.php">Add Category</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" data-target="#submenu-4"><i class="fab fa-product-hunt"></i>Menu Items</a>
                                <div id="submenu-4" class="collapse submenu">
                                    <ul class="nav flex-column">
                                        <li class="nav-item"><a class="nav-link" href="view_product.php">View Items</a></li>
                                        <li class="nav-item"><a class="nav-link" href="add_product.php">Add Item</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="view_orders.php"><i class="fas fa-shopping-cart"></i>Orders</a></li>
                            <li class="nav-item"><a class="nav-link active" href="reports.php"><i class="fas fa-chart-line"></i>Reports <span class="badge badge-warning ml-2">New</span></a></li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>

        <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header" data-aos="fade-down">
                            <h2 class="pageheader-title">Sales & Reports <span class="badge badge-warning" style="font-size: 0.5em; vertical-align: middle;">Advanced Feature</span></h2>
                            <p class="pageheader-text">Analyze your store's performance and track revenue.</p>
                        </div>
                    </div>
                </div>

                <!-- Report Highlight Cards -->
                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-md-4">
                        <div class="card-metric text-center" style="border-bottom-color: #28a745;">
                            <i class="fas fa-wallet metric-icon" style="color: rgba(40,167,69,0.1);"></i>
                            <h3>Total Revenue</h3>
                            <div class="metric-value">Rs. <?php echo number_format($total_revenue, 2); ?></div>
                            <small class="text-muted">From delivered orders</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-metric text-center" style="border-bottom-color: #17a2b8;">
                            <i class="fas fa-shopping-bag metric-icon" style="color: rgba(23,162,184,0.1);"></i>
                            <h3>Total Orders</h3>
                            <div class="metric-value"><?php echo $total_orders; ?></div>
                            <small class="text-muted">All time</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-metric text-center" style="border-bottom-color: #ffc107;">
                            <i class="fas fa-clock metric-icon" style="color: rgba(255,193,7,0.1);"></i>
                            <h3>Pending Orders</h3>
                            <div class="metric-value"><?php echo $pending_orders; ?></div>
                            <a href="view_orders.php" class="text-warning font-weight-bold">Review Now</a>
                        </div>
                    </div>
                </div>

                <!-- Top Products Table -->
                <div class="row mt-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card table-premium pt-3 px-3">
                            <div class="d-flex justify-content-between align-items-center mb-3 px-2">
                                <h4 class="mb-0" style="color: #3b2f2f; font-family: 'Playfair Display', serif; font-weight: 700;">Top Selling Products</h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Total Units Sold</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Aggregate orders detail
                                        $top_products_q = "SELECT product_name, SUM(quantity) as total_sold FROM cake_shop_orders_detail GROUP BY product_name ORDER BY total_sold DESC LIMIT 10";
                                        $top_products_r = mysqli_query($conn, $top_products_q);
                                        if (mysqli_num_rows($top_products_r) > 0) {
                                            while ($trow = mysqli_fetch_assoc($top_products_r)) {
                                                echo "<tr>";
                                                echo "<td><strong>" . htmlspecialchars($trow['product_name']) . "</strong></td>";
                                                echo "<td><span class='badge badge-info'>" . $trow['total_sold'] . "</span></td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='2' class='text-center'>No sales data yet.</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="footer mt-auto" style="border-top: 1px solid #eaeaea; background: #fff; padding: 20px;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12" style="color: #888;">
                            CAKE KING Premium Bakery Admin Panel.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/bootstrap.bundle.js"></script>
    <script src="../js/jquery.slimscroll.js"></script>
    <script src="../js/main-js.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({duration: 800, once: true});</script>
</body>
</html>
