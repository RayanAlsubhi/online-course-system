<nav>
    <a href="index.php">Home</a>
    <a href="courses.php">Courses</a>
    <a href="history.php">History</a>
    <a href="profile.php">My Profile</a>

    <?php if(isset($_SESSION['user_id'])): ?>

        <?php if($_SESSION['role'] == 'admin'): ?>
            <a href="admin.php">Admin Panel</a>
        <?php endif; ?>

        <a href="logout.php">
            Logout (<?php echo $_SESSION['user_name']; ?>)
        </a>

    <?php else: ?>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
    <?php endif; ?>
</nav>