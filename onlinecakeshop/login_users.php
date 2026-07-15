<?php
session_start();
// flash-based error instead of alert
$flash_msg = '';
$flash_type = 'danger';
if (isset($_GET['login_error']) && $_GET['login_error'] == 1) {
    $flash_msg = 'Username or password does not exist.';
} elseif (isset($_GET['login_error']) && $_GET['login_error'] == 2) {
    $flash_msg = 'Invalid Captcha Code. Please try again.';
}
?>
<?php if (!empty($flash_msg)): ?>
    <div id="flash" data-message="<?php echo htmlspecialchars($flash_msg); ?>" data-type="<?php echo htmlspecialchars($flash_type); ?>"></div>
<?php endif; ?>
<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CAKE KING - Royal Delights</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/userpage.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/interactive.css">
    <link rel="stylesheet" href="fonts/fontawesome/css/fontawesome-all.css">
    <style>
    html,
    body {
        height: 100%;
        margin: 0;
        font-family: 'Circular Std', sans-serif;
    }

    body {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background: url('uploads/wedding cake/12.jpg') no-repeat center center fixed;
        background-size: cover;
        position: relative;
    }

    /* Dark Overlay */
    body::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5); /* Dark overlay to make text readable */
        z-index: 0;
    }

    .splash-container {
        position: relative;
        z-index: 1;
        max-width: 400px;
        margin: 0 auto;
    }

    .card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        background: rgba(255, 255, 255, 0.95); /* Slight transparency */
    }

    .card-header {
        background: transparent;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        padding: 30px 20px 10px;
    }

    .text-primary {
        color: #d4af37 !important; /* Gold color */
        font-family: 'Playfair Display', serif;
        font-weight: 700;
    }

    .btn-primary {
        background-color: #5d4037;
        border-color: #5d4037;
        border-radius: 50px;
        padding: 10px 0;
        font-weight: 600;
    }

    .btn-primary:hover {
        background-color: #4e342e;
        border-color: #4e342e;
    }

    .form-control {
        border-radius: 10px;
        padding: 15px;
        height: auto;
    }
    
    .footer-link {
        color: #5d4037;
        font-weight: 600;
        text-decoration: none;
    }
    </style>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body>
    <!-- ============================================================== -->
    <!-- login page  -->
    <!-- ============================================================== -->
    <div class="splash-container">
        <div class="card">
            <div class="card-header text-center">
                <a href="index.php"><h2 class="text-primary">CAKE KING</h2></a>
                <span class="splash-description">Welcome Back! Please login.</span>
            </div>
            <div class="card-body">
                <form id="form" data-parsley-validate="" method="post" action="login_check_users.php">
                    <div class="form-group">
                        <input class="form-control form-control-lg" type="text" name="users_username" data-parsley-trigger="change" required="" placeholder="Username" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-lg" id="pass1" type="password" required="" placeholder="Password" name="users_password">
                    </div>
                    <div class="form-group">
                        <div class="d-flex align-items-center mb-2">
                            <img src="captcha.php" alt="CAPTCHA" id="captcha-img" class="mr-2 border" style="border-radius:5px;">
                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="document.getElementById('captcha-img').src='captcha.php?'+Math.random()">
                                <i class="fas fa-sync-alt"></i> Reload
                            </button>
                        </div>
                        <input class="form-control form-control-lg" type="text" name="captcha_code" data-parsley-trigger="change" required="" placeholder="Enter Captcha Code" autocomplete="off">
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
                </form>
            </div>
            <div class="card-footer bg-white p-0 text-center pb-4 pt-2">
                <div class="card-footer-item card-footer-item-bordered border-0">
                    <span class="text-muted">Don't have an account?</span> 
                    <a href="register.php" class="footer-link ml-1">Create Account</a>
                </div>
            </div>
        </div>
    </div>
  
    <!-- ============================================================== -->
    <!-- end login page  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/parsley.js"></script>
    <script src="js/interactive.js"></script>
    <script>
    $('#form').parsley();
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({duration: 800, once: true});</script>
</body>
 
</html>
