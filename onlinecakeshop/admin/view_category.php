<?php
if (isset($_GET['edit_msg']) && $_GET['edit_msg'] == 1) {
    echo "<script>
    alert('Category edited!');
    window.location.assign('view_category.php');
    </script>";
}
?>
<?php
session_start();
if (isset($_SESSION['user_admin_id']) && $_SESSION['user_admin_id'] != null) {
    $admin_username = $_SESSION['user_admin_username'];
?>
<!doctype html>
<html lang="en">

 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CAKE KING - View Category</title>
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
                    <span><i class="fas fa-bars mx-3
"></i></span>
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
                    <li class="nav-item">
                                <a class="nav-link" href="reports.php"><i class="fas fa-chart-line"></i>Reports <span class="badge badge-warning ml-2">New</span></a>
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
                                <a class="nav-link active" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"><i class="fas fa-fw fa-chart-pie"></i>Menu Categories</a>
                                <div id="submenu-3" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="view_category.php">View Categories</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="add_category.php">Add Category</a>
                                        </li>
                                    <li class="nav-item">
                                <a class="nav-link" href="reports.php"><i class="fas fa-chart-line"></i>Reports <span class="badge badge-warning ml-2">New</span></a>
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
                                    <li class="nav-item">
                                <a class="nav-link" href="reports.php"><i class="fas fa-chart-line"></i>Reports <span class="badge badge-warning ml-2">New</span></a>
                            </li>
                        </ul>
                    </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="view_orders.php"><i class="fas fa-shopping-cart
"></i>Orders</a>
                            </li>
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
                        <div class="page-header">
                            <h2 class="pageheader-title">Category</h2>
                            <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="dashboard.php" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Category</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">View category</li>
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
                            <h5 class="card-header">Category Table</h5>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first">
                                        <thead>
                                            <tr>
                                                <th>S. No.</th>
                                                <th>Name</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            require_once('../config.php');
                                            $select = "SELECT * FROM cake_shop_category";
                                            $query = mysqli_query($conn, $select);
                                            $i = 1;
                                            while ($res = mysqli_fetch_assoc($query)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $res['category_name'];?></td>
                                                <td><img src="../uploads/<?php echo $res['category_image'];?>" height="100px" width="100px"></td>
                                                <td>
                                                    <button data-toggle="modal" data-target="#exampleModal" class="btn btn-space btn-primary" onclick="edit_cat(<?php echo $res['category_id'];?>)">Edit</button>
                                                    <button onclick="delete_cat(<?php echo $res['category_id'];?>)" class="btn btn-space btn-secondary">DELETE</button>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>S. No.</th>
                                                <th>Name</th>
                                                <th>Image</th>
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
        <h5 class="modal-title">Edit category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="edit_category.php" id="form" method="post" enctype="multipart/form-data">
      <div class="modal-body">
            <div class="card table-premium">
                                <h5 class="card-header">Edit category</h5>
                                <div class="card-body">
                                    
                                        <div class="form-group">
                                            <label for="inputCategoryName">Category Name</label>
                                            <input id="inputCategoryName" type="text" name="category_name" required="" placeholder="Enter category name" autocomplete="off" class="form-control">
                                        </div>
                                        <div class="custom-file mb-3">
                                            <input type="file" class="custom-file-input" id="customFile" name="category_image">
                                            <label class="custom-file-label" for="customFile">Choose Image</label>
                                            <input type="hidden" name="hidden_category">
                                        </div>
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
    <!-- <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/popper.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script> -->
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/bootstrap.bundle.js"></script>
    <script src="../js/jquery.slimscroll.js"></script>
    <script src="../js/main-js.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/dataTables.bootstrap4.min.js"></script>
    <script src="../js/data-table.js"></script>
    <script>
        function edit_cat(category_id) {
            $.ajax({
                url:'get_category.php',
                data:'id='+category_id,
                method:'get',
                dataType:'json',
                success:function(res){
                    console.log(res);
                    $('input[name="category_name"]').val(res.category_name);
                    $('input[name="hidden_category"]').val(res.category_id);
                }
            })
        }
        function delete_cat(cat_id) {
            var flag = confirm("Do you want to delete?");
            if (flag) {
                window.location.href = "delete_category.php?cat_id="+cat_id;
            }
        }
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({duration: 800, once: true});</script>
</body>
 
</html>
<?php
}
else {
    header("Location: index.php");
}
?>