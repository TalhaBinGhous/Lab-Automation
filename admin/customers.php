<?php
session_start();
include 'conn.php'; // Make sure this includes your database connection

// Fetch all users from customer table
$sql = "SELECT * FROM customer";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
   ?>
    <!DOCTYPE html>
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
    <html>
    <head>
        <title>Registered Users</title>
        <style>
            table {
                border-collapse: collapse;
                width: 100%;
            }

            th, td {
                border: 1px solid #ddd;
                padding: 10px;
                text-align: left;
            }

            th {
                background-color: #f0f0f0;
            }
        </style>
    </head>
    <body>
        <?php
        include 'nav.php';
        ?>
        <h1>Registered Users</h1>
        <table>
            <tr>
                <th>CSID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Password</th>
            </tr>
            <?php
            while($user_data = $result->fetch_assoc()) {
               ?>
                <tr>
                    <td><?php echo $user_data['csid'];?></td>
                    <td><?php echo $user_data['fname'];?></td>
                    <td><?php echo $user_data['lname'];?></td>
                    <td><?php echo $user_data['uname'];?></td>
                    <td><?php echo $user_data['email'];?></td>
                    <td><?php echo $user_data['pass'];?></td>
                </tr>
                <?php
            }
           ?>
        </table>
    </body>
    </html>
    <?php
} else {
    echo "No registered users found";
}

$conn->close();
?>