<?php
session_start();
include "db.php";

/* ---------------- PROTECT PAGE ---------------- */
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$id = $_SESSION['user_id'];

/* ---------------- UPDATE PROFILE ---------------- */
if(isset($_POST['update'])){
    $name = $_POST['name'];

    $stmt = $conn->prepare("UPDATE users SET name=? WHERE id=?");
    $stmt->bind_param("si", $name, $id);
    $stmt->execute();

    $_SESSION['user_name'] = $name;

    header("Location: profile.php?updated=1");
    exit();
}

/* ---------------- GET USER DATA ---------------- */
$result = $conn->query("SELECT * FROM users WHERE id=$id");
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Profile</title>
    <link rel="stylesheet" href="assets/style.css">
    <script src="assets/script.js"></script>
</head>

<body>

<!-- HEADER -->
<header>
    <h1>My Profile</h1>
</header>

<!-- NAVIGATION -->
<?php include "nav.php"; ?>

<!-- MAIN CONTENT -->
<div class="container">

    <h2>Update Profile</h2>

    <!-- SUCCESS MESSAGE -->
    <?php if(isset($_GET['updated'])): ?>
        <p style="color:green; font-weight:bold;">
            ✔ Profile updated successfully!
        </p>
    <?php endif; ?>

    <!-- PROFILE FORM -->
    <form method="POST" onsubmit="return validateProfile()">

        <label>Name:</label>
        <input type="text" name="name" value="<?= $user['name'] ?>">

        <label>Email:</label>
        <input type="email" value="<?= $user['email'] ?>" disabled>

        <button type="submit" name="update" class="btn-update">
            Update Profile
        </button>

    </form>
    <hr>

<h3>Account Options</h3>

<div style="margin-top:15px; display:flex; flex-direction:column; gap:10px;">

    <!-- DELETE ACCOUNT -->
    <a class="btn-delete"
       href="delete_account.php"
       onclick="return confirm('⚠ Are you sure you want to delete your account? This cannot be undone!')">
       Delete My Account
    </a>

</div>

</div>

<!-- FOOTER -->
<footer>
    <p>© 2026 Online Course System</p>
</footer>

</body>
</html>