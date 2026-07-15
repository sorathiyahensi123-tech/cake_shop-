<?php
session_start();
if (!empty($_SESSION['cart'])) {
    $printCount = count($_SESSION['cart']);
} else {
    $printCount = 0;
}
if (!empty($_SESSION['user_users_id']) && !empty($_SESSION['user_users_username'])) {
    $printUsername = $_SESSION['user_users_username'];
    $isLoggedIn = true;
} else {
    $printUsername = "Guest";
    $isLoggedIn = false;
}
$userAvatar = 'uploads/default-image.jpg';
if (!file_exists($userAvatar)) {
    $userAvatar = 'https://via.placeholder.com/150'; 
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CAKE KING - Build Your Cake</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/userpage.css">
    <link rel="stylesheet" href="css/interactive.css">
    <link rel="stylesheet" href="fonts/fontawesome/css/fontawesome-all.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        .customizer-preview {
            position: relative;
            width: 100%;
            height: 500px;
            background: #fdfdfd;
            border-radius: 20px;
            box-shadow: inset 0 0 20px rgba(0,0,0,0.02);
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px dashed #eedbcb;
            overflow: hidden;
        }
        
        .layer {
            position: absolute;
            transition: all 0.5s ease-in-out;
            max-height: 80%;
            max-width: 80%;
            object-fit: contain;
        }
        
        /* CSS Cake Base */
        .css-cake-base {
            width: 280px;
            height: 140px;
            background-color: #f3e5ab; /* Vanilla default */
            border-radius: 140px / 70px;
            position: absolute;
            top: 55%;
            transform: translateY(-50%);
            box-shadow: inset -20px -20px 40px rgba(0,0,0,0.1), 0 20px 40px rgba(0,0,0,0.1);
            transition: background-color 0.4s;
        }
        .css-cake-base::before {
            content: '';
            position: absolute;
            top: -40px;
            left: 0;
            width: 100%;
            height: 80px;
            background-color: #ffebb8; /* Paler top */
            border-radius: 140px / 40px;
            transition: background-color 0.4s;
        }
        
        /* CSS Cake Icing */
        .css-cake-icing {
            width: 290px;
            height: 90px;
            background-color: #ffffff; /* White default */
            border-radius: 145px / 45px;
            position: absolute;
            top: calc(55% - 50px);
            transform: translateY(-50%);
            z-index: 2;
            box-shadow: inset -10px -10px 20px rgba(0,0,0,0.05);
            transition: background-color 0.4s;
            clip-path: polygon(0% 50%, 10% 80%, 20% 60%, 30% 90%, 40% 60%, 50% 95%, 60% 60%, 70% 85%, 80% 50%, 90% 80%, 100% 50%, 100% 0%, 0% 0%);
        }
        
        .css-cake-icing-top {
            width: 290px;
            height: 80px;
            background-color: #ffffff; /* White default */
            border-radius: 145px / 40px;
            position: absolute;
            top: calc(55% - 65px);
            transform: translateY(-50%);
            z-index: 3;
            box-shadow: inset -10px -10px 20px rgba(0,0,0,0.05);
            transition: background-color 0.4s;
        }

        .customizer-msg {
            position: absolute;
            top: calc(55% - 60px);
            transform: translateY(-50%);
            z-index: 10;
            font-family: 'Playfair Display', cursive, serif;
            font-size: 1.8rem;
            color: #d4af37;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
            text-align: center;
            width: 260px;
            pointer-events: none;
            transition: all 0.2s;
        }
        
        /* Decor Elements */
        .decor-item {
            position: absolute;
            z-index: 5;
            font-size: 2rem;
            opacity: 0;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            transform: scale(0);
        }
        
        .decor-item.show {
            opacity: 1;
            transform: scale(1) translateY(-10px);
        }
        
        .d1 { top: calc(55% - 90px); left: calc(50% - 100px); }
        .d2 { top: calc(55% - 110px); left: calc(50% - 40px); }
        .d3 { top: calc(55% - 110px); left: calc(50% + 10px); }
        .d4 { top: calc(55% - 90px); left: calc(50% + 70px); }

        .price-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background: #d4af37;
            color: #fff;
            padding: 10px 20px;
            border-radius: 30px;
            font-size: 1.5rem;
            font-weight: bold;
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.4);
            z-index: 20;
        }

        .option-card {
            border: 2px solid transparent;
            border-radius: 15px;
            cursor: pointer;
            transition: all 0.2s;
            background: #f8f9fa;
        }
        .option-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        .option-card.selected {
            border-color: #d4af37;
            background: #fffdf8;
            box-shadow: 0 5px 20px rgba(212, 175, 55, 0.15);
        }
        .color-dot {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 10px;
            border: 2px solid #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
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
                        <li class="nav-item"><a class="nav-link" href="shop.php">Shop</a></li>
                        <li class="nav-item"><a class="nav-link active" href="build_cake.php"><i class="fas fa-magic text-warning mr-1"></i> Build Cake</a></li>
                        <li class="nav-item"><a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i> <span class="badge badge-pill badge-secondary"><?php echo $printCount; ?></span></a></li>
                        <li class="nav-item dropdown nav-user ml-3">
                            <a class="nav-link nav-user-img p-0" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="user-avatar-md rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background-color: #fdf5e6; color: #d4af37; border: 2px solid #d4af37; font-size: 1.2rem;">
                                        <i class="fas fa-user"></i>
                                    </div>
                                </a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name"><?php echo $printUsername; ?></h5>
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

        <div class="container-fluid dashboard-content mt-5 pt-5">
            <div class="row mx-5">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center mb-5" data-aos="fade-down">
                    <h5 class="text-gold text-uppercase" style="letter-spacing: 2px;">Custom Creator</h5>
                    <h1 class="display-4 font-weight-bold" style="font-family: 'Playfair Display', serif; color: #5d4037;">Build Your Dream Cake</h1>
                    <p class="lead text-muted">Select your flavor, colors, and toppings to instantly see your creation come to life.</p>
                </div>
            </div>

            <div class="row mx-xl-5">
                <!-- Preview Canvas -->
                <div class="col-xl-6 col-lg-6 col-md-12 mb-5" data-aos="fade-right">
                    <div class="customizer-preview">
                        <div class="price-badge" id="livePrice">₹599</div>
                        
                        <!-- Stand -->
                        <div style="position: absolute; bottom: 10%; width: 350px; height: 10px; background: #ddd; border-radius: 5px; box-shadow: 0 10px 20px rgba(0,0,0,0.1);"></div>
                        <div style="position: absolute; bottom: calc(10% - 15px); width: 100px; height: 15px; background: #ccc; border-radius: 0 0 10px 10px;"></div>
                        
                        <!-- The CSS Cake -->
                        <div class="css-cake-base" id="cakeBase"></div>
                        <div class="css-cake-icing" id="cakeIcingDrop"></div>
                        <div class="css-cake-icing-top" id="cakeIcingTop"></div>
                        
                        <!-- Message -->
                        <div class="customizer-msg" id="cakeMsg"></div>
                        
                        <!-- Toppings -->
                        <div class="decor-item d1" id="decor1">🍓</div>
                        <div class="decor-item d2" id="decor2">🍓</div>
                        <div class="decor-item d3" id="decor3">🍓</div>
                        <div class="decor-item d4" id="decor4">🍓</div>
                    </div>
                </div>

                <!-- Controls -->
                <div class="col-xl-6 col-lg-6 col-md-12 pl-xl-5" data-aos="fade-left">
                    <div class="card border-0 shadow-sm" style="border-radius: 20px;">
                        <div class="card-body p-5">
                            
                            <!-- Base Flavor -->
                            <h4 class="mb-3 font-weight-bold"><i class="fas fa-layer-group mr-2 text-warning"></i>1. Base Flavor</h4>
                            <div class="row mb-4">
                                <div class="col-6 mb-3">
                                    <div class="option-card p-3 text-center selected" onclick="setBase('vanilla', this)">
                                        <div class="color-dot" style="background: #f3e5ab;"></div>
                                        <strong>Vanilla Sponge</strong>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="option-card p-3 text-center" onclick="setBase('chocolate', this)">
                                        <div class="color-dot" style="background: #5d4037;"></div>
                                        <strong>Rich Chocolate</strong>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="option-card p-3 text-center" onclick="setBase('redvelvet', this)">
                                        <div class="color-dot" style="background: #8b0000;"></div>
                                        <strong>Red Velvet</strong>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Icing Color -->
                            <h4 class="mb-3 font-weight-bold"><i class="fas fa-paint-roller mr-2 text-primary"></i>2. Cream Frosting</h4>
                            <div class="d-flex mb-4">
                                <div class="color-dot" style="background: #ffffff; cursor: pointer; width: 40px; height: 40px;" onclick="setIcing('#ffffff')"></div>
                                <div class="color-dot" style="background: #ffb6c1; cursor: pointer; width: 40px; height: 40px;" onclick="setIcing('#ffb6c1')"></div>
                                <div class="color-dot" style="background: #add8e6; cursor: pointer; width: 40px; height: 40px;" onclick="setIcing('#add8e6')"></div>
                                <div class="color-dot" style="background: #5d4037; cursor: pointer; width: 40px; height: 40px;" onclick="setIcing('#5d4037')"></div>
                                <div class="color-dot" style="background: #ffebb8; cursor: pointer; width: 40px; height: 40px;" onclick="setIcing('#ffebb8')"></div>
                            </div>
                            
                            <!-- Toppings -->
                            <h4 class="mb-3 font-weight-bold"><i class="fas fa-star mr-2 text-danger"></i>3. Toppings</h4>
                            <div class="row mb-4">
                                <div class="col-4">
                                    <button class="btn btn-outline-danger btn-block rounded-pill" onclick="setToppings('🍓')">Strawberries</button>
                                </div>
                                <div class="col-4">
                                    <button class="btn btn-outline-dark btn-block rounded-pill" onclick="setToppings('🍫')">Choco Chips</button>
                                </div>
                                <div class="col-4">
                                    <button class="btn btn-outline-info btn-block rounded-pill" onclick="setToppings('💖')">Love Hearts</button>
                                </div>
                                <div class="col-4 mt-3">
                                    <button class="btn btn-outline-secondary btn-block rounded-pill" onclick="setToppings('')">None</button>
                                </div>
                            </div>
                            
                            <!-- Message -->
                            <h4 class="mb-3 font-weight-bold"><i class="fas fa-pen-fancy mr-2 text-info"></i>4. Custom Message</h4>
                            <div class="form-group mb-5">
                                <input type="text" id="cakeText" class="form-control form-control-lg border-info" placeholder="Type here to see it on the cake..." maxlength="20" oninput="document.getElementById('cakeMsg').innerText = this.value">
                            </div>
                            
                            <hr>
                            
                            <button class="btn btn-primary btn-lg btn-block shadow-lg mt-4 btn-add-cart-bounce" style="border-radius: 50px;" onclick="addCustomToCart()">
                                Add Custom Cake to Cart <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="text-md-right footer-links d-none d-sm-block">
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
    <script src="js/main-js.js"></script>
    <script src="js/interactive.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({duration: 800, once: true});</script>
    <script>
        let basePrice = 599;
        
        function updatePrice(amt) {
            basePrice += amt;
            document.getElementById('livePrice').innerText = '₹' + basePrice;
            document.getElementById('livePrice').style.transform = 'scale(1.2)';
            setTimeout(() => {
                document.getElementById('livePrice').style.transform = 'scale(1)';
            }, 300);
        }

        function setBase(flavor, el) {
            $('.option-card').removeClass('selected');
            $(el).addClass('selected');
            
            const base = document.getElementById('cakeBase');
            if(flavor === 'vanilla') {
                base.style.backgroundColor = '#f3e5ab';
                base.style.setProperty('--pseudo-bg', '#ffebb8');
                document.styleSheets[0].insertRule('.css-cake-base::before { background-color: #ffebb8 !important; }', 0);
            } else if(flavor === 'chocolate') {
                base.style.backgroundColor = '#4e342a';
                document.styleSheets[0].insertRule('.css-cake-base::before { background-color: #3e2820 !important; }', 0);
            } else if(flavor === 'redvelvet') {
                base.style.backgroundColor = '#8b0000';
                document.styleSheets[0].insertRule('.css-cake-base::before { background-color: #720000 !important; }', 0);
            }
        }
        
        function setIcing(color) {
            document.getElementById('cakeIcingDrop').style.backgroundColor = color;
            document.getElementById('cakeIcingTop').style.backgroundColor = color;
            
            // Adjust text color for contrast
            if(color === '#5d4037' || color === '#8b0000') {
                document.getElementById('cakeMsg').style.color = '#fff';
            } else {
                document.getElementById('cakeMsg').style.color = '#d4af37';
            }
        }
        
        function setToppings(emoji) {
            $('.decor-item').removeClass('show');
            if(emoji !== '') {
                setTimeout(() => {
                    $('.decor-item').text(emoji).addClass('show');
                }, 300);
            }
        }
        
        function addCustomToCart() {
            // Since this is a custom cake, we simulate adding a special product to session cart
            // In a real database we'd do an AJAX call to add a generated product ID.
            alert("Custom cake added to cart! Proceeding to shop...");
            window.location.href = 'shop.php';
        }
    </script>
</body>
</html>
