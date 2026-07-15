<?php
session_start();
$flash_msg = '';
$flash_type = 'warning';
if (isset($_GET['register_msg']) && $_GET['register_msg'] == 1) {
    $flash_msg = 'Username already taken. Please choose another.';
} elseif (isset($_GET['register_msg']) && $_GET['register_msg'] == 2) {
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
        text-align: center;
    }
    
    .card-header h3 {
        color: #d4af37;
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        margin-bottom: 5px;
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

    .text-secondary {
        color: #5d4037 !important;
        font-weight: 600;
    }
    </style>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<!-- ============================================================== -->
<!-- signup form  -->
<!-- ============================================================== -->

<body>
    <!-- ============================================================== -->
    <!-- signup form  -->
    <!-- ============================================================== -->
    <form id="form" class="splash-container" data-parsley-validate="" method="post" action="insert_users.php">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-1">Join the Royalty</h3>
                <p>Please enter your information.</p>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <input class="form-control form-control-lg" type="text" name="users_username" data-parsley-trigger="change" required="" placeholder="Username" autocomplete="off">
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" type="email" name="users_email" data-parsley-trigger="change" required="" placeholder="E-mail" autocomplete="off">
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" id="pass1" type="password" required="" placeholder="Password" name="users_password">
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" data-parsley-equalto="#pass1" type="password" required="" placeholder="Confirm password">
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" type="tel" name="users_mobile" data-parsley-trigger="change" required="" placeholder="Mobile no." pattern="[0-9]{10}" autocomplete="off">
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" type="text" name="users_address" data-parsley-trigger="change" required="" placeholder="Address" autocomplete="off">
                </div>
                <div class="form-group">
                    <div class="d-flex align-items-center mb-2">
                        <img src="captcha.php" alt="CAPTCHA" id="captcha-img-reg" class="mr-2 border" style="border-radius:5px;">
                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="document.getElementById('captcha-img-reg').src='captcha.php?'+Math.random()">
                            <i class="fas fa-sync-alt"></i> Reload
                        </button>
                    </div>
                    <input class="form-control form-control-lg" type="text" name="captcha_code" data-parsley-trigger="change" required="" placeholder="Enter Captcha Code" autocomplete="off">
                </div>
                <div class="form-group pt-2">
                    <button class="btn btn-block btn-primary" type="submit">Register</button>
                </div>
            </div>
            <div class="card-footer bg-white text-center pb-4">
                <p>Already member? <a href="login_users.php" class="text-secondary">Login Here.</a></p>
            </div>
        </div>
    </form>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/interactive.js"></script>
    <script src="js/parsley.js"></script>
    <script src="js/main-js.js"></script>
    <script>
    $('#form').parsley();
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({duration: 800, once: true});</script>
</body>

 
</html>