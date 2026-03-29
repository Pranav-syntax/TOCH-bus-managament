<?php
include "db.php";

if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // 1. Delete allotment first (referential integrity)
    mysqli_query($conn, "DELETE FROM allotment WHERE student_id = '$id'");

    // 2. Delete student record
    if(mysqli_query($conn, "DELETE FROM student WHERE student_id = '$id'")) {
        header("Location: view_report.php?msg=deleted");
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}
?>
