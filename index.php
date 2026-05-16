<?php 
session_start();
include "db.php"; 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home - Online Course System</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<header>
    <h1>Online Course System</h1>
</header>

<?php include "nav.php"; ?>

<div class="container">

<?php
if(isset($_SESSION['user_name'])){
    echo "<h2>Welcome, ".$_SESSION['user_name']."</h2>";
} else {
    echo "<h2>Welcome Guest</h2>";
}
?>

<h3>System Features</h3>

<ul>
    <li>Browse courses</li>
    <li>Register and login</li>
    <li>Enroll in courses</li>
    <li>View history</li>
    <li>Update and delete account</li>
</ul>

</div>

<footer>
    <p>© 2026 Online Course System</p>
</footer>

</body>
</html>