<?php
include "db.php";

$message = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = $conn->prepare("SELECT id FROM users WHERE email=?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();

    if($result->num_rows > 0){
        $message = "<p style='color:red;'>Email already exists!</p>";
    } else {

        $stmt = $conn->prepare("INSERT INTO users(name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $password);

        if($stmt->execute()){
            $message = "<p style='color:green;'>User registered successfully!</p>";
        } else {
            $message = "<p style='color:red;'>Error: " . $conn->error . "</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>

    <link rel="stylesheet" href="assets/style.css">
    <script src="assets/script.js"></script>
</head>

<body>

<header>
    <h1>Registration Page</h1>
</header>

<?php include "nav.php"; ?>

<div class="container">

    <h2>Register</h2>

    <!-- MESSAGE -->
    <?php echo $message; ?>

    <form name="regForm" method="POST" onsubmit="return validateForm()">
        <input type="text" name="name" placeholder="Name" ><br><br>
        <input type="email" name="email" placeholder="Email" ><br><br>
        <input type="password" name="password" placeholder="Password" ><br><br>

        <button type="submit">Register</button>
    </form>

</div>

<footer>
    <p>© 2026 Online Course System</p>
</footer>

</body>
</html>