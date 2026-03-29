<?php
session_start();
if(!isset($_SESSION['student_id'])) { header("Location: student_login.php"); exit(); }
include "db.php";

if(isset($_POST['change_pass'])) {
    $sid = $_SESSION['student_id'];
    $new_pass = mysqli_real_escape_string($conn, $_POST['new_password']);
    
    $q = "UPDATE student SET password = '$new_pass' WHERE student_id = '$sid'";
    
    if(mysqli_query($conn, $q)) {
        header("Location: student_dashboard.php?msg=pass_success");
    } else {
        header("Location: student_dashboard.php?msg=pass_error");
    }
}
?>
