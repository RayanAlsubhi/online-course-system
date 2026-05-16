<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

include "db.php";

$user_id = $_SESSION['user_id'];

if(isset($_GET['course_id'])){
    $course_id = $_GET['course_id'];
} else {
    die("Invalid course selection");
}

$check = "SELECT * FROM enrollments 
          WHERE user_id=$user_id AND course_id=$course_id";

$result = $conn->query($check);

if($result->num_rows > 0){
    echo "<script>alert('Already Enrolled!'); window.location='courses.php';</script>";
    exit();
}

$sql = "INSERT INTO enrollments (user_id, course_id)
        VALUES ($user_id, $course_id)";

if($conn->query($sql)){
    echo "<script>
            alert('Enrolled Successfully!');
            window.location='history.php';
          </script>";
} else {
    echo "Error: " . $conn->error;
}
?>