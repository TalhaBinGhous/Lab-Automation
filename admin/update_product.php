<?php
include 'conn.php';

if (isset($_POST['update'])) {
    $pid = $_POST['pid'];

    // Fetch product details
    $sql = "SELECT * FROM products WHERE pid = $pid";
    $result = mysqli_query($conn, $sql);
    $product = mysqli_fetch_assoc($result);

    // Display update form
    if ($product) {
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
                /* Your existing CSS styles */
            </style>
            
        </head>
        <body>
            <!-- included nav -->
            <?php include 'nav.php'; ?>

            <h3>Update Product</h3>

            <form method="post" action="process_update.php">
                <input type="hidden" name="pid" value="<?php echo $product['pid']; ?>">
                <label for="pname">Product Name: <br>
                    <input type="text" name="pname" id="pname" value="<?php echo $product['pname']; ?>">
                </label><br><br>
                <label for="pprice">Product Price: <br>
                    <input type="text" name="pprice" id="pprice" value="<?php echo $product['pprice']; ?>">
                </label><br><br>
                <label for="pcat">Product Category: <br>
                    <select name="pcat" id="pcat">
                        <?php
                        $sql_categories = "SELECT * FROM categories";
                        $result_categories = mysqli_query($conn, $sql_categories);
                        while ($row = mysqli_fetch_assoc($result_categories)) {
                            $selected = ($row['cid'] == $product['pcategory']) ? 'selected' : '';
                            echo "<option value='" . $row['cid'] . "' $selected>" . $row['cname'] . "</option>";
                        }
                        ?>
                    </select>
                </label><br><br>
                <input type="submit" name="submit" value="Update">
            </form>

        </body>
        </html>
        <?php
    } else {
        echo "Product not found.";
    }
}
?>
