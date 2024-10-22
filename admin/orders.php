<!-- orders.php -->

<?php
include 'nav.php';
include 'conn.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

// SQL query to select all orders
$sql = "SELECT * FROM orders";
$result = $conn->query($sql);

// Check if there are any orders
if ($result->num_rows > 0) {
   ?>
    <html>
    <head>
          <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Skydash Admin</title>
  <!-- plugins:css -->
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
        <title>Orders</title>
        <style>
            body {
                font-family: Arial, sans-serif;
            }
           .container {
                width: 80%;
                margin: 40px auto;
            }
           .orders-table {
                border-collapse: collapse;
                width: 100%;
            }
           .orders-table th,.orders-table td {
                border: 1px solid #ddd;
                padding: 10px;
                text-align: left;
            }
           .orders-table th {
                background-color: #f0f0f0;
            }
           .orders-table tr:nth-child(even) {
                background-color: #f9f9f9;
            }
           .orders-table tr:hover {
                background-color: #f2f2f2;
            }
        
        .navbar {
            background-color: #f8f9fa; /* Light grey background */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            color: #007bff; /* Blue text */
            font-weight: bold;
        }

        .navbar-brand:hover {
            color: #0056b3; /* Darker blue on hover */
        }

        .navbar-toggler {
            border: none;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba%280, 0, 0, 0.5%29' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
        }

        .nav-link {
            color: #000; /* Black text */
        }

        .nav-link:hover {
            color: #007bff; /* Blue text on hover */
        }

        .nav-link.active {
            color: #0056b3; /* Darker blue for active link */
        }

        .navbar-nav {
            margin-left: auto;
        }

        </style>
    </head>
    <body>
        <div class="container">
            <h1>Orders</h1>
            <table class="orders-table">
                <tr>
                    <th>Order ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Country</th>
                    <th>Total</th>
                </tr>
                <?php
                while($row = $result->fetch_assoc()) {
                   ?>
                    <tr>
                        <td><?php echo $row["oid"];?></td>
                        <td><?php echo $row["name"];?></td>
                        <td><?php echo $row["phone"];?></td>
                        <td><?php echo $row["email"];?></td>
                        <td><?php echo $row["address"];?></td>
                        <td><?php echo $row["country"];?></td>
                        <td><?php echo $row["total"];?></td>
                    </tr>
                    <?php
                }
               ?>
            </table>
        </div>
    </body>
    </html>
    <?php
} else {
    echo "No orders found";
}

// Close database connection
$conn->close();
?>