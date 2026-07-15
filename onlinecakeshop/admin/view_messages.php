<?php
require_once('../config.php');
session_start();

if (!isset($_SESSION['user_admin_id']) || $_SESSION['user_admin_id'] == null) {
    header("Location: index.php");
    exit();
}
$admin_username = $_SESSION['user_admin_username'];

// Handle Deletion
if (isset($_GET['delete'])) {
    $del = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM cake_shop_messages WHERE message_id = $del");
    header("Location: view_messages.php?msg=deleted");
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CAKE KING - Customer Messages</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link href="../fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../fonts/fontawesome/css/fontawesome-all.css">
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
                            <li class="nav-item"><a class="nav-link" href="reports.php"><i class="fas fa-chart-line"></i>Reports</a></li>
                            <li class="nav-item"><a class="nav-link active" href="view_messages.php"><i class="fas fa-envelope"></i>Messages <span class="badge badge-warning ml-2">New</span></a></li>
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
                            <h2 class="pageheader-title">Customer Messages <span class="badge badge-warning" style="font-size: 0.5em; vertical-align: middle;">Advanced Feature</span></h2>
                            <p class="pageheader-text">Inbox for customer inquiries sent from the Contact Us page.</p>
                        </div>
                    </div>
                </div>

                <?php if(isset($_GET['msg']) && $_GET['msg'] == 'deleted'): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Message deleted successfully!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <?php endif; ?>

                <div class="row mt-2" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card table-premium pt-3 px-3">
                            <h4 class="mb-3 px-2" style="color: #3b2f2f; font-family: 'Playfair Display', serif; font-weight: 700;">Received Messages</h4>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th width="15%">Date</th>
                                            <th width="15%">Customer</th>
                                            <th width="20%">Subject</th>
                                            <th width="40%">Message</th>
                                            <th width="10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $msg_q = mysqli_query($conn, "SELECT * FROM cake_shop_messages ORDER BY created_at DESC");
                                        if (mysqli_num_rows($msg_q) > 0) {
                                            while ($mrow = mysqli_fetch_assoc($msg_q)) {
                                                echo "<tr>";
                                                echo "<td><small class='text-muted'>" . date('M j, Y H:i', strtotime($mrow['created_at'])) . "</small></td>";
                                                echo "<td><strong>" . htmlspecialchars($mrow['customer_name']) . "</strong><br><a href='mailto:" . htmlspecialchars($mrow['customer_email']) . "' style='font-size:0.85em;'>" . htmlspecialchars($mrow['customer_email']) . "</a></td>";
                                                echo "<td>" . htmlspecialchars($mrow['subject']) . "</td>";
                                                echo "<td><span style='white-space: pre-wrap;'>" . htmlspecialchars($mrow['message_body']) . "</span></td>";
                                                echo "<td><a href='view_messages.php?delete=" . $mrow['message_id'] . "' class='btn btn-sm btn-outline-danger' onclick='return confirm(\"Are you sure you want to delete this message?\");'><i class='fas fa-trash'></i> Delete</a></td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='5' class='text-center py-4'><i class='fas fa-envelope-open-text mb-2' style='font-size: 2rem; color:#ccc;'></i><br>Inbox is empty. No messages yet.</td></tr>";
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
