<?php
session_start();
include "db.php";

$sql = "SELECT * FROM courses";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Course List</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>

<header>
    <h1>Online Course System</h1>
</header>

<?php include "nav.php"; ?>

<div class="container">

<h2>Available Courses</h2>

<table border="1" width="100%">

<tr>
    <th>ID</th>
    <th>Title</th>
    <th>Description</th>
    <th>Action</th>
</tr>

<?php
while($row = $result->fetch_assoc()){
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['title']}</td>
            <td>{$row['description']}</td>
            <td>
                <a href='enroll.php?course_id={$row['id']}'>Enroll</a>
            </td>
          </tr>";
}
?>

</table>

</div>

<footer>
    <p>© 2026 Online Course System</p>
</footer>

</body>
</html>