<?php
session_start();
include "db.php";

/* ---------------- PROTECT PAGE ---------------- */
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

/* ---------------- ADMIN CHECK ---------------- */
if(isset($_SESSION['role']) && $_SESSION['role'] != 'admin'){
    echo "Access denied";
    exit();
}

/* ---------------- DELETE USER ---------------- */
if(isset($_GET['delete'])){
    $id = $_GET['delete'];

    $stmt = $conn->prepare("DELETE FROM users WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    header("Location: admin.php?deleted=1");
    exit();
}

/* ---------------- UPDATE USER ---------------- */
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];

    $stmt = $conn->prepare("UPDATE users SET name=? WHERE id=?");
    $stmt->bind_param("si", $name, $id);
    $stmt->execute();

    header("Location: admin.php?updated=1");
    exit();
}

/* ---------------- GET USERS ---------------- */
$result = $conn->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>

<!-- HEADER -->
<header>
    <h1>Admin Panel</h1>
</header>

<!-- NAVIGATION -->
<?php include "nav.php"; ?>

<!-- MAIN CONTENT -->
<div class="container">

<h2>User Management</h2>

<!-- SUCCESS MESSAGES -->
<?php if(isset($_GET['updated'])): ?>
    <p style="color:green; font-weight:bold;">
        ✔ User updated successfully!
    </p>
<?php endif; ?>

<?php if(isset($_GET['deleted'])): ?>
    <p style="color:green; font-weight:bold;">
        ✔ User deleted successfully!
    </p>
<?php endif; ?>

<!-- USERS TABLE -->
<table>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Actions</th>
</tr>

<?php while($row = $result->fetch_assoc()) { ?>

<tr>
    <td><?= $row['id'] ?></td>

    <td>
        <form method="POST" style="display:flex; gap:5px; align-items:center;">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <input type="text" name="name" value="<?= $row['name'] ?>">
            <button type="submit" name="update" class="btn-update">Update</button>
        </form>
    </td>

    <td><?= $row['email'] ?></td>

    <td>
        <a class="btn-delete"
           href="admin.php?delete=<?= $row['id'] ?>"
           onclick="return confirm('Are you sure you want to delete this user?')">
           Delete
        </a>
    </td>
</tr>

<?php } ?>

</table>

</div>

<!-- FOOTER -->
<footer>
    <p>© 2026 Online Course System</p>
</footer>

</body>
</html>