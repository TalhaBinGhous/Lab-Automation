<?php
session_start();
include 'conn.php'; // Include your database connection
include 'utils.php'; // Include the utils file

// Check if user is logged in
if (!isset($_SESSION['uname'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

$csid = $_SESSION['csid']; // Use the session variable for csid

// Fetch total amount from form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $totalAmount = $_POST['total_amount'];
} else {
    header("Location: cart.php"); // Redirect to cart if accessed directly
    exit();
}

// Function to fetch cart items
function fetchCartItems($conn, $csid) {
    $sql = "SELECT * FROM cart WHERE csid = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $csid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return $result;
}

// Fetch cart items for the logged-in user
$cartItems = fetchCartItems($conn, $csid);


// Get the total amount from the previous page
$totalAmount = $_POST['total_amount'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['address']) && isset($_POST['country'])) {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $country = $_POST['country'];

        // Check if any of the fields are empty
        if (empty($name) || empty($phone) || empty($email) || empty($address) || empty($country)) {
            echo "Please fill in all the fields";
            exit();
        }

        $sql = "INSERT INTO orders (name, phone, email, address, country, total) VALUES (?,?,?,?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssssi", $name, $phone, $email, $address, $country, $totalAmount);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            // Clear the cart
            clearCart($conn, $csid);
            unset($_SESSION['cart']);
            unset($_SESSION['total_amount']);

            // Display order confirmation alert
            echo "<script>alert('Order confirmed successfully!');</script>";
            // Redirect to shop page
            header("Location: shop.php");
            exit();
        } else {
            echo "Error submitting order: ". mysqli_error($conn);
        }
    } else {
        echo "Please fill in all the fields";
    }
}
?>
<!-- Checkout form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
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
       .form-group {
            margin-bottom: 20px;
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
        <h2 class="my-4">Checkout</h2>
        <form action="" method="post">
        <h3>Order Summary</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Product Image</th>
                        <th>Product ID</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
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
                    </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4"><strong>Total:</strong></td>
                        <td>$<?php echo number_format($totalAmount, 2); ?></td>
                    </tr>
                </tfoot>
            </table>
            <h3>Shipping Details</h3>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="country">Country</label>
                <input type="text" class="form-control" id="country" name="country" required>
            </div>
            <input type="hidden" name="total_amount" value="<?php echo $totalAmount;?>">
            <button type="submit" class="btn btn-primary">Confirm Order</button>
        </form>
    </div>
</body>
</html>