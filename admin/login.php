<?php
if (!session_id()) {
    session_start();
}

include 'conn.php';

if (isset($_POST["login"])) {
    $aname = $_POST['aname'];
    $pass = $_POST['pass'];

    // Use prepared statements to prevent SQL injection
    $sql = "SELECT * FROM admin WHERE aname = ? AND pass = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $aname, $pass);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row_count = mysqli_num_rows($result);

    if ($row_count == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['aid'] = $row['aid'];
        $_SESSION['aname'] = $aname;

        // Try to redirect using the full URL
        $redirect_url = 'http://localhost:82/Lab%20Automation/admin/index.php';
        header("Location: $redirect_url");
        exit();
    } else {
        echo "Incorrect credentials";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff; /* Light blue background */
            color: #000; /* Black text */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff; /* White background */
            padding: 50px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 40%;
        }

        h3 {
            color: #0000ff; /* Blue text */
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
        }
            
        label {
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #0000ff; /* Blue border */
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #0000ff; /* Blue background */
            color: #fff; /* White text */
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }

        input[type="submit"]:hover {
            background-color: #0000cc; /* Darker blue on hover */
        }

        p {
            text-align: center;
            margin-top: 20px;
        }

        a {
            color: #0000ff; /* Blue link */
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Login User</h3>
        <form method="post">
            <label for="aname">
                Username: <br>
                <input type="text" name="aname" required>
            </label><br><br>
            <label for="pass">
                Password: <br>
                <input type="password" name="pass" required>
            </label><br><br>
            <input type="submit" name="login" value="LOGIN">
        </form>
        <p>Don't have an account? <a href="register.php">Sign Up</a></p>
    </div>
</body>
</html>

