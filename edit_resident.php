<?php 
include "db.php"; 
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT s.*, a.room_id FROM student s LEFT JOIN allotment a ON s.student_id = a.student_id WHERE s.student_id = '$id'"));

if(isset($_POST['update'])) {
    $name = $_POST['name'];
    $branch = $_POST['branch'];
    $new_room = $_POST['room_id'];

    mysqli_query($conn, "UPDATE student SET name='$name', branch='$branch' WHERE student_id='$id'");
    mysqli_query($conn, "UPDATE allotment SET room_id='$new_room' WHERE student_id='$id'");

    header("Location: view_report.php?msg=updated");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Resident | Maverix</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="hero"></div>
    <div class="container" style="max-width: 500px; margin: 100px auto; padding: 40px; background: rgba(255,255,255,0.03); backdrop-filter: blur(20px); border-radius: 30px; border: 1px solid rgba(255,255,255,0.1);">
        <h2 style="color: var(--primary-accent); text-align: center; margin-bottom: 20px;">UPDATE RESIDENT</h2>
        <form method="POST" style="display: flex; flex-direction: column; gap: 15px;">
            <input type="text" name="name" value="<?php echo $data['name']; ?>" required style="padding: 12px; background: rgba(0,0,0,0.3); border: 1px solid rgba(255,255,255,0.1); color: #fff; border-radius: 10px;">
            <input type="text" name="branch" value="<?php echo $data['branch']; ?>" required style="padding: 12px; background: rgba(0,0,0,0.3); border: 1px solid rgba(255,255,255,0.1); color: #fff; border-radius: 10px;">
            
            <select name="room_id" style="padding: 12px; background: rgba(0,0,0,0.3); border: 1px solid rgba(255,255,255,0.1); color: #fff; border-radius: 10px;">
                <?php 
                $rooms = mysqli_query($conn, "SELECT * FROM room");
                while($r = mysqli_fetch_assoc($rooms)) {
                    $selected = ($r['room_id'] == $data['room_id']) ? "selected" : "";
                    echo "<option value='{$r['room_id']}' $selected>Room {$r['room_no']}</option>";
                }
                ?>
            </select>

            <button type="submit" name="update" class="btn">SAVE CHANGES</button>
            <a href="view_report.php" style="text-align: center; color: var(--text-dim); text-decoration: none; font-size: 12px;">Cancel</a>
        </form>
    </div>
</body>
</html>
