<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_SESSION['student_id'];
    $category = $_POST['category'];
    $message = $_POST['message'];

    $sql = "INSERT INTO complaints (student_id, category, message) VALUES ('$student_id', '$category', '$message')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: student_dashboard.php?msg=complaint_sent");
        exit();
    }
}
?>
