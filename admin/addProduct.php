<?php
include "conn.php";

if (isset($_POST['addProd'])) {
    $pname = $_POST['pname']; // Corrected variable assignment
    $pprice = $_POST['pprice']; // Corrected variable assignment
    $pcat = $_POST['pcat']; // Corrected variable assignment
    $filename = $_FILES['pimage']['name']; // Corrected variable name for the file input
    $tmpname = $_FILES['pimage']['tmp_name']; // Corrected variable name for the file input

    // Corrected SQL insert query
    $sql_insert = "INSERT INTO products (pname, pprice, pcategory, pimage) VALUES ('$pname', '$pprice', '$pcat', '$filename')";
    $result = mysqli_query($conn, $sql_insert);

    if ($result) {
        move_uploaded_file($tmpname, 'images/' . $filename); // Corrected file upload handling
        header("Location: product.php");
        exit(); // Added exit to ensure no further code execution after redirection
    } else {
        echo "Failed to insert product"; // Error handling
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <title>Add Product</title>
    <style>
        body {
            background-color: white;
            color: #333;
            font-family: Arial, sans-serif;
        }
        .nav {
            background-color: #4B0082; /* Purple */
            padding: 10px;
            color: white;
        }
        .form-container {
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            max-width: 600px;
            background-color: #F0F8FF; /* Light Blue */
        }
        .form-container label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            margin-right: 5%;
        }
        .form-container input[type="text"],
        .form-container select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-container input[type="file"] {
            padding: 10px;
        }
        .form-container input[type="submit"] {
            background-color: #4B0082; /* Purple */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
        }
        .form-container input[type="submit"]:hover {
            background-color: #6A5ACD; /* Blue */
        }
        .add-categories-button {
            margin-top: 10px;
        }
        .add-categories-button a {
            display: inline-block;
            background-color: #4B0082; /* Purple */
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
        }
        .add-categories-button a:hover {
            background-color: #6A5ACD; /* Light Blue */
        }
    </style>
</head>
<body>
    <!-- Include nav -->
    <?php include 'nav.php'; ?>

    

    <div class="form-container">
        <form method="post" enctype="multipart/form-data">
            <label for="pname">Product Name: <br>
                <input type="text" name="pname" id="pname">
            </label><br><br>
            <label for="pprice">Product Price: <br>
                <input type="text" name="pprice" id="pprice">
            </label><br><br>
            <label for="pcat">Product Category: <br>
                <?php
                $sql_select = "SELECT * FROM categories"; // Corrected SELECT statement
                $result = mysqli_query($conn, $sql_select);
                $row_count = mysqli_num_rows($result);
                ?>
                <select name="pcat" id="pcat">
                    <?php
                    if ($row_count > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <option value="<?php echo $row['cid']; ?>">
                                <?php echo $row['cname']; ?>
                            </option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </label><br><br>
            <label for="pimage">Product Image: <br>
                <input type="file" name="pimage" id="pimg">
            </label><br><br>
            <input type="submit" name="addProd" value="Add Product">

            <!-- Add Categories Button -->
            <!-- <div class="add-categories-button">
                <button><a href="categories.php">Add Categories</a></button>
            </div> -->
        </form>
    </div>
</body>
</html>
