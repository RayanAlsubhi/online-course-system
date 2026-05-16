<?php 
session_start();
include "db.php"; 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="assets/style.css">
    <script src="assets/script.js"></script>
</head>
<body>

<header>
    <h1>User Login</h1>
</header>

<?php include "nav.php"; ?>

<div class="container">

<h2>Login Form</h2>

<form name="loginForm" method="POST" onsubmit="return validateLogin()">
    
    <input type="email" name="email" placeholder="Enter Email" >

    <input type="password" name="password" placeholder="Enter Password" >

    <button type="submit" name="login">Login</button>

</form>

<?php
if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){

        $user = $result->fetch_assoc();

        if(password_verify($password, $user['password'])){

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['role'] = $user['role'];

            header("Location: index.php");
            exit();

        } else {
            echo "<p style='color:red;'>Wrong password!</p>";
        }

    } else {
        echo "<p style='color:red;'>User not found!</p>";
    }
}
?>

</div>

<footer>
    <p>© 2026 Online Course System</p>
</footer>

</body>
</html>