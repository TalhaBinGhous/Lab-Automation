<?php
function clearCart($conn, $csid) {
    $sql = "DELETE FROM cart WHERE csid =?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $csid);
    mysqli_stmt_execute($stmt);
}