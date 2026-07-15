<?php
// flash messages rather than blocking alerts
$flash_msg = '';
$flash_type = 'info';
if (isset($_GET['remove_success']) && $_GET['remove_success'] == 1) {
    $flash_msg = 'Product removed!';
    $flash_type = 'warning';
}
if (isset($_GET['order_success']) && isset($_GET['invoice_id']) && $_GET['order_success'] == 1) {
    $invoice_id = $_GET['invoice_id'];
    $flash_msg = 'Order placed successfully! (Invoice #'.$invoice_id.')';
    $flash_type = 'success';
}
?>
<?php if (!empty($flash_msg)): ?>
    <div id="flash" data-message="<?php echo htmlspecialchars($flash_msg); ?>" data-type="<?php echo htmlspecialchars($flash_type); ?>"></div>
<?php endif; ?>
<?php
session_start();
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

// Default avatar path (check if the file exists)
$userAvatar = 'uploads/default-image.jpg';
if (!file_exists($userAvatar)) {
    $userAvatar = 'https://via.placeholder.com/150'; // Temporary placeholder if path fails
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CAKE KING - Cart</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/userpage.css">
    <link rel="stylesheet" href="css/interactive.css">
    <link rel="stylesheet" href="fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="css/owl.theme.default.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/airbnb.css">
    <style>
        /* Cursor ko hide karne ke liye */
        .no-cursor {
            caret-color: transparent;
            /* Text cursor hide karega */
        }

        /* Input ko focus hone se rokne ke liye */
        .no-cursor:focus {
            outline: none;
        }
    </style>
    <style>
        .table-fixed {
            table-layout: fixed;
            width: 100%;
        }

        .table-fixed th,
        .table-fixed td {
            width: 16.66%;
            /* 6 columns ke liye equal width */
            text-align: left;
            vertical-align: middle;
            word-wrap: break-word;
        }
    </style>
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
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Shop</a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink1">
                                <?php
                                require_once('config.php');
                                $select = "SELECT * FROM cake_shop_category";
                                $query = mysqli_query($conn, $select);
                                while ($res = mysqli_fetch_assoc($query)) {
                                ?>
                                    <a class="dropdown-item" href="shop.php?category=<?php echo $res['category_id']; ?>">
                                        <?php echo $res['category_name']; ?>
                                    </a>
                                <?php
                                }
                                ?>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="offers.php">Offers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="cart.php"><i class="fas fa-shopping-cart"></i> <span class="badge badge-pill badge-secondary"><?php echo $printCount; ?></span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">About us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">Contact</a>
                        </li>
                        <li class="nav-item dropdown nav-user ml-3">
                            <a class="nav-link nav-user-img p-0" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="user-avatar-md rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background-color: #fdf5e6; color: #d4af37; border: 2px solid #d4af37; font-size: 1.2rem;">
                                        <i class="fas fa-user"></i>
                                    </div>
                                </a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name"><?php echo $printUsername; ?></h5>
                                    <span class="status"></span><span class="ml-2">Available</span>
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
            </nav>
        </div>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->

        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <!-- <div class="dashboard-wrapper"> -->
        <div class="container-fluid dashboard-content">

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title">Cart</h2>
                        <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php" class="breadcrumb-link">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Your cart</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mx-5">

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-fixed">
                                    <thead>
                                        <tr>
                                            <th>S. No.</th>
                                            <th>Product Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <form method="post" id="cartForm" action="insert_orders.php" onsubmit="updateTotalAmount()">
                                        <script>
                                            // Prevent COD selection on form submit if total > 500
                                            document.querySelector("form").addEventListener("submit", function(e) {
                                                let totalAmount = parseFloat(document.querySelector("input[name='hidden_total_amount']").value);
                                                let paymentMethod = document.getElementById("paymentMethod").value;

                                                if (totalAmount > 500 && paymentMethod === "Cash") {
                                                    showToast("Cash on Delivery is not available for orders above ₹500. Please select another payment method.", "warning");
                                                    e.preventDefault(); // Stop form submission
                                                }
                                            });
                                        </script>
                                        <tbody>
                                            <?php
                                            if ($printCount == 0) {
                                            ?>
                                                <tr>
                                                    <td colspan="6" style="text-align: center; vertical-align: middle;">Your cart is empty!</td>
                                                </tr>
                                            <?php } else { ?>
                                                <?php
                                                $total_amount = 0;
                                                require_once('config.php');
                                                for ($i = 0; $i < count($_SESSION['cart']); $i++) {
                                                    $pid = intval($_SESSION['cart'][$i]);
                                                    if ($pid <= 0) continue;
                                                    $select = "SELECT * FROM cake_shop_product where product_id = $pid";
                                                    $query = mysqli_query($conn, $select);
                                                    $j = $i;
                                                    while ($res = mysqli_fetch_assoc($query)) {
                                                        // Calculate discount
                                                        $original_price = $res['product_price'];
                                                        $discounted_price = ($original_price > 800) ? $original_price - ($original_price * 0.20) : $original_price;

                                                        // Quantity le lo form se:
                                                        $quantity = isset($_POST['product_quantity'][$i]) ? (int)$_POST['product_quantity'][$i] : 1;

                                                        // Total amount mein quantity add karo:
                                                        $total_amount += $discounted_price * $quantity;
                                                ?>
                                                        <tr>
                                                            <td><?php echo ++$j; ?></td>
                                                            <td>
                                                                <?php echo $res['product_name']; ?>
                                                                <input type="hidden" name="hidden_product_name[]" value="<?php echo $res['product_name']; ?>">
                                                                <div class="mt-2">
                                                                    <input type="text" name="name_on_cake[]" class="form-control form-control-sm" placeholder="Message on Cake (Optional)" maxlength="50" style="font-size: 0.85em;">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div>
                                                                    ₹ <span style="<?php echo ($original_price > 800) ? 'color: green;' : ''; ?>"><?php echo number_format($discounted_price, 2); ?></span>
                                                                    <?php if ($original_price > 800) { ?>
                                                                        <div style="font-size: 0.8em; color: red; text-decoration: line-through;">₹ <?php echo number_format($original_price, 2); ?></div>
                                                                    <?php } ?>
                                                                    <input type="hidden" name="hidden_product_price[]" value="<?php echo $discounted_price; ?>">
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <input class="form-control no-cursor" type="number" min="1" max="9" step="1" value="1" name="product_quantity[]" onchange="prodTotal(this)" onkeydown="return false">
                                                            </td>
                                                            <td>
                                                                <span>₹ <?php echo number_format($discounted_price * $quantity, 2, '.', ''); ?></span>
                                                                <input type="hidden" name="hidden_product_total[]" value="<?php echo number_format($discounted_price * $quantity, 2, '.', ''); ?>">
                                                            </td>
                                                            <td style="text-align: center; vertical-align: middle;"><a href="#" onclick="remove_cart(<?php echo $i; ?>); return false;"><i class="fas fa-trash-alt"></i></a></td>
                                                        </tr>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
                                            <td colspan="4" style="text-align: right;">Total Amount:</td>
                                            <td colspan="2" id="total_amount">
                                                <span>₹ <?php echo number_format(isset($total_amount) ? $total_amount : 0, 2, '.', ''); ?></span>
                                                <input type="hidden" name="hidden_total_amount" id="hidden_total_amount" value="<?php echo number_format(isset($total_amount) ? $total_amount : 0, 2, '.', ''); ?>">
                                            </td>



                                            <tr>
                                                <td colspan="3">
                                                    <label for="delivery_date_time" class="font-weight-bold text-dark"><i class="far fa-calendar-alt mr-2 text-primary"></i>Select Delivery Date & Time</label>
                                                    <input class="form-control" type="text" id="delivery_date_time" name="delivery_date" placeholder="Choose a date & time..." style="background-color: #fff;" required>
                                                    <small class="text-muted mt-1 d-block"><i class="fas fa-bolt text-warning mr-1"></i>Same-day delivery available for time slots after 2 PM.</small>
                                                </td>

                                                <?php
                                                $selectedPaymentMethod = isset($_POST['payment_method']) ? $_POST['payment_method'] : ''; // Ensure variable is always set
                                                ?>


                                                <td colspan="3">
                                                    Payment Method:<select class="form-control" id="paymentMethod" name="payment_method" required onchange="togglePaymentDetails()">
                                                        <option value="" disabled selected hidden>Select Payment Method</option>
                                                        <option value="Cash" <?= $selectedPaymentMethod === 'Cash' ? 'selected' : '' ?>>Cash on Delivery</option>
                                                        <option value="Card" <?= $selectedPaymentMethod === 'Card' ? 'selected' : '' ?>>Credit/Debit Card</option>
                                                        <option value="UPI" <?= $selectedPaymentMethod === 'UPI' ? 'selected' : '' ?>>UPI / QR Code</option>
                                                        <option value="NetBanking" <?= $selectedPaymentMethod === 'NetBanking' ? 'selected' : '' ?>>Net Banking</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr id="cardDetails" style="display:none;">
                                                <td colspan="3">

                                                </td>
                                                <td colspan="3" align="left">
                                                    <table>
                                                        <tr>
                                                            <td style="text-align: right; vertical-align: middle;"><label for="cardNumber">Card Number:</label></td>
                                                            <td><input type="text" id="cardNumber" maxlength="16" name="cardNumber" placeholder="Enter card number" pattern="\d{16}" inputmode="numeric"></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align: right; vertical-align: middle;"><label for="expiryDate">Expiry Date:</label></td>
                                                            <td>
                                                                <input type="text" id="expiryDate" name="expiryDate" placeholder="MM/YY" maxlength="5" pattern="(0[1-9]|1[0-2])\/\d{2}">
                                                                <span id="error-msg" style="color: red; font-size: 12px;"></span>
                                                            </td>

                                                            <script>
                                                                document.getElementById("expiryDate").addEventListener("input", function() {
                                                                    let input = this.value;
                                                                    let errorMsg = document.getElementById("error-msg");

                                                                    // Regex match for MM/YY format
                                                                    if (!/^(0[1-9]|1[0-2])\/\d{2}$/.test(input)) {
                                                                        errorMsg.textContent = "Invalid format. Use MM/YY.";
                                                                        return;
                                                                    } else {
                                                                        errorMsg.textContent = "";
                                                                    }

                                                                    // Get current month and year
                                                                    let currentDate = new Date();
                                                                    let currentMonth = currentDate.getMonth() + 1; // Months are 0-based
                                                                    let currentYear = currentDate.getFullYear() % 100; // Get last two digits of year

                                                                    // Extract month and year from input
                                                                    let [inputMonth, inputYear] = input.split('/').map(Number);

                                                                    // Validation for future or current date
                                                                    if (inputYear < currentYear || (inputYear === currentYear && inputMonth < currentMonth)) {
                                                                        errorMsg.textContent = "Expiry date must be today or in the future.";
                                                                    } else {
                                                                        errorMsg.textContent = "";
                                                                    }
                                                                });
                                                            </script>

                                                        </tr>
                                                        <tr>
                                                            <td style="text-align: right; vertical-align: middle;"><label for="cvv">CVV:</label></td>
                                                            <td><input type="text" id="cvv" maxlength="3" name="cvv" placeholder="CVV" pattern="\d{3}" inputmode="numeric"></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr id="upiDetails" style="display:none;">
                                                <td colspan="3"></td>
                                                <td colspan="3" align="left">
                                                    <div class="text-center p-3" style="border: 2px dashed #f7a392; border-radius: 10px; background: #fff5f3;">
                                                        <i class="fas fa-qrcode" style="font-size: 5rem; color: #333;"></i>
                                                        <p class="mt-2 mb-1 text-dark font-weight-bold">Scan to Pay via Any UPI App</p>
                                                        <p class="small text-muted mb-2">(GPay, PhonePe, Paytm, BHIM)</p>
                                                        <p class="mb-0 text-success font-weight-bold border d-inline-block px-3 py-1 bg-white shadow-sm rounded">UPI ID: cakeking@merchant</p>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="netBankingDetails" style="display:none;">
                                                <td colspan="3"></td>
                                                <td colspan="3" align="left">
                                                    <label class="font-weight-bold">Select Bank:</label>
                                                    <select class="form-control mb-2">
                                                        <option>State Bank of India</option>
                                                        <option>HDFC Bank</option>
                                                        <option>ICICI Bank</option>
                                                        <option>Axis Bank</option>
                                                        <option>Kotak Mahindra Bank</option>
                                                    </select>
                                                    <small class="text-muted"><i class="fas fa-lock text-success mr-1"></i>You will be redirected to your bank's secure portal after clicking checkout.</small>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="6">
                                                    <div style="display: flex; justify-content: flex-end; gap: 10px;">
                                                        <button class="btn btn-warning" type="button" onclick="clear_cart()">Clear</button>
                                                        <button class="btn btn-primary" type="submit">Checkout</button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php if (isset($_GET['invoice_id']) && !empty($_GET['invoice_id'])) { ?>
                                                <tr>
                                                    <td colspan="6" style="text-align: right;">
                                                        <a href="download_invoice.php?invoice_id=<?php echo htmlspecialchars($_GET['invoice_id']); ?>&view=1" class="btn btn-warning" target="_blank">View Invoice</a>
                                                        <a href="download_invoice.php?invoice_id=<?php echo htmlspecialchars($_GET['invoice_id']); ?>" class="btn btn-primary">Download Invoice</a>
                                                    </td>
                                                </tr>
                                            <?php } ?>

                                        </tbody>
                                    </form>
                                </table>
                            </div>
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
    <script src="js/main-js.js"></script>
    <script src="js/interactive.js"></script>
    <script type="text/javascript" src="js/owl.carousel.min.js"></script>
    <script>
        // delegate to global helper, showing toast automatically
        function add_cart(product_id) { window.add_cart(product_id); }

        function prodTotal(quantity) {
            var price = $(quantity).parent().prev().find('input').val();
            var total = quantity.value * price;
            $(quantity).parent().next().find('input').val(total);
            $(quantity).parent().next().find('span').html("₹ " + total);
            var total_amount = 0;
            $('input[name="hidden_product_total[]"]').each(function() {
                total_amount += parseInt($(this).val());
            });
            $('#total_amount').find('span').html("₹ " + total_amount);
            $('#total_amount').find('input').val(total_amount);
        }

        function clear_cart() {
            var flag = confirm("Do you want to clear cart?");
            if (flag) {
                window.location.href = "clear_cart.php";
            }
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
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
                dateTimeInput.addEventListener("change", function() {
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
                        showToast("Please select a time at least 60 minutes ahead if choosing today!", "info");
                        this.value = "";
                    }
                });
            }
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var paymentMethodSelect = document.getElementById("paymentMethod");
            if (paymentMethodSelect) {
                paymentMethodSelect.addEventListener("change", togglePaymentDetails);
                togglePaymentDetails(); // Initialize state
            }
        });
    </script>
    <script>
        document.getElementById("cardNumber").addEventListener("input", function(e) {
            e.target.value = e.target.value.replace(/\D/g, ""); // Remove non-numeric characters
            if (e.target.value.length > 16) {
                e.target.value = e.target.value.substring(0, 16); // Limit to 16 digits
            }
        });

        document.getElementById("expiryDate").addEventListener("input", function(e) {
            let input = e.target.value.replace(/\D/g, ""); // Remove non-numeric characters
            if (input.length > 2) {
                input = input.slice(0, 2) + "/" + input.slice(2, 4); // Add slash after MM
            }
            e.target.value = input;
        });

        document.getElementById("cvv").addEventListener("input", function(e) {
            e.target.value = e.target.value.replace(/\D/g, ""); // Remove non-numeric characters
            if (e.target.value.length > 3) {
                e.target.value = e.target.value.substring(0, 3); // Limit to 3 digits
            }
        });

        document.getElementById("paymentForm").addEventListener("submit", function(e) {
            let isValid = true;

            let cardNumber = document.getElementById("cardNumber").value.trim();
            let expiryDate = document.getElementById("expiryDate").value.trim();
            let cvv = document.getElementById("cvv").value.trim();

            let cardNumberError = document.getElementById("cardNumberError");
            let expiryDateError = document.getElementById("expiryDateError");
            let cvvError = document.getElementById("cvvError");

            // Reset error messages
            cardNumberError.textContent = "";
            expiryDateError.textContent = "";
            cvvError.textContent = "";

            // Validate Card Number (must be 16 digits)
            if (!/^\d{16}$/.test(cardNumber)) {
                cardNumberError.textContent = "Card number must be exactly 16 digits.";
                isValid = false;
            }

            // Validate Expiry Date (MM/YY format)
            if (!/^(0[1-9]|1[0-2])\/\d{2}$/.test(expiryDate)) {
                expiryDateError.textContent = "Enter a valid expiry date (MM/YY).";
                isValid = false;
            }

            // Validate CVV (must be 3 digits)
            if (!/^\d{3}$/.test(cvv)) {
                cvvError.textContent = "CVV must be exactly 3 digits.";
                isValid = false;
            }

            // Prevent form submission if any validation fails
            if (!isValid) {
                e.preventDefault();
            }
        });
    </script>
    <script>
        function togglePaymentDetails() {
            var paymentMethod = document.getElementById("paymentMethod").value;
            var cardDetails = document.getElementById("cardDetails");
            var upiDetails = document.getElementById("upiDetails");
            var netBankingDetails = document.getElementById("netBankingDetails");

            if(cardDetails) cardDetails.style.display = "none";
            if(upiDetails) upiDetails.style.display = "none";
            if(netBankingDetails) netBankingDetails.style.display = "none";

            document.getElementById("cardNumber").removeAttribute("required");
            document.getElementById("expiryDate").removeAttribute("required");
            document.getElementById("cvv").removeAttribute("required");

            if (paymentMethod === "Card") {
                cardDetails.style.display = "table-row";
                document.getElementById("cardNumber").setAttribute("required", "true");
                document.getElementById("expiryDate").setAttribute("required", "true");
                document.getElementById("cvv").setAttribute("required", "true");
            } else if (paymentMethod === "UPI") {
                if(upiDetails) upiDetails.style.display = "table-row";
            } else if (paymentMethod === "NetBanking") {
                if(netBankingDetails) netBankingDetails.style.display = "table-row";
            }
        }
    </script>
    <script>
        function prodTotal(element) {
            let row = element.closest('tr');
            let price = parseFloat(row.querySelector('[name="hidden_product_price[]"]').value);
            let quantity = parseInt(element.value);
            let total = (price * quantity).toFixed(2);

            // Row ka total update karo:
            row.querySelector('td:nth-child(5) span').innerText = '₹ ' + total;
            row.querySelector('[name="hidden_product_total[]"]').value = total;

            // Total amount calculate karo:
            let totalAmount = 0;
            document.querySelectorAll('[name="hidden_product_total[]"]').forEach(input => {
                totalAmount += parseFloat(input.value);
            });

            // Total amount ko page aur hidden input mein update karo:
            document.getElementById('total_amount').querySelector('span').innerText = '₹ ' + totalAmount.toFixed(2);
            document.querySelector('[name="hidden_total_amount"]').value = totalAmount.toFixed(2);
        }
    </script>
    <script>
        function updateTotalAmount() {
            let totalAmount = 0;
            document.querySelectorAll('[name="hidden_product_total[]"]').forEach(input => {
                totalAmount += parseFloat(input.value);
            });

            // Total amount ko hidden input mein set karein
            document.getElementById('hidden_total_amount').value = totalAmount.toFixed(2);
        }
    </script>
    <script>
        window.onload = function() {
            console.log("Page Loaded - COD Validation Active");

            // Call this function on page load and whenever total updates
            updateCODAvailability();

            // Monitor changes in quantity and total amount
            document.querySelectorAll("input[name='product_quantity[]']").forEach(input => {
                input.addEventListener("change", updateCODAvailability);
            });
        };

        // Function to disable COD when total > 500
        function updateCODAvailability() {
            let totalAmount = parseFloat(document.getElementById("hidden_total_amount").value);
            let codOption = document.querySelector("#paymentMethod option[value='Cash']");

            if (codOption) {
                if (totalAmount > 500) {
                    codOption.disabled = true;
                    codOption.style.color = "lightgray";
                    codOption.textContent = "Cash on Delivery (Above ₹500 not available)";
                    // Reset to default if COD was selected
                    if (document.getElementById("paymentMethod").value === "Cash") {
                        document.getElementById("paymentMethod").value = "";
                    }
                    console.log("COD Disabled - Total Amount is greater than 500");
                } else {
                    codOption.disabled = false;
                    codOption.style.color = "";
                    codOption.textContent = "Cash on Delivery";
                    console.log("COD Enabled - Total Amount is less than or equal to 500");
                }
            } else {
                console.warn("Cash on Delivery option not found!");
            }
        }
    </script>


    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({duration: 800, once: true});</script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#delivery_date_time", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            minDate: "today",
            minTime: "10:00",
            maxTime: "22:00",
            disable: [
                function(date) {
                    return false;
                }
            ]
        });
    </script>
</body>

</html>