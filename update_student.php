<?php
include "db.php";
$sid = $_GET['sid'];
$res = mysqli_query($conn, "SELECT s.*, a.room_id FROM student s LEFT JOIN allotment a ON s.student_id = a.student_id WHERE s.student_id = '$sid'");
$row = mysqli_fetch_assoc($res);

if(isset($_POST['update'])) {
    $name = $_POST['name']; $room = $_POST['room'];
    mysqli_query($conn, "UPDATE student SET name='$name' WHERE student_id='$sid'");
    mysqli_query($conn, "UPDATE allotment SET room_id='$room' WHERE student_id='$sid'");
    header("Location: view_report.php?msg=updated");
}
?>
<!DOCTYPE html>
<html lang="en">
<head><link rel="stylesheet" href="style.css"></head>
<body style="display:flex; justify-content:center; align-items:center; height:100vh;">
    <form method="post" class="container" style="width:400px; padding:30px;">
        <h2 style="color:var(--primary-accent);">Update Resident</h2>
        <input type="text" name="name" value="<?php echo $row['name']; ?>" style="width:100%; margin-bottom:15px; padding:10px;">
        <select name="room" style="width:100%; margin-bottom:15px; padding:10px;">
            <?php 
            $rooms = mysqli_query($conn, "SELECT * FROM room");
            while($r = mysqli_fetch_assoc($rooms)) {
                $sel = ($r['room_id'] == $row['room_id']) ? "selected" : "";
                echo "<option value='{$r['room_id']}' $sel>Room {$r['room_no']}</option>";
            }
            ?>
        </select>
        <button type="submit" name="update" class="btn">SAVE CHANGES</button>
    </form>
</body>
</html>
