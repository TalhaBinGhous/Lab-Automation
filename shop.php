<?php
session_start();
include 'conn.php'; // Make sure this includes your database connection

// Check if user is logged in
if (!isset($_SESSION['uname'])) {
    $loggedIn = false;
} else {
    $loggedIn = true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pid = filter_var($_POST['pid'], FILTER_VALIDATE_INT);
    $pname = filter_var($_POST['pname'], FILTER_SANITIZE_STRING);
    $pprice = filter_var($_POST['pprice'], FILTER_VALIDATE_FLOAT);

    if (!$pid ||!$pname ||!$pprice) {
        echo "Invalid input data.";
        exit();
    }

    $csid = $_SESSION['csid']; // Use the session variable for csid

    // Check if the product already exists in the cart
    $sql = "SELECT * FROM cart WHERE pid =? AND csid =?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $pid, $csid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    if (mysqli_stmt_num_rows($stmt) > 0) {
        // Product already exists in the cart, increment the quantity
        $sql_update_cart = "UPDATE cart SET qty = qty + 1, subtotal = subtotal +? WHERE pid =? AND csid =?";
        $stmt_update_cart = mysqli_prepare($conn, $sql_update_cart);
        $subtotal = $pprice * 1;
        mysqli_stmt_bind_param($stmt_update_cart, "dii", $subtotal, $pid, $csid);
        mysqli_stmt_execute($stmt_update_cart);
        mysqli_stmt_close($stmt_update_cart);
    } else {
        // Fetch product details including image name
        $sql_fetch_product = "SELECT pimage FROM products WHERE pid =?";
        $stmt_fetch_product = mysqli_prepare($conn, $sql_fetch_product);
        mysqli_stmt_bind_param($stmt_fetch_product, "i", $pid);
        mysqli_stmt_execute($stmt_fetch_product);
        mysqli_stmt_bind_result($stmt_fetch_product, $pimage);
        mysqli_stmt_fetch($stmt_fetch_product);
        mysqli_stmt_close($stmt_fetch_product);

        // Add the product to the cart table
        $sql_insert_cart = "INSERT INTO cart (pid, csid, price, qty, subtotal, pimage) VALUES (?,?,?, 1,?,?)";
        $stmt_insert_cart = mysqli_prepare($conn, $sql_insert_cart);
        $subtotal = $pprice * 1; // Assuming quantity is always 1 for simplicity
        mysqli_stmt_bind_param($stmt_insert_cart, "iidis", $pid, $csid, $pprice, $subtotal, $pimage);
        mysqli_stmt_execute($stmt_insert_cart);
        mysqli_stmt_close($stmt_insert_cart);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    // Redirect to cart page or show a success message
    header("Location: shop.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
    <title>Prime Dignostic Lab </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Red+Rose:wght@600;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <style>
        .btn-logout {
    border-radius: 35px; /* Adjust this value for more or less curvature */
    padding: 5px 10px; /* Adjust padding for button size */
    padding-top: 7px;
    font-size: 16px; /* Adjust font size if needed */
    text-align: center;
    display: inline-block;
    transition: background-color 0.3s ease;
}

.btn-logout:hover {
    background-color: blue; /* Darker shade on hover */
    color: #fff; /* Text color on hover */
}
.card-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

   .card {
        width: 20%;
        margin: 10px;
        display: inline-block;
    }

   .card img {
        width: 100%;
        height: 150px;
        object-fit: cover;
    }

   .card-body {
        padding: 10px;
    }

    </style>
</head>

<body>
      <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <div class="container-fluid py-2 d-none d-lg-flex">
        <div class="container">
            <div class="d-flex justify-content-between">
                <div>
                    <small class="me-3"><i class="fa fa-map-marker-alt me-2"></i>A-375 North Karachi, Karachi Pakistan</small>
                    <small class="me-3"><i class="fa fa-clock me-2"></i>Mon-Sat 09am-5pm, Sun Closed</small>
                </div>
                <nav class="breadcrumb mb-0">
                    <a class="breadcrumb-item small text-body" href="#">Career</a>
                    <a class="breadcrumb-item small text-body" href="#">Support</a>
                    <a class="breadcrumb-item small text-body" href="#">Terms</a>
                    <a class="breadcrumb-item small text-body" href="#">FAQs</a>
                </nav>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Brand Start -->
    <div class="container-fluid bg-primary text-white pt-4 pb-5 d-none d-lg-flex">
        <div class="container pb-2">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex">
                    <i class="bi bi-telephone-inbound fs-2"></i>
                    <div class="ms-3">
                        <h5 class="text-white mb-0">Call Now</h5>
                        <span>+012 345 6789</span>
                    </div>
                </div>
                <a href="index.php" class="h1 text-white mb-0">Prime <span class="text-dark">Dignostic </span>Lab</a>
                <div class="d-flex"> 
                    <i class="bi bi-envelope fs-2"></i>
                    <div class="ms-3">
                        <h5 class="text-white mb-0">Mail Now</h5>
                        <span>primedignosticlab@gmail.com</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Brand End -->


    <!-- Navbar Start -->
    <div class="container-fluid sticky-top">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-white py-lg-0 px-lg-3">
                <a href="index.php" class="navbar-brand d-lg-none">
                    <h1 class="text-primary m-0">Prime <span class="text-dark">Dignostic </span>Lab</h1>
                </a>
                <button type="button" class="navbar-toggler me-0" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav">
                        <a href="index.php" class="nav-item nav-link active">Home</a>
                        <a href="about.php" class="nav-item nav-link">About</a>
                        <a href="service.php" class="nav-item nav-link">Services</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Appointments</a>
                            <div class="dropdown-menu bg-light m-0">
                                <a href="appoinment.php" class="dropdown-item">Book Appointment</a>
                                <a href="shop.php" class="dropdown-item">Shop</a>
                            </div>
                        </div>
                        <a href="contact.php" class="nav-item nav-link">Contact</a>
                    </div>
                    
                    <div class="ms-auto d-none d-lg-flex">
                       
                        <?php if (!$loggedIn): ?>
                            <a class="btn btn-sm-square btn-primary ms-2" href="register.php"><i class="fas fa-sign-in-alt"></i></a>
                        <?php else: ?>
                           <a class="btn btn-sm-square btn-primary ms-2" style="margin-top: 5px;" href="cart.php"><i class="fas fa-shopping-cart"></i></a>
                            <a href="logout.php" class="btn btn-logout btn-primary ms-2">Logout</a>
                            <span class="navbar-text ms-2"><b><?php echo htmlspecialchars($_SESSION['uname']); ?></b></span>
                            <?php endif; ?>
                    
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5 mt-4">
            <h1 class="display-2 text-white mb-3 animated slideInDown">Shop</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    
                    <li class="breadcrumb-item" aria-current="page">Shop</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

   
    
    <div class="card-container">
    <?php
    // Fetch products with categories from database
    $sql = "SELECT * FROM products INNER JOIN categories ON products.pcategory = categories.cid;";
    $result = mysqli_query($conn, $sql);
    $row_count = mysqli_num_rows($result);

    if ($row_count > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
           ?>
            <div class="card">
                <img src="<?php echo "admin/images/".$row["pimage"];?>" alt="Product Image">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row["pname"];?></h5>
                    <p class="card-text">Price: <?php echo $row["pprice"];?> Rs</p>
                    <p class="card-text">Category: <?php echo $row["cname"];?></p>
                    <?php if ($loggedIn):?>
                        <form action="shop.php" method="post">
                            <input type="hidden" name="pid" value="<?php echo $row["pid"];?>">
                            <input type="hidden" name="pname" value="<?php echo $row["pname"];?>">
                            <input type="hidden" name="pprice" value="<?php echo $row["pprice"];?>">
                            <input type="hidden" name="pimage" value="<?php echo $row["pimage"];?>">
                            <button type="submit" class="btn btn-primary">Add to Cart</button>
                        </form>
                    <?php else:?>
                        <a href="register.php" class="btn btn-primary">Add to Cart</a>
                    <?php endif;?>
                </div>
            </div>
            <?php
        }
    } else {
        echo "No products found.";
    }

    mysqli_close($conn);
   ?>
</div>


    <!-- Footer Start -->
    <div class="container-fluid footer position-relative bg-dark text-white-50 py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <div class="row g-5 py-5">
                <div class="col-lg-6 pe-lg-5">
                    <a href="index.php" class="navbar-brand">
                        <h1 class="h1 text-primary mb-0">Prime <span class="text-white">Dignostic </span>Lab</h1>
                    </a>
                    <p class="fs-5 mb-4">Prime Diagnostic Lab is renowned for its innovative approaches in medical testing and laboratory solutions, pioneering advancements in healthcare diagnostics.</p>
                    <p><i class="fa fa-map-marker-alt me-2"></i>A-375 North Karachi, Karachi Pakistan</p>
                    <p><i class="fa fa-phone-alt me-2"></i>+012 345 67890</p>
                    <p><i class="fa fa-envelope me-2"></i>primedignosticlab@gmail.com</p>
                    <div class="d-flex mt-4">
                        <a class="btn btn-lg-square btn-primary me-2" href="https://x.com/?lang=en"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-lg-square btn-primary me-2" href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-lg-square btn-primary me-2" href="https://pk.linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                        <a class="btn btn-lg-square btn-primary me-2" href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-lg-6 ps-lg-5">
                    <div class="row g-5">
                        <div class="col-sm-6">
                            <h4 class="text-light mb-4">Quick Links</h4>
                            <a class="btn btn-link" href="">Home</a>
                            <a class="btn btn-link" href="">About Us</a>
                            <a class="btn btn-link" href="">Our Services</a>
                            <a class="btn btn-link" href="">Book an Appointment</a>
                           
                        </div>
                        <div class="col-sm-6">
                            <h4 class="text-light mb-4">Popular Links</h4>
                            <a class="btn btn-link" href="">Visit Shop</a>
                            <a class="btn btn-link" href="">Your Cart</a>
                            <a class="btn btn-link" href="">Contact Us</a>
                            <a class="btn btn-link" href="">Register</a>
                            
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Copyright Start -->
    <div class="container-fluid copyright bg-dark text-white-50 py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0">&copy; <a href="#">prime Dignostic Lab</a>. All Rights Reserved.</p>
                </div>
               
            </div>
        </div>
    </div>
    <!-- Copyright End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>