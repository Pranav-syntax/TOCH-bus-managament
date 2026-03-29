<?php
session_start();
include "db.php";

if(isset($_POST['login'])) {
    $user = mysqli_real_escape_string($conn, $_POST['user']);
    $pass = $_POST['pass'];

    $admin_res = mysqli_query($conn, "SELECT * FROM admin WHERE username='$user' AND password='$pass'");

    if(mysqli_num_rows($admin_res) == 1) {
        $_SESSION['admin'] = $user;
       header("Location: admin_dashboard.php");
        exit();
    } else {
        $error = "Access Denied: Admin Credentials Only";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Access | Maverix</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="hero"></div>
    <div class="container" style="display: flex; justify-content: center; align-items: center; min-height: 100vh;">
        <div class="card" style="max-width: 400px; width: 90%; border-color: #ff4444;">
            <h1 style="color: #ff4444; letter-spacing: 5px;">ADMIN</h1>
            <p style="font-size: 10px; color: var(--text-dim); margin-bottom: 25px;">COMMAND CENTER</p>
            <?php if(isset($error)) echo "<p style='color: #ff4444;'>$error</p>"; ?>
            <form method="post" style="display: flex; flex-direction: column; gap: 15px;">
                <input type="text" name="user" placeholder="Admin Username" required style="padding: 12px; background: rgba(0,0,0,0.5); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: #fff; text-align: center;">
                <input type="password" name="pass" placeholder="Security Password" required style="padding: 12px; background: rgba(0,0,0,0.5); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: #fff; text-align: center;">
                <button type="submit" name="login" class="btn" style="background: #ff4444;">Unlock System</button>
            </form>
        </div>
    </div>
</body>
</html>
