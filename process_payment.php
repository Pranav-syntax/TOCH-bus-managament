<?php
session_start();
if(!isset($_SESSION['student_id'])) { 
    header("Location: student_login.php"); 
    exit(); 
}
include "db.php";

$sid = $_SESSION['student_id'];

$q = "UPDATE allotment SET status = 'Paid' WHERE student_id = '$sid'";

if(mysqli_query($conn, $q)) {
    header("Location: student_dashboard.php?payment=success");
} else {
    header("Location: student_dashboard.php?payment=failed");
}
exit();
?>
