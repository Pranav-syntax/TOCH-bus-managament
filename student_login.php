<?php
session_start();
include "db.php";

if(isset($_POST['login'])) {
    $user = mysqli_real_escape_string($conn, $_POST['user']);
    $pass = $_POST['pass'];

    $student_res = mysqli_query($conn, "SELECT * FROM student WHERE student_id='$user' AND password='$pass'");

    if(mysqli_num_rows($student_res) == 1) {
        $_SESSION['student_id'] = $user;
        header("Location: student_dashboard.php");
        exit();
    } else {
        $error = "Invalid Student ID or Password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Login | Maverix</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="hero"></div>
    <div class="container" style="display: flex; justify-content: center; align-items: center; min-height: 100vh;">
        <div class="card" style="max-width: 400px; width: 90%;">
            <h1 style="color: var(--primary-accent); letter-spacing: 5px;">MAVERIX</h1>
            <p style="font-size: 10px; color: var(--text-dim); margin-bottom: 25px;">STUDENT PORTAL</p>
            <?php if(isset($error)) echo "<p style='color: #ff4444;'>$error</p>"; ?>
            <form method="post" style="display: flex; flex-direction: column; gap: 15px;">
                <input type="text" name="user" placeholder="Enter Student ID" required style="padding: 12px; background: rgba(0,0,0,0.5); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: #fff; text-align: center;">
                <input type="password" name="pass" placeholder="Password" required style="padding: 12px; background: rgba(0,0,0,0.5); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: #fff; text-align: center;">
                <button type="submit" name="login" class="btn">Login to Stay</button>
            </form>
        </div>
    </div>
</body>
</html>
