<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

include "db.php";

$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Enrollment History</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<header>
    <h1>Enrollment History</h1>
</header>

<?php include "nav.php"; ?>

<div class="container">

<h2>My Enrolled Courses</h2>

<table border="1" width="100%">
<tr>
    <th>User Name</th>
    <th>Course Title</th>
    <th>Enrollment Date</th>
</tr>

<?php
$stmt = $conn->prepare("
    SELECT users.name, courses.title, enrollments.enroll_date
    FROM enrollments
    JOIN users ON enrollments.user_id = users.id
    JOIN courses ON enrollments.course_id = courses.id
    WHERE users.id = ?
");

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){

    while($row = $result->fetch_assoc()){
        echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['title']}</td>
                <td>{$row['enroll_date']}</td>
              </tr>";
    }

} else {
    echo "<tr>
            <td colspan='3' style='text-align:center; color:red;'>
                No enrollments found
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