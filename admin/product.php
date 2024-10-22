<?php
include 'conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
   <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" type="text/css" href="js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
   <style>
        body {
            font-family: Arial, sans-serif;
        }
        .card {
            margin-bottom: 20px;
           
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
            border-top-left-radius: 0.25rem;
            border-top-right-radius: 0.25rem;
        }
        .card-body {
            padding: 1.25rem;
             border: 2px black;
        }
        .card-title {
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        .card-text {
            font-size: 0.9rem;
            color: #666;
        }
        .btn {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }
        .row {
            justify-content: center;
        }
        .col-md-3 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- included nav -->
    <?php include 'nav.php'; ?>


    <h1 style="text-align: center;">Products</h1>

    <?php
    // Fetch products with categories from database
    $sql = "SELECT * FROM products INNER JOIN categories ON products.pcategory = categories.cid;";
    $result = mysqli_query($conn, $sql);
    $row_count = mysqli_num_rows($result);

    if ($row_count > 0) {
    ?>
    <div class="container">
        <div class="row">
            <?php
            $count = 0;
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="col-md-3">
                <div class="card">
                    <img src="<?php echo "images/".$row["pimage"]; ?>" alt="Product Image" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row["pname"]; ?></h5>
                        <p class="card-text">Price: <?php echo $row["pprice"]; ?></p>
                        <p class="card-text">Category: <?php echo $row["cname"]; ?></p>
                        <div class="d-flex justify-content-between">
                            <!-- Update Form -->
                            <form method="post" action="update_product.php">
                                <input type="hidden" name="pid" value="<?php echo $row['pid']; ?>">
                                <input type="submit" name="update" value="Update" class="btn btn-primary">
                            </form>
                            <!-- Delete Form -->
                            <form method="post" action="delete_product.php">
                                <input type="hidden" name="pid" value="<?php echo $row['pid']; ?>">
                                <input type="submit" name="delete" value="Delete" class="btn btn-danger">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $count++;
            if ($count % 4 == 0) {
                echo '</div><div class="row">';
            }
            } ?>
        </div>
    </div>
    <?php } else {
        echo "<h3>No Records</h3>";
    } ?>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>