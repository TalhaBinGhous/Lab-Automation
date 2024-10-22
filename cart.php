<?php
session_start();
include 'conn.php'; 
include 'utils.php';// Include your database connection

// Check if user is logged in
if (!isset($_SESSION['uname'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

$csid = $_SESSION['csid']; // Use the session variable for csid

// Function to fetch cart items
function fetchCartItems($conn, $csid) {
    $sql = "SELECT * FROM cart WHERE csid =?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $csid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return $result;
}

// Function to calculate total cart amount
function calculateTotal($conn, $csid) {
    $sql = "SELECT SUM(subtotal) AS total FROM cart WHERE csid =?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $csid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    return $row['total'];
}

// Fetch cart items for the logged-in user
$cartItems = fetchCartItems($conn, $csid);
$totalAmount = calculateTotal($conn, $csid);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cart</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .table {
            margin-top: 20px;
        }
        .btn {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: #fff;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #3e8e41;
        }
    </style>
</head>
<body>
    
    <div class="container">
        <h2 class="my-4">Your Cart</h2>
        <?php if (mysqli_num_rows($cartItems) > 0) { ?>
          <table class="table table-striped">
            <thead>
                <tr>
                    <th>Product Image</th>
                    <th>Product ID</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($cartItems)) { ?>
                <tr>
                    <td><img src="<?php echo "admin/images/".$row["pimage"]; ?>" alt="Product Image" class="img-thumbnail" style="width: 100px;"></td>
                    <td><?php echo $row['pid']; ?></td>
                    <td>$<?php echo $row['price']; ?></td>
                    <td><?php echo $row['qty']; ?></td>
                    <td>$<?php echo $row['subtotal']; ?></td>
                    <td>
                        <!-- <form action="delete_item.php" method="post">
                            <input type="hidden" name="cart_id" value="<?php echo $row['cart_id']; ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form> -->
                    </td>
                </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4"><strong>Total:</strong></td>
                    <td>$<?php echo number_format($totalAmount, 2); ?></td>
                    <td>
                        <form action="checkout.php" method="post">
                            <input type="hidden" name="total_amount" value="<?php echo $totalAmount; ?>">
                            <button type="submit" class="btn btn-primary" >Buy Now</button>
                        </form>
                    </td>
                </tr>
            </tfoot>
        </table>
        <?php } else { ?>
        <p>Your cart is empty.</p>
        <?php } ?>
    </div>
</body>