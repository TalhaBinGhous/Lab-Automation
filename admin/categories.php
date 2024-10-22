<?php
include 'conn.php';
if (isset($_POST['addCat'])) {
    $cname = $_POST['cname']; // corrected variable name
    $sql = "INSERT INTO categories (cname) VALUES ('$cname')";
    $result = mysqli_query($conn, $sql) or die('Failed to insert category');
}

?><!DOCTYPE html>
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
    <title>Document</title>
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
            
        }
        .form-container input[type="text"],
        .form-container select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-right: 10px;
            
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
        }
        .form-container input[type="submit"]:hover {
            background-color: #6A5ACD; /* Blue */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border: 3px solid #000;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #4B0082; /* Purple */
            color: white; /* White text color */
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #ddd;
        }
        h3 {
            color: #333;
        }
    </style>
</head>
<body>
    <!-- include nav -->
    <?php include 'nav.php'; ?>

    <div class="form-container">
        <h3>Add Category</h3>
        <form method="post">
            <label for="cname">Category Name:</label>
            <input type="text" id="cname" name="cname" required>
            <input type="submit" name="addCat" value="Add Category">
        </form>
    </div>

    <!-- View Categories -->
    <h3>Categories</h3>
    <?php
    include 'conn.php';
    $sql = "SELECT * FROM categories";
    $result = mysqli_query($conn, $sql);
    $row_count = mysqli_num_rows($result);
    if ($row_count > 0) {
    ?>
        <table>
            <tr>
                <th>Category ID</th>
                <th>Category Name</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row["cid"]; ?></td>
                    <td><?php echo $row["cname"]; ?></td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>No categories found.</p>
    <?php } ?>
</body>
</html>

