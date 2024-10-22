<?php
include 'conn.php';

if (isset($_POST['delete'])) {
    $pid = $_POST['pid'];

    // Delete product
    $sql_delete = "DELETE FROM products WHERE pid = $pid";
    $result_delete = mysqli_query($conn, $sql_delete);

    if ($result_delete) {
        echo "Product deleted successfully.";
        // Redirect or display a message as needed
    } else {
        echo "Error deleting product.";
    }
}
header('location: product.php');
?>