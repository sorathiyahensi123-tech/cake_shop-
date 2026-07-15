<?php
session_start();

if (isset($_GET['edit_msg']) && $_GET['edit_msg'] == 1) {
    echo "<script>
    alert('Orders edited!');
    window.location.assign('view_orders.php');
    </script>";
}

if (isset($_GET['edit_msg']) && $_GET['edit_msg'] == 2) {
    echo "<script>
    alert('Orders detail edited!');
    window.location.assign('view_orders.php');
    </script>";
}

if (isset($_SESSION['user_admin_id']) && $_SESSION['user_admin_id'] != null) {
    $admin_username = $_SESSION['user_admin_username'];
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CAKE KING - View Orders</title>
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
                    <span><i class="fas fa-bars mx-3"></i></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img p-0" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><div class="user-avatar-md rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background-color: #fdf5e6; color: #d4af37; border: 2px solid #d4af37; font-size: 1.2rem;"><i class="fas fa-user-shield"></i></div></a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name"><?php echo $admin_username;?></h5>
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
                    <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">
                                Menu
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="dashboard.php"><i class="fa fa-fw fa-rocket"></i>Dashboard</a>
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
                            <li class="nav-item ">
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
                                <a class="nav-link active" href="view_orders.php"><i class="fas fa-shopping-cart"></i>Orders</a>
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
        <!-- wrapper -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">Orders</h2>
                            <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="dashboard.php" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">View orders</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card table-premium">
                            <h5 class="card-header">Orders Table</h5>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first">
                                        <thead>
                                            <tr>
                                                <th>S. No.</th>
                                                <th>Orders id</th>
                                                <th>Users id</th>
                                                <th>Delivery date & time</th>
                                                <th>Payment method</th>
                                                <th>Total amount</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            require_once('../config.php');
                                            $select = "SELECT * FROM cake_shop_orders";
                                            $query = mysqli_query($conn, $select);
                                            $i = 1;
                                            while ($res = mysqli_fetch_assoc($query)) {
                                                $deliveryDateTime = date("Y-m-d H:i", strtotime($res['delivery_date']));
                                            ?>
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $res['orders_id'];?></td>
                                                <td><?php echo $res['users_id'];?></td>
                                                <td><?php echo $deliveryDateTime; ?></td>
                                                <td><?php echo $res['payment_method'];?></td>
                                                <td>Rs. <?php echo $res['total_amount'];?></td>
                                                <td>
                                                    <?php 
                                                        $status = isset($res['order_status']) ? $res['order_status'] : 'Pending';
                                                        $badge_class = 'badge-secondary';
                                                        if($status == 'Pending') $badge_class = 'badge-warning';
                                                        if($status == 'Processing') $badge_class = 'badge-info';
                                                        if($status == 'Out for Delivery') $badge_class = 'badge-primary';
                                                        if($status == 'Delivered') $badge_class = 'badge-success';
                                                        if($status == 'Cancelled') $badge_class = 'badge-danger';
                                                    ?>
                                                    <span class="badge <?php echo $badge_class; ?>"><?php echo htmlspecialchars($status); ?></span>
                                                </td>
                                                <td>
                                                    <button data-toggle="modal" data-target="#exampleModal" class="btn btn-space btn-primary" onclick="edit_orders(<?php echo $res['orders_id'];?>)">Edit</button>
                                                    <button onclick="delete_orders(<?php echo $res['orders_id'];?>)" class="btn btn-space btn-secondary">DELETE</button>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>S. No.</th>
                                                <th>Orders id</th>
                                                <th>Users id</th>
                                                <th>Delivery date & time</th>
                                                <th>Payment method</th>
                                                <th>Total amount</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card table-premium">
                            <h5 class="card-header">Orders Detail Table</h5>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first">
                                        <thead>
                                            <tr>
                                                <th>S. No.</th>
                                                <th>Orders id</th>
                                                <th>Product name</th>
                                                <th>Quantity</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            require_once('../config.php');
                                            $select = "SELECT * FROM cake_shop_orders_detail";
                                            $query = mysqli_query($conn, $select);
                                            $i = 1;
                                            while ($res = mysqli_fetch_assoc($query)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $res['orders_id'];?></td>
                                                <td><?php echo $res['product_name'];?></td>
                                                <td><?php echo $res['quantity'];?></td>
                                                <td>
                                                    <button data-toggle="modal" data-target="#exampleModal1" class="btn btn-space btn-primary" onclick="edit_orders_detail(<?php echo $res['orders_detail_id'];?>)">Edit</button>
                                                    <button onclick="delete_orders_detail(<?php echo $res['orders_detail_id'];?>)" class="btn btn-space btn-secondary">DELETE</button>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>S. No.</th>
                                                <th>Orders id</th>
                                                <th>Product name</th>
                                                <th>Quantity</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            
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
    <div class="modal fade" id="exampleModal" data-backdrop="static" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit orders</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="edit_orders.php" id="form" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="card table-premium">
                            <h5 class="card-header">Edit orders</h5>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputUsersId">Users id</label>
                                    <input id="inputUsersId" type="number" min="1" name="users_id" required="" placeholder="Enter users id" autocomplete="off" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="inputDeliveryDate">Delivery date</label>
                                    <input type="datetime-local" id="delivery_date_time" name="delivery_date"  required="" placeholder="Enter delivery date" autocomplete="off" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="inputPaymentMethod">Payment method</label>
                                    <select id="inputPaymentMethod" name="payment_method" class="form-control">
                                        <option>Cash</option>
                                        <option>Card</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputTotalAmount">Total amount</label>
                                    <input id="inputTotalAmount" type="number" min="1" name="total_amount" required="" placeholder="Enter total amount" autocomplete="off" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="inputOrderStatus">Order Status</label>
                                    <select id="inputOrderStatus" name="order_status" class="form-control">
                                        <option value="Pending">Pending</option>
                                        <option value="Processing">Processing</option>
                                        <option value="Out for Delivery">Out for Delivery</option>
                                        <option value="Delivered">Delivered</option>
                                        <option value="Cancelled">Cancelled</option>
                                    </select>
                                </div>
                                <input type="hidden" name="hidden_orders">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-space btn-secondary">Clear</button>
                        <button type="submit" class="btn btn-space btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal1" data-backdrop="static" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit orders detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="edit_orders_detail.php" id="form" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="card table-premium">
                            <h5 class="card-header">Edit orders detail</h5>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputOrdersId">Orders id</label>
                                    <input id="inputOrdersId" type="number" min="1" name="orders_id" required="" placeholder="Enter orders id" autocomplete="off" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="inputProductName">Product name</label>
                                    <input id="inputProductName" type="text" name="product_name" required="" placeholder="Enter product name" autocomplete="off" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="inputQuantity">Quantity</label>
                                    <input id="inputQuantity" type="number" min="1" max="9" name="quantity" required="" placeholder="Enter quantity" autocomplete="off" class="form-control">
                                </div>
                                <input type="hidden" name="hidden_orders_detail">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-space btn-secondary">Clear</button>
                        <button type="submit" class="btn btn-space btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/bootstrap.bundle.js"></script>
    <script src="../js/jquery.slimscroll.js"></script>
    <script src="../js/main-js.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/dataTables.bootstrap4.min.js"></script>
    <script src="../js/data-table.js"></script>
    <script>
    function edit_orders(orders_id) {
        $.ajax({
            url:'get_orders.php',
            data:'id='+orders_id,
            method:'get',
            dataType:'json',
            success:function(res){
                console.log(res);
                $('input[name="users_id"]').val(res.users_id);
                $('input[name="delivery_date"]').val(res.delivery_date);
                $('select[name="payment_method"]').val(res.payment_method);
                $('input[name="total_amount"]').val(res.total_amount);
                $('select[name="order_status"]').val(res.order_status || 'Pending');
                $('input[name="hidden_orders"]').val(res.orders_id);
            }
        })
    }
    function delete_orders(orders_id) {
        var flag = confirm("Do you want to delete?");
        if (flag) {
            window.location.href = "delete_orders.php?orders_id="+orders_id;
        }
    }
    function edit_orders_detail(orders_detail_id) {
        $.ajax({
            url:'get_orders_detail.php',
            data:'id='+orders_detail_id,
            method:'get',
            dataType:'json',
            success:function(res){
                console.log(res);
                $('input[name="orders_id"]').val(res.orders_id);
                $('input[name="product_name"]').val(res.product_name);
                $('input[name="quantity"]').val(res.quantity);
                $('input[name="hidden_orders_detail"]').val(res.orders_detail_id);
            }
        })
    }
    function delete_orders_detail(orders_detail_id) {
        var flag = confirm("Do you want to delete?");
        if (flag) {
            window.location.href = "delete_orders_detail.php?orders_detail_id="+orders_detail_id;
        }
    }
    </script>
    <script>
document.addEventListener("DOMContentLoaded", function () {
    const dateTimeInput = document.getElementById("delivery_date_time");

    if (dateTimeInput) {
        const now = new Date();
        const todayStr = now.toISOString().split("T")[0];

        // Calculate max date (today + 3 days)
        const maxDate = new Date();
        maxDate.setDate(now.getDate() + 3);
        const maxDateStr = maxDate.toISOString().split("T")[0];

        // Calculate 60 minutes from now
        const minTime = new Date(now.getTime() + 60 * 60 * 1000);
        const minDateTimeStr = minTime.toISOString().slice(0, 16);

        // Set min and max attributes
        dateTimeInput.setAttribute("min", minDateTimeStr);
        dateTimeInput.setAttribute("max", `${maxDateStr}T23:59`);

        // Validate selected date and time
        dateTimeInput.addEventListener("change", function () {
            const selectedDateTime = new Date(this.value);
            const minAllowedTime = new Date();

            // If today is selected, enforce 60-minute rule
            if (this.value.startsWith(todayStr)) {
                minAllowedTime.setMinutes(minAllowedTime.getMinutes() + 60);
            } else {
                minAllowedTime.setHours(0, 0, 0, 0);
            }

            const maxAllowedTime = new Date();
            maxAllowedTime.setDate(now.getDate() + 3);
            maxAllowedTime.setHours(23, 59, 59);

            if (selectedDateTime < minAllowedTime || selectedDateTime > maxAllowedTime) {
                alert("Please select a time at least 60 minutes ahead if choosing today!");
                this.value = "";
            }
        });
    }
});
</script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({duration: 800, once: true});</script>
</body>
</html>
<?php
} else {
    header("Location: index.php");
}
?>