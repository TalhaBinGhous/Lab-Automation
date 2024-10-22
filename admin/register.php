<?php
include 'conn.php';

if (isset($_POST["register"])) {
    if ($_POST['pass'] == $_POST['cpass']) {
        $aname = $_POST['aname'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];

        $sql = "INSERT INTO `admin`(`aname`, `fname`, `lname`, `email`, `pass`) VALUES ('$aname', '$fname', '$lname', '$email', '$pass')";
        $result = mysqli_query($conn, $sql);

        header('location: login.php');
    }
}
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sign Up</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f8ff; /* Light blue background */
        color: #000; /* Black text */
        display: flex;
        justify-content: center;
        align-items: center;
        height: 450px;
        margin: 0;
        margin-top: 10%;
        margin-bottom: 10%;
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
        height: 30px;
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
        align-items: center;
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
    <h3>Register User</h3>
    <form method="post">
        <label for="aname">
            Username: <br>
            <input type="text" name="aname" required>
        </label><br><br>
        <label for="fname">
            First Name: <br>
            <input type="text" name="fname" required>
        </label><br><br>
        <label for="lname">
            Last Name: <br>
            <input type="text" name="lname" required>
        </label><br><br>
        <label for="email">
            Email: <br>
            <input type="email" name="email" required>
        </label><br><br>
        <label for="pass">
            Password: <br>
            <input type="password" name="pass" required>
        </label><br><br>
        <label for="cpass">
            Confirm Password: <br>
            <input type="password" name="cpass" required>
        </label><br><br>
        <input type="submit" name="register" value="REGISTER">
    </form>
    <p>Already have an account? <a href="login.php">Login</a></p>
</div>
</body>
</html>
