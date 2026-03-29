<?php
session_start();
include "db.php";

if(isset($_POST['login'])) {
    $user = mysqli_real_escape_string($conn, $_POST['user']);
    $pass = $_POST['pass'];

    $admin_res = mysqli_query($conn, "SELECT * FROM admin WHERE username='$user' AND password='$pass'");
    $student_res = mysqli_query($conn, "SELECT * FROM student WHERE student_id='$user' AND password='$pass'");

    if(mysqli_num_rows($admin_res) == 1) {
        $_SESSION['admin'] = $user;
        header("Location: index.php");
        exit();
    } else if(mysqli_num_rows($student_res) == 1) {
        $_SESSION['student_id'] = $user;
        header("Location: student_dashboard.php");
        exit();
    } else {
        $error = "Invalid Credentials";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | Maverix</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;500;800&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="hero"></div>
    <div class="container" style="display: flex; justify-content: center; align-items: center; min-height: 100vh;">
        <div class="card" style="max-width: 400px; width: 90%; padding: 50px 30px;">
            <h1 style="color: var(--primary-accent); letter-spacing: 5px; margin-bottom: 10px; font-weight: 800;">MAVERIX</h1>
            <p style="font-size: 10px; color: var(--text-dim); margin-bottom: 30px; letter-spacing: 2px; text-transform: uppercase;">Portal Access</p>
            <?php if(isset($error)): ?>
                <p style="color: #ff4444; font-size: 13px; margin-bottom: 20px; background: rgba(255,68,68,0.1); padding: 10px; border-radius: 8px;">
                    &#9888; <?php echo $error; ?>
                </p>
            <?php endif; ?>
            <form method="post" style="display: flex; flex-direction: column; gap: 15px;">
                <input type="text" name="user" placeholder="ID or Username" required 
                       style="padding: 14px; background: rgba(0,0,0,0.4); border: 1px solid var(--glass-border); border-radius: 12px; color: #fff; outline: none; text-align: center;">
                <input type="password" name="pass" placeholder="Password" required 
                       style="padding: 14px; background: rgba(0,0,0,0.4); border: 1px solid var(--glass-border); border-radius: 12px; color: #fff; outline: none; text-align: center;">
                <button type="submit" name="login" class="btn" style="width: 100%; margin-top: 10px; cursor: pointer;">
                    Enter Portal
                </button>
            </form>
        </div>
    </div>
</body>
</html>
